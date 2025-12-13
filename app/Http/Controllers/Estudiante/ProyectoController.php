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
        

        // Obtener comentarios del asesor (verificar si existe la tabla)
        $comentarios = collect();
        if (Schema::hasTable('project_comments')) {
            $comentarios = \App\Models\ProjectComment::where('project_id', $id)
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->get();
        }
        
        // Obtener asesores disponibles...
        // Obtener asesores disponibles (que no tengan proyecto en este evento)

        // Obtener asesores disponibles (asignados al evento y que no estén ocupados)

        $asesoresDisponibles = collect();
        
        if (Schema::hasColumn('projects', 'advisor_id')) {
            // 1. Obtener asesores asignados a ESTE evento específico
            $asesoresDelEvento = DB::table('event_advisors')
                ->where('event_id', $proyecto->event_id)
                ->where('status', 'active')
                ->pluck('advisor_id');
            
            // Si no hay asesores asignados al evento, mostrar todos disponibles
            if ($asesoresDelEvento->count() > 0) {
                // 2. De esos asesores, filtrar los que NO tienen proyectos asignados en este evento
                $asesoresDisponibles = User::whereIn('id', $asesoresDelEvento)
                    ->whereDoesntHave('advisedProjects', function($q) use ($proyecto) {
                        $q->where('event_id', $proyecto->event_id);
                    })
                    ->orderBy('name', 'asc')
                    ->get();
            } else {
                // Si no hay asesores asignados, mostrar todos los asesores del sistema
                $asesoresDisponibles = User::where(function($query) {
                        $query->where('user_type', 'maestro');
                              
                      
                    })
                    ->whereDoesntHave('advisedProjects', function($q) use ($proyecto) {
                        $q->where('event_id', $proyecto->event_id);
                    })
                    ->orderBy('name', 'asc')
                    ->get();
            }
        }
        
        // Verificar si el usuario es líder
        $esLider = $proyecto->team->isLeader($user->id);
        
        // Verificar estado de solicitud de asesor
        $solicitudAsesor = DB::table('advisor_requests')
            ->where('project_id', $proyecto->id)
            ->whereIn('status', ['pending', 'accepted', 'rejected'])
            ->orderBy('created_at', 'desc')
            ->first();
        
        return view('estudiante.proyecto-detalle', compact('proyecto', 'asesoresDisponibles', 'esLider', 'solicitudAsesor', 'comentarios'));
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
        $proyecto = Project::with('team', 'event')->findOrFail($id);

        if (!$proyecto->team->isLeader($user->id)) {
            return response()->json(['success' => false, 'message' => 'Solo el líder puede solicitar asesor'], 403);
        }

        // Verificar que el asesor está asignado al evento
        $asesorAsignadoAlEvento = DB::table('event_advisors')
            ->where('event_id', $proyecto->event_id)
            ->where('advisor_id', $request->advisor_id)
            ->where('status', 'active')
            ->exists();

        // Si hay asesores asignados al evento, validar que el asesor esté en la lista
        $hayAsesoresAsignados = DB::table('event_advisors')
            ->where('event_id', $proyecto->event_id)
            ->where('status', 'active')
            ->exists();

        if ($hayAsesoresAsignados && !$asesorAsignadoAlEvento) {
            return response()->json([
                'success' => false, 
                'message' => 'Este asesor no está asignado al evento. Solo puedes solicitar asesores asignados por el administrador.'
            ], 422);
        }

        // Verificar que el asesor no tiene otro proyecto en este evento
        $asesorOcupado = Project::where('event_id', $proyecto->event_id)
            ->where('advisor_id', $request->advisor_id)
            ->where('id', '!=', $proyecto->id)
            ->exists();

        if ($asesorOcupado) {
            return response()->json([
                'success' => false, 
                'message' => 'Este asesor ya está asignado a otro proyecto en este evento'
            ], 422);
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

    /**
     * Descargar constancia de participación (solo para proyectos evaluados)
     */
    public function descargarConstancia($id)
    {
        $user = Auth::user();
        $proyecto = Project::with(['team.members', 'team.leader', 'event', 'advisor'])->findOrFail($id);

        if (!$proyecto->team->isMember($user->id)) {
            abort(403, 'No tienes permiso para descargar esta constancia');
        }

        if ($proyecto->status !== 'evaluated' || !$proyecto->final_score) {
            abort(403, 'Solo se puede descargar la constancia de proyectos evaluados');
        }

        $html = $this->generarHTMLConstancia($proyecto, $user);
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html);
        $pdf->setPaper('letter', 'landscape');

        $fileName = 'Constancia_' . Str::slug($proyecto->title) . '_' . Str::slug($user->name) . '.pdf';

        return $pdf->download($fileName);
    }

    private function generarHTMLConstancia($proyecto, $usuario)
    {
        $fecha = now()->locale('es')->isoFormat('D [de] MMMM [de] YYYY');
        $fechaEvento = Carbon::parse($proyecto->event->event_start_date)->locale('es')->isoFormat('D [de] MMMM [de] YYYY');
        $fechaEval = $proyecto->evaluated_at ? Carbon::parse($proyecto->evaluated_at)->locale('es')->isoFormat('D [de] MMMM [de] YYYY') : 'N/A';

        return '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 20px; size: letter landscape; }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family: "Times New Roman", serif; padding: 15px; }
        .cert { border: 8px double #1e40af; padding: 20px 30px; background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%); position: relative; }
        .corner { position: absolute; width: 45px; height: 45px; border: 2px solid #3b82f6; }
        .tl { top: 6px; left: 6px; border-right:none; border-bottom:none; }
        .tr { top: 6px; right: 6px; border-left:none; border-bottom:none; }
        .bl { bottom: 6px; left: 6px; border-right:none; border-top:none; }
        .br { bottom: 6px; right: 6px; border-left:none; border-top:none; }
        .header { text-align:center; margin-bottom:10px; padding-bottom:8px; border-bottom: 2px solid #1e40af; }
        .inst { font-size:12px; font-weight:bold; color:#1e293b; line-height:1.3; margin:2px 0; }
        .title { font-size:36px; font-weight:bold; color:#1e40af; margin:10px 0; letter-spacing:3px; }
        .content { text-align:center; margin:8px 0; }
        .otorga { font-size:12px; color:#334155; margin:4px 0; line-height:1.3; }
        .name { font-size:26px; font-weight:bold; color:#1e293b; margin:8px 0; border-bottom: 2px solid #3b82f6; padding-bottom:3px; display:inline-block; }
        .desc { font-size:11px; color:#334155; margin:8px 0; line-height:1.4; text-align:center; padding:0 40px; }
        .tbl { width:85%; margin:10px auto; border-collapse:collapse; font-size:10px; }
        .tbl td { padding:4px 10px; border: 1px solid #cbd5e1; }
        .lbl { font-weight:bold; color:#1e40af; background:#f1f5f9; width:25%; }
        .val { color:#334155; }
        .score { font-size:16px; font-weight:bold; color:#059669; }
        .footer { margin-top:12px; text-align:center; }
        .date { font-size:10px; color:#475569; margin-bottom:12px; line-height:1.3; }
        .sigs { display:table; width:100%; margin-top:8px; }
        .sig { display:table-cell; text-align:center; width:50%; padding:0 10px; }
        .firma-img { width:110px; height:45px; margin:0 auto 3px; }
        .line { border-top: 2px solid #1e293b; margin:0 12px 3px 12px; }
        .sname { font-weight:bold; font-size:9px; color:#1e293b; margin:2px 0; }
        .stitle { font-size:8px; color:#475569; }
    </style>
</head>
<body>
    <div class="cert">
        <div class="corner tl"></div><div class="corner tr"></div><div class="corner bl"></div><div class="corner br"></div>
        <div class="header">
            <div class="inst">TECNOLÓGICO NACIONAL DE MÉXICO</div>
            <div class="inst">INSTITUTO TECNOLÓGICO DE OAXACA</div>
            <div class="inst" style="font-size:10px; font-weight:normal;">Coordinación General Académica y de Innovación</div>
        </div>
        <div class="title">CONSTANCIA</div>
        <div class="content">
            <div class="otorga">El Tecnológico Nacional de México a través del<br>Instituto Tecnológico de Oaxaca otorga la presente</div>
            <div class="otorga" style="margin-top:8px;">A:</div>
            <div class="name">' . strtoupper($usuario->name) . '</div>
            <div class="desc">Por haber participado en el evento <strong>' . $proyecto->event->title . '</strong>, llevado a cabo el ' . $fechaEvento . ', presentando el proyecto <strong>' . $proyecto->title . '</strong> como integrante del equipo <strong>' . $proyecto->team->name . '</strong>.</div>
        </div>
        <table class="tbl">
            <tr><td class="lbl">Evento:</td><td class="val">' . $proyecto->event->title . '</td></tr>
            <tr><td class="lbl">Proyecto:</td><td class="val">' . $proyecto->title . '</td></tr>
            <tr><td class="lbl">Equipo:</td><td class="val">' . $proyecto->team->name . ' (Líder: ' . $proyecto->team->leader->name . ')</td></tr>
            <tr><td class="lbl">Asesor:</td><td class="val">' . ($proyecto->advisor ? $proyecto->advisor->name : 'No asignado') . '</td></tr>
            <tr><td class="lbl">Calificación Final:</td><td class="val"><span class="score">' . number_format($proyecto->final_score, 1) . ' / 100</span></td></tr>
        </table>
        <div class="footer">
            <div class="date"><strong>ATENTAMENTE</strong><br>“Piensa y Trabaja”<br>Oaxaca de Juárez, Oaxaca, ' . $fecha . '</div>
            <div class="sigs">
                <div class="sig">
                    <svg class="firma-img" viewBox="0 0 200 80" xmlns="http://www.w3.org/2000/svg">
                        <path d="M 15 50 Q 25 30, 35 50 Q 45 65, 55 45 Q 65 30, 75 50" stroke="#1e40af" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                        <path d="M 80 35 Q 90 25, 100 40 Q 110 55, 120 35" stroke="#1e40af" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                        <path d="M 125 45 L 135 35 L 145 50 L 155 30" stroke="#1e40af" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                        <circle cx="170" cy="40" r="12" stroke="#1e40af" stroke-width="2.5" fill="none"/>
                        <path d="M 163 40 L 177 40" stroke="#1e40af" stroke-width="2"/>
                    </svg>
                    <div class="line"></div>
                    <div class="sname">Dr. Carlos Iván Moreno Arellano</div>
                    <div class="stitle">Coordinador General Académico y de Innovación</div>
                </div>
                <div class="sig">
                    <svg class="firma-img" viewBox="0 0 200 80" xmlns="http://www.w3.org/2000/svg">
                        <path d="M 20 45 Q 30 25, 40 45 Q 50 60, 60 40 Q 70 25, 80 45" stroke="#1e40af" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                        <path d="M 85 30 Q 95 50, 105 35 Q 115 20, 125 40" stroke="#1e40af" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                        <path d="M 130 40 L 145 40 M 137.5 30 L 137.5 50" stroke="#1e40af" stroke-width="2.5" stroke-linecap="round"/>
                        <path d="M 150 35 Q 160 45, 170 30 Q 180 45, 190 35" stroke="#1e40af" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                    </svg>
                    <div class="line"></div>
                    <div class="sname">Dr. Ricardo Villanueva Lomelí</div>
                    <div class="stitle">Rector General</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>';
    }

    /**
     * Descargar reconocimiento para ganadores (1er, 2do, 3er lugar)
     */
    public function descargarReconocimiento($id)
    {
        $user = Auth::user();
        $proyecto = Project::with(['team.members', 'team.leader', 'event', 'advisor'])->findOrFail($id);

        if (!$proyecto->team->isMember($user->id)) {
            abort(403, 'No tienes permiso para descargar este reconocimiento');
        }

        if ($proyecto->status !== 'evaluated' || !$proyecto->final_score) {
            abort(403, 'Solo se puede descargar el reconocimiento de proyectos evaluados');
        }

        // Calcular posición en el ranking del evento
        $posicion = DB::table('projects')
            ->where('event_id', $proyecto->event_id)
            ->where('status', 'evaluated')
            ->whereNotNull('final_score')
            ->where('final_score', '>', $proyecto->final_score)
            ->count() + 1;

        if ($posicion > 3) {
            abort(403, 'Solo los 3 primeros lugares pueden descargar reconocimiento');
        }

        $html = $this->generarHTMLReconocimiento($proyecto, $user, $posicion);
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html);
        $pdf->setPaper('letter', 'landscape');

        $fileName = 'Reconocimiento_' . $posicion . 'erLugar_' . Str::slug($proyecto->title) . '_' . Str::slug($user->name) . '.pdf';

        return $pdf->download($fileName);
    }

    private function generarHTMLReconocimiento($proyecto, $usuario, $posicion)
    {
        $fecha = now()->locale('es')->isoFormat('D [de] MMMM [de] YYYY');
        $fechaEvento = Carbon::parse($proyecto->event->event_start_date)->locale('es')->isoFormat('D [de] MMMM [de] YYYY');

        // Configuración según posición
        $posiciones = [
            1 => ['texto' => 'PRIMER LUGAR', 'color' => '#FFD700', 'emoji' => '🥇', 'felicitacion' => '¡Felicitaciones por esta extraordinaria victoria!'],
            2 => ['texto' => 'SEGUNDO LUGAR', 'color' => '#C0C0C0', 'emoji' => '🥈', 'felicitacion' => '¡Felicitaciones por este gran logro!'],
            3 => ['texto' => 'TERCER LUGAR', 'color' => '#CD7F32', 'emoji' => '🥉', 'felicitacion' => '¡Felicitaciones por este excelente desempeño!'],
        ];
        $info = $posiciones[$posicion];

        return '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 20px; size: letter landscape; }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family: "Times New Roman", serif; padding: 15px; background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%); }
        .cert { border: 10px double ' . $info['color'] . '; padding: 20px 30px; background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); position: relative; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .corner { position: absolute; width: 50px; height: 50px; border: 3px solid ' . $info['color'] . '; }
        .tl { top: 8px; left: 8px; border-right:none; border-bottom:none; }
        .tr { top: 8px; right: 8px; border-left:none; border-bottom:none; }
        .bl { bottom: 8px; left: 8px; border-right:none; border-top:none; }
        .br { bottom: 8px; right: 8px; border-left:none; border-top:none; }
        .header { text-align:center; margin-bottom:8px; padding-bottom:6px; border-bottom: 3px solid ' . $info['color'] . '; }
        .inst { font-size:12px; font-weight:bold; color:#1e293b; line-height:1.3; margin:2px 0; }
        .trophy { font-size:60px; text-align:center; margin:10px 0; }
        .title { font-size:42px; font-weight:bold; color: ' . $info['color'] . '; margin:8px 0; letter-spacing:4px; text-align:center; text-shadow: 2px 2px 4px rgba(0,0,0,0.1); }
        .subtitle { font-size:28px; font-weight:bold; color:#1e293b; text-align:center; margin:6px 0; }
        .content { text-align:center; margin:10px 0; }
        .felicitacion { font-size:14px; color:#059669; font-weight:bold; margin:8px 0; font-style:italic; }
        .otorga { font-size:12px; color:#334155; margin:5px 0; line-height:1.3; }
        .name { font-size:28px; font-weight:bold; color:#1e293b; margin:10px 0; border-bottom: 3px solid ' . $info['color'] . '; padding-bottom:4px; display:inline-block; }
        .desc { font-size:11px; color:#334155; margin:8px 0; line-height:1.4; text-align:center; padding:0 40px; }
        .tbl { width:85%; margin:10px auto; border-collapse:collapse; font-size:10px; }
        .tbl td { padding:5px 12px; border: 1px solid #cbd5e1; }
        .lbl { font-weight:bold; color:' . $info['color'] . '; background:#f8f9fa; width:25%; }
        .val { color:#334155; }
        .score { font-size:18px; font-weight:bold; color:#059669; }
        .footer { margin-top:12px; text-align:center; }
        .date { font-size:10px; color:#475569; margin-bottom:12px; line-height:1.3; }
        .sigs { display:table; width:100%; margin-top:8px; }
        .sig { display:table-cell; text-align:center; width:50%; padding:0 10px; }
        .firma-img { width:110px; height:45px; margin:0 auto 3px; }
        .line { border-top: 2px solid #1e293b; margin:0 12px 3px 12px; }
        .sname { font-weight:bold; font-size:9px; color:#1e293b; margin:2px 0; }
        .stitle { font-size:8px; color:#475569; }
    </style>
</head>
<body>
    <div class="cert">
        <div class="corner tl"></div><div class="corner tr"></div><div class="corner bl"></div><div class="corner br"></div>
        <div class="header">
            <div class="inst">TECNOLÓGICO NACIONAL DE MÉXICO</div>
            <div class="inst">INSTITUTO TECNOLÓGICO DE OAXACA</div>
            <div class="inst" style="font-size:10px; font-weight:normal;">Coordinación General Académica y de Innovación</div>
        </div>
        <div class="trophy">' . $info['emoji'] . '</div>
        <div class="title">RECONOCIMIENTO</div>
        <div class="subtitle">' . $info['texto'] . '</div>
        <div class="content">
            <div class="felicitacion">' . $info['felicitacion'] . '</div>
            <div class="otorga">El Tecnológico Nacional de México a través del<br>Instituto Tecnológico de Oaxaca otorga el presente reconocimiento</div>
            <div class="otorga" style="margin-top:6px;">A:</div>
            <div class="name">' . strtoupper($usuario->name) . '</div>
            <div class="desc">Por haber obtenido el <strong>' . $info['texto'] . '</strong> en el evento <strong>' . $proyecto->event->title . '</strong>, llevado a cabo el ' . $fechaEvento . ', con el proyecto <strong>' . $proyecto->title . '</strong> como integrante del equipo <strong>' . $proyecto->team->name . '</strong>. Su dedicación, creatividad y excelencia han sido ejemplares.</div>
        </div>
        <table class="tbl">
            <tr><td class="lbl">Evento:</td><td class="val">' . $proyecto->event->title . '</td></tr>
            <tr><td class="lbl">Proyecto:</td><td class="val">' . $proyecto->title . '</td></tr>
            <tr><td class="lbl">Equipo:</td><td class="val">' . $proyecto->team->name . ' (Líder: ' . $proyecto->team->leader->name . ')</td></tr>
            <tr><td class="lbl">Asesor:</td><td class="val">' . ($proyecto->advisor ? $proyecto->advisor->name : 'No asignado') . '</td></tr>
            <tr><td class="lbl">Posición:</td><td class="val"><strong style="color:' . $info['color'] . '; font-size:14px;">' . $info['texto'] . '</strong></td></tr>
            <tr><td class="lbl">Calificación Final:</td><td class="val"><span class="score">' . number_format($proyecto->final_score, 1) . ' / 100</span></td></tr>
        </table>
        <div class="footer">
            <div class="date"><strong>ATENTAMENTE</strong><br>"Piensa y Trabaja"<br>Oaxaca de Juárez, Oaxaca, ' . $fecha . '</div>
            <div class="sigs">
                <div class="sig">
                    <svg class="firma-img" viewBox="0 0 200 80" xmlns="http://www.w3.org/2000/svg">
                        <path d="M 15 50 Q 25 30, 35 50 Q 45 65, 55 45 Q 65 30, 75 50" stroke="#1e40af" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                        <path d="M 80 35 Q 90 25, 100 40 Q 110 55, 120 35" stroke="#1e40af" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                        <path d="M 125 45 L 135 35 L 145 50 L 155 30" stroke="#1e40af" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                        <circle cx="170" cy="40" r="12" stroke="#1e40af" stroke-width="2.5" fill="none"/>
                        <path d="M 163 40 L 177 40" stroke="#1e40af" stroke-width="2"/>
                    </svg>
                    <div class="line"></div>
                    <div class="sname">Dr. Carlos Iván Moreno Arellano</div>
                    <div class="stitle">Coordinador General Académico y de Innovación</div>
                </div>
                <div class="sig">
                    <svg class="firma-img" viewBox="0 0 200 80" xmlns="http://www.w3.org/2000/svg">
                        <path d="M 20 45 Q 30 25, 40 45 Q 50 60, 60 40 Q 70 25, 80 45" stroke="#1e40af" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                        <path d="M 85 30 Q 95 50, 105 35 Q 115 20, 125 40" stroke="#1e40af" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                        <path d="M 130 40 L 145 40 M 137.5 30 L 137.5 50" stroke="#1e40af" stroke-width="2.5" stroke-linecap="round"/>
                        <path d="M 150 35 Q 160 45, 170 30 Q 180 45, 190 35" stroke="#1e40af" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                    </svg>
                    <div class="line"></div>
                    <div class="sname">Dr. Ricardo Villanueva Lomelí</div>
                    <div class="stitle">Rector General</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>';
    }
}
