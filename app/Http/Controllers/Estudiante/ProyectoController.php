<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Team;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProyectoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Obtener equipos del usuario con miembros
        $equipos = Team::whereHas('members', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with('members')->get();
        
        // Obtener proyectos de esos equipos (sin cargar advisor aún)
        $proyectos = Project::whereIn('team_id', $equipos->pluck('id'))
                            ->with(['team.leader', 'event'])
                            ->orderBy('created_at', 'desc')
                            ->get();
        
        // Obtener eventos disponibles para inscripción (solo próximos)
        $eventos = Event::where('is_published', true)
                       ->where('status', 'upcoming')
                       ->orderBy('event_start_date', 'asc')
                       ->get();
        
        return view('estudiante.proyectos', compact('proyectos', 'equipos', 'eventos'));
    }

    public function show($id)
    {
        $user = Auth::user();
        
        // Cargar proyecto con todas las relaciones necesarias
        $proyecto = Project::with([
            'team.members', 
            'team.leader',
            'event', 
            'evaluations.judge'
        ])->findOrFail($id);
        
        // Cargar advisor solo si existe la columna
        if (Schema::hasColumn('projects', 'advisor_id')) {
            $proyecto->load('advisor');
        }
        
        if (!$proyecto->team->isMember($user->id)) {
            abort(403, 'No tienes permiso para ver este proyecto');
        }
        
        // Obtener asesores disponibles (que no tengan proyecto en este evento)
        $asesoresDisponibles = collect();
        
        if (Schema::hasColumn('projects', 'advisor_id')) {
            $asesoresDisponibles = User::where(function($query) {
                    $query->where('role', 'asesor')
                          ->orWhere('user_type', 'maestro')
                          ->orWhere('user_type', 'asesor');
                })
                ->whereDoesntHave('advisedProjects', function($q) use ($proyecto) {
                    $q->where('event_id', $proyecto->event_id)
                      ->where('id', '!=', $proyecto->id);
                })
                ->orderBy('name', 'asc')
                ->get();
        }
        
        // Verificar si el usuario es líder
        $esLider = $proyecto->team->isLeader($user->id);
        
        // Verificar estado de solicitud de asesor
        $solicitudAsesor = DB::table('advisor_requests')
            ->where('project_id', $proyecto->id)
            ->whereIn('status', ['pending', 'accepted', 'rejected'])
            ->orderBy('created_at', 'desc')
            ->first();
        
        return view('estudiante.proyecto-detalle', compact('proyecto', 'asesoresDisponibles', 'esLider', 'solicitudAsesor'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
            'event_id' => 'required|exists:events,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
        ]);

        $user = Auth::user();
        $team = Team::with('members')->findOrFail($request->team_id);
        $event = Event::findOrFail($request->event_id);

        // VALIDACIÓN 1: Usuario es miembro del equipo
        if (!$team->isMember($user->id)) {
            return response()->json(['success' => false, 'message' => 'No eres miembro de este equipo'], 403);
        }

        // VALIDACIÓN 2: Evento está disponible para inscripción
        if (!$event->is_published) {
            return response()->json(['success' => false, 'message' => 'Este evento no está disponible'], 422);
        }

        if ($event->status !== 'upcoming') {
            return response()->json(['success' => false, 'message' => 'Solo puedes inscribir proyectos a eventos próximos'], 422);
        }

        // VALIDACIÓN 3: El equipo NO está ya inscrito en este evento
        $registroExistente = DB::table('event_registrations')
            ->where('team_id', $request->team_id)
            ->where('event_id', $request->event_id)
            ->first();

        if ($registroExistente) {
            return response()->json(['success' => false, 'message' => 'Este equipo ya está inscrito en este evento'], 422);
        }

        // VALIDACIÓN 4: NINGÚN MIEMBRO del equipo puede estar ya en OTRO EQUIPO de este evento
        $miembrosIds = $team->members->pluck('id')->toArray();
        
        // Buscar si alguno de los miembros ya está en otro equipo inscrito en este evento
        $miembroConConflicto = DB::table('event_registrations as er')
            ->join('team_members as tm', 'tm.team_id', '=', 'er.team_id')
            ->join('users as u', 'u.id', '=', 'tm.user_id')
            ->join('teams as t', 't.id', '=', 'er.team_id')
            ->where('er.event_id', $request->event_id)
            ->whereIn('tm.user_id', $miembrosIds)
            ->select('u.name as user_name', 't.name as team_name')
            ->first();
        
        if ($miembroConConflicto) {
            return response()->json([
                'success' => false, 
                'message' => "No se puede inscribir: {$miembroConConflicto->user_name} ya está participando en este evento con el equipo '{$miembroConConflicto->team_name}'"
            ], 422);
        }

        // VALIDACIÓN 5: Límite de equipos en el evento
        if ($event->max_teams) {
            $equiposInscritos = DB::table('event_registrations')
                ->where('event_id', $request->event_id)
                ->count();
            
            if ($equiposInscritos >= $event->max_teams) {
                return response()->json(['success' => false, 'message' => 'El evento ha alcanzado el límite de equipos'], 422);
            }
        }

        try {
            DB::beginTransaction();

            // Crear proyecto
            $projectId = Str::uuid();
            $proyecto = Project::create([
                'id' => $projectId,
                'team_id' => $request->team_id,
                'event_id' => $request->event_id,
                'title' => $request->title,
                'description' => $request->description,
                'repository_url' => $request->repository_url,
                'demo_url' => $request->demo_url,
                'status' => 'draft',
            ]);

            // Registrar equipo en evento
            DB::table('event_registrations')->insert([
                'id' => Str::uuid(),
                'team_id' => $request->team_id,
                'event_id' => $request->event_id,
                'project_id' => $projectId,
                'registered_by' => $user->id,
                'registered_at' => now(),
            ]);

            // Incrementar contador de equipos registrados
            $event->increment('registered_teams_count');

            DB::commit();

            return response()->json([
                'success' => true, 
                'message' => 'Proyecto creado e inscrito al evento exitosamente',
                'project_id' => $projectId
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'repository_url' => 'nullable|url',
            'demo_url' => 'nullable|url',
        ]);

        $user = Auth::user();
        $proyecto = Project::with('team')->findOrFail($id);

        if (!$proyecto->team->isLeader($user->id)) {
            return response()->json(['success' => false, 'message' => 'Solo el líder puede editar el proyecto'], 403);
        }

        try {
            $proyecto->update([
                'title' => $request->title,
                'description' => $request->description,
                'repository_url' => $request->repository_url,
                'demo_url' => $request->demo_url,
            ]);
            
            return response()->json(['success' => true, 'message' => 'Proyecto actualizado exitosamente']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Solicitar asesor (envía solicitud en lugar de asignar directamente)
     */
    public function solicitarAsesor(Request $request, $id)
    {
        $request->validate([
            'advisor_id' => 'required|exists:users,id',
            'mensaje' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        $proyecto = Project::with('team')->findOrFail($id);

        if (!$proyecto->team->isLeader($user->id)) {
            return response()->json(['success' => false, 'message' => 'Solo el líder puede solicitar asesor'], 403);
        }

        $solicitudExistente = DB::table('advisor_requests')
            ->where('project_id', $proyecto->id)
            ->where('status', 'pending')
            ->exists();

        if ($solicitudExistente) {
            return response()->json(['success' => false, 'message' => 'Ya tienes una solicitud pendiente para este proyecto'], 422);
        }

        if ($proyecto->advisor_id) {
            return response()->json(['success' => false, 'message' => 'Este proyecto ya tiene un asesor asignado'], 422);
        }

        try {
            $requestId = Str::uuid();
            DB::table('advisor_requests')->insert([
                'id' => $requestId,
                'project_id' => $proyecto->id,
                'team_id' => $proyecto->team_id,
                'advisor_id' => $request->advisor_id,
                'requested_by' => $user->id,
                'status' => 'pending',
                'message' => $request->mensaje,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $asesor = User::find($request->advisor_id);
            \App\Models\Notification::create([
                'id' => Str::uuid(),
                'user_id' => $request->advisor_id,
                'type' => 'advisor_request',
                'title' => 'Nueva Solicitud de Asesoría',
                'message' => $user->name . ' solicita que seas asesor de su proyecto "' . $proyecto->title . '"',
                'data' => json_encode([
                    'project_id' => $proyecto->id,
                    'team_id' => $proyecto->team_id,
                    'request_id' => $requestId,
                ]),
                'is_read' => false,
            ]);

            return response()->json([
                'success' => true, 
                'message' => 'Solicitud enviada a ' . $asesor->name . ' exitosamente'
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Cancelar solicitud de asesor
     */
    public function cancelarSolicitudAsesor($id)
    {
        $user = Auth::user();
        $proyecto = Project::with('team')->findOrFail($id);

        if (!$proyecto->team->isLeader($user->id)) {
            return response()->json(['success' => false, 'message' => 'Solo el líder puede cancelar la solicitud'], 403);
        }

        try {
            $deleted = DB::table('advisor_requests')
                ->where('project_id', $proyecto->id)
                ->where('status', 'pending')
                ->delete();

            if ($deleted) {
                return response()->json(['success' => true, 'message' => 'Solicitud cancelada']);
            } else {
                return response()->json(['success' => false, 'message' => 'No hay solicitud pendiente'], 404);
            }

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function submitFile(Request $request, $id)
    {
        try {
            $request->validate([
                'submission_file' => 'required|file|mimes:pdf,zip,rar,docx,pptx|max:51200',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Error de validación: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
        }

        $user = Auth::user();
        $proyecto = Project::with('team')->findOrFail($id);

        // Verificar que el usuario es líder del equipo
        if (!$proyecto->team->isLeader($user->id)) {
            return response()->json(['success' => false, 'message' => 'Solo el líder puede entregar el proyecto'], 403);
        }

        // Verificar que el proyecto no esté ya entregado
        if ($proyecto->status === 'submitted') {
            return response()->json(['success' => false, 'message' => 'El proyecto ya ha sido entregado. Elimina la entrega anterior para subir una nueva.'], 422);
        }

        // Verificar que el archivo existe
        if (!$request->hasFile('submission_file')) {
            return response()->json(['success' => false, 'message' => 'No se recibió ningún archivo'], 422);
        }

        $file = $request->file('submission_file');

        // Verificar que el archivo es válido
        if (!$file->isValid()) {
            return response()->json(['success' => false, 'message' => 'El archivo no es válido o está corrupto'], 422);
        }

        try {
            // Guardar archivo
            $file = $request->file('submission_file');
            
            // Log de información del archivo
            \Log::info('Subiendo archivo', [
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'proyecto_id' => $proyecto->id
            ]);
            
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            
            // Asegurarse de que el directorio existe
            $storageDirectory = storage_path('app/public/submissions');
            if (!file_exists($storageDirectory)) {
                mkdir($storageDirectory, 0755, true);
            }
            
            $filePath = $file->storeAs('submissions', $fileName, 'public');
            
            if (!$filePath) {
                throw new \Exception('No se pudo guardar el archivo en el almacenamiento');
            }

            // Actualizar proyecto
            $proyecto->update([
                'submission_file_path' => $filePath,
                'submission_file_name' => $file->getClientOriginalName(),
                'submitted_at' => now(),
                'status' => 'submitted',
            ]);

            return response()->json([
                'success' => true, 
                'message' => 'Proyecto entregado exitosamente',
                'file_name' => $file->getClientOriginalName()
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function downloadSubmission($id)
    {
        $user = Auth::user();
        $proyecto = Project::with('team')->findOrFail($id);

        // Verificar que el usuario es miembro del equipo
        if (!$proyecto->team->isMember($user->id)) {
            abort(403, 'No tienes permiso para descargar este archivo');
        }

        if (!$proyecto->submission_file_path) {
            abort(404, 'No hay archivo de entrega');
        }

        return Storage::disk('public')->download($proyecto->submission_file_path, $proyecto->submission_file_name);
    }

    public function deleteSubmission($id)
    {
        $user = Auth::user();
        $proyecto = Project::with('team')->findOrFail($id);

        // Verificar que el usuario es líder del equipo
        if (!$proyecto->team->isLeader($user->id)) {
            return response()->json(['success' => false, 'message' => 'Solo el líder puede eliminar la entrega'], 403);
        }

        // Verificar que el proyecto no esté evaluado
        if ($proyecto->status === 'evaluated') {
            return response()->json(['success' => false, 'message' => 'No se puede eliminar la entrega de un proyecto evaluado'], 422);
        }

        try {
            // Eliminar archivo
            if ($proyecto->submission_file_path) {
                Storage::disk('public')->delete($proyecto->submission_file_path);
            }

            // Actualizar proyecto
            $proyecto->update([
                'submission_file_path' => null,
                'submission_file_name' => null,
                'submitted_at' => null,
                'status' => 'in_progress',
            ]);

            return response()->json(['success' => true, 'message' => 'Entrega eliminada exitosamente']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $proyecto = Project::with('team', 'event')->findOrFail($id);

        if (!$proyecto->team->isLeader($user->id)) {
            return response()->json(['success' => false, 'message' => 'Solo el líder puede eliminar el proyecto'], 403);
        }

        try {
            DB::beginTransaction();

            // Eliminar archivo de entrega si existe
            if ($proyecto->submission_file_path) {
                Storage::disk('public')->delete($proyecto->submission_file_path);
            }

            // Eliminar registro de evento
            DB::table('event_registrations')
                ->where('team_id', $proyecto->team_id)
                ->where('event_id', $proyecto->event_id)
                ->delete();

            // Decrementar contador
            if ($proyecto->event) {
                $proyecto->event->decrement('registered_teams_count');
            }

            // Eliminar proyecto
            $proyecto->delete();

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Proyecto eliminado exitosamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
