<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Project;
use App\Models\Event;
use App\Models\Notification;
use App\Models\ProjectComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Asesor\UpdatePerfilRequest;
use App\Http\Requests\Asesor\UpdatePasswordRequest;
use App\Http\Requests\Asesor\StoreComentarioRequest;
use Illuminate\Support\Facades\Hash;

class AsesorController extends Controller
{
    /**
     * Mostrar el dashboard del asesor
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Obtener PROYECTOS donde el asesor está asignado
        $misProyectos = Project::where('advisor_id', $user->id)
            ->with(['team.members', 'event'])
            ->get();
        
        // Obtener EQUIPOS de esos proyectos
        $equipos = $misProyectos->pluck('team')->unique('id')->filter();
        
        // Contar estadísticas
        $equiposCount = $equipos->count();
        $proyectosCount = $misProyectos->filter(function($proyecto) {
            return $proyecto->status !== 'completed';
        })->count();
        
        // Obtener EVENTOS donde tiene equipos asignados
        $eventosConEquipos = Event::whereIn('id', $misProyectos->pluck('event_id'))
            ->where(function($query) {
                $query->where('status', 'upcoming')
                      ->orWhere('status', 'ongoing');
            })
            ->count();
        
        // Solicitudes pendientes de asesoría
        $solicitudesPendientes = DB::table('advisor_requests')
            ->where('advisor_id', $user->id)
            ->where('status', 'pending')
            ->count();
        
        return view('asesor.dashboard', compact(
            'equiposCount',
            'proyectosCount',
            'eventosConEquipos',
            'solicitudesPendientes',
            'misProyectos',
            'equipos'
        ));
    }

    /**
     * Mostrar la lista de eventos donde tiene equipos
     */
    public function eventos()
    {
        $user = Auth::user();
        
        // Obtener eventos donde el asesor tiene proyectos asignados
        $eventosIds = Project::where('advisor_id', $user->id)->pluck('event_id')->unique();
        
        $eventos = Event::whereIn('id', $eventosIds)
            ->orderBy('event_start_date', 'desc')
            ->get();
        
        // Contar eventos por estado
        $todosCount = $eventos->count();
        $activosCount = $eventos->filter(function($evento) {
            return $evento->status === 'in_progress';
        })->count();
        $proximosCount = $eventos->filter(function($evento) {
            return $evento->status === 'upcoming';
        })->count();
        $finalizadosCount = $eventos->filter(function($evento) {
            return $evento->status === 'finished';
        })->count();
        
        return view('asesor.eventos', compact(
            'eventos',
            'todosCount',
            'activosCount',
            'proximosCount',
            'finalizadosCount'
        ));
    }

    /**
     * Mostrar el detalle de un evento
     */
    public function eventoDetalle($id)
    {
        $user = Auth::user();
        
        $evento = Event::with(['schedule'])->where('id', $id)->firstOrFail();
        
        // Equipos del asesor en este evento
        $misEquipos = Project::where('advisor_id', $user->id)
            ->where('event_id', $id)
            ->with('team.members')
            ->get()
            ->pluck('team');
        
        $equiposCount = $misEquipos->count();
        
        return view('asesor.evento-detalle', compact('evento', 'equiposCount', 'misEquipos'));
    }

    /**
     * Mostrar la lista de equipos que asesora
     */
    public function equipos()
    {
        $user = Auth::user();
        
        // Obtener PROYECTOS donde es asesor
        $proyectos = Project::where('advisor_id', $user->id)
            ->with(['team.members', 'event'])
            ->get();
        
        // Extraer equipos únicos
        $equipos = $proyectos->pluck('team')->unique('id')->filter();
        
        // Obtener SOLICITUDES PENDIENTES (equipos que me solicitan)
        $solicitudesPendientes = DB::table('advisor_requests')
            ->join('teams', 'advisor_requests.team_id', '=', 'teams.id')
            ->join('projects', 'advisor_requests.project_id', '=', 'projects.id')
            ->join('events', 'projects.event_id', '=', 'events.id')
            ->join('users', 'advisor_requests.requested_by', '=', 'users.id')
            ->where('advisor_requests.advisor_id', $user->id)
            ->where('advisor_requests.status', 'pending')
            ->select(
                'advisor_requests.*',
                'teams.name as team_name',
                'events.title as event_title',
                'users.name as requester_name'
            )
            ->get();
        
        return view('asesor.equipos', compact('equipos', 'proyectos', 'solicitudesPendientes'));
    }

    /**
     * Mostrar equipos disponibles (sin asesor)
     */
    public function equiposDisponibles()
    {
        $user = Auth::user();
        
        // Obtener proyectos sin asesor asignado
        $proyectosDisponibles = Project::whereNull('advisor_id')
            ->with(['team.members', 'event'])
            ->get();
        
        // Obtener solicitudes que el asesor ha enviado
        $misSolicitudesEnviadas = DB::table('advisor_requests')
            ->where('advisor_id', $user->id)
            ->where('requested_by', $user->id)
            ->whereIn('status', ['pending'])
            ->pluck('project_id')
            ->toArray();
        
        return view('asesor.equipos-disponibles', compact('proyectosDisponibles', 'misSolicitudesEnviadas'));
    }
    
    /**
     * Solicitar asesorar a un equipo
     */
    public function solicitarAsesorar(Request $request, $projectId)
    {
        $user = Auth::user();
        
        $proyecto = Project::with('team')->findOrFail($projectId);
        
        // Verificar que el proyecto no tenga asesor
        if ($proyecto->advisor_id) {
            return redirect()->back()->with('error', 'Este equipo ya tiene un asesor asignado');
        }
        
        // Verificar que no haya solicitado antes
        $solicitudExistente = DB::table('advisor_requests')
            ->where('project_id', $projectId)
            ->where('advisor_id', $user->id)
            ->where('requested_by', $user->id)
            ->where('status', 'pending')
            ->exists();
        
        if ($solicitudExistente) {
            return redirect()->back()->with('error', 'Ya enviaste una solicitud a este equipo');
        }
        
        // Crear solicitud
        DB::table('advisor_requests')->insert([
            'id' => \Illuminate\Support\Str::uuid(),
            'team_id' => $proyecto->team_id,
            'project_id' => $projectId,
            'advisor_id' => $user->id,
            'requested_by' => $user->id,
            'status' => 'pending',
            'message' => $request->input('mensaje', 'Me gustaría ser su asesor en este proyecto'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        // Notificar al líder del equipo
        $lider = DB::table('team_members')
            ->where('team_id', $proyecto->team_id)
            ->where('role', 'leader')
            ->first();
        
        if ($lider) {
            Notification::create([
                'user_id' => $lider->user_id,
                'type' => 'advisor_request',
                'title' => 'Solicitud de Asesoría',
                'message' => $user->name . ' quiere ser su asesor',
                'data' => json_encode(['team_id' => $proyecto->team_id])
            ]);
        }
        
        return redirect()->back()->with('success', 'Solicitud enviada al equipo correctamente');
    }

    /**
     * Aceptar solicitud de asesoría
     */
    public function aceptarSolicitud(Request $request, $solicitudId)
    {
        $user = Auth::user();
        
        $solicitud = DB::table('advisor_requests')
            ->where('id', $solicitudId)
            ->where('advisor_id', $user->id)
            ->where('status', 'pending')
            ->first();
        
        if (!$solicitud) {
            return redirect()->back()->with('error', 'Solicitud no encontrada');
        }
        
        // Actualizar solicitud
        DB::table('advisor_requests')
            ->where('id', $solicitudId)
            ->update([
                'status' => 'accepted',
                'response_message' => $request->input('mensaje', 'Solicitud aceptada'),
                'responded_at' => now(),
                'updated_at' => now()
            ]);
        
        // Asignar asesor al proyecto
        Project::where('id', $solicitud->project_id)
            ->update(['advisor_id' => $user->id]);
        
        // Crear notificación para el equipo
        $teamMembers = DB::table('team_members')
            ->where('team_id', $solicitud->team_id)
            ->pluck('user_id');
        
        foreach ($teamMembers as $memberId) {
            DB::table('notifications')->insert([
                'id' => \Illuminate\Support\Str::uuid(),
                'user_id' => $memberId,
                'type' => 'advisor_accepted',
                'title' => '¡Asesor asignado!',
                'message' => $user->name . ' aceptó ser su asesor',
                'data' => json_encode(['team_id' => $solicitud->team_id]),
                'is_read' => 0,
                'created_at' => now()->format('Y-m-d H:i:s')
            ]);
        }
        
        return redirect()->back()->with('success', 'Solicitud aceptada correctamente');
    }

    /**
     * Rechazar solicitud de asesoría
     */
    public function rechazarSolicitud(Request $request, $solicitudId)
    {
        $user = Auth::user();
        
        $solicitud = DB::table('advisor_requests')
            ->where('id', $solicitudId)
            ->where('advisor_id', $user->id)
            ->where('status', 'pending')
            ->first();
        
        if (!$solicitud) {
            return redirect()->back()->with('error', 'Solicitud no encontrada');
        }
        
        // Actualizar solicitud
        DB::table('advisor_requests')
            ->where('id', $solicitudId)
            ->update([
                'status' => 'rejected',
                'response_message' => $request->input('mensaje', 'Solicitud rechazada'),
                'responded_at' => now(),
                'updated_at' => now()
            ]);
        
        return redirect()->back()->with('success', 'Solicitud rechazada');
    }

    /**
     * Mostrar la lista de proyectos
     */
    public function proyectos()
    {
        $user = Auth::user();
        
        // Obtener proyectos donde es asesor
        $proyectos = Project::where('advisor_id', $user->id)
            ->with(['team.members', 'event'])
            ->get();
        
        // Contar proyectos por estado correctamente usando filter
        $todosCount = $proyectos->count();
        $enProgresoCount = $proyectos->filter(function($proyecto) {
            return in_array($proyecto->status, ['draft', 'in_progress']);
        })->count();
        $entregadosCount = $proyectos->filter(function($proyecto) {
            return $proyecto->status === 'submitted';
        })->count();
        $evaluadosCount = $proyectos->filter(function($proyecto) {
            return $proyecto->status === 'evaluated';
        })->count();
        
        return view('asesor.proyectos', compact(
            'proyectos',
            'todosCount',
            'enProgresoCount',
            'entregadosCount',
            'evaluadosCount'
        ));
    }

    /**
     * Mostrar los rankings
     */
    public function rankings()
    {
        $user = Auth::user();
        
        // Obtener proyectos con puntajes de los equipos del asesor
        $rankings = Project::where('advisor_id', $user->id)
            ->with(['team.members', 'event'])
            ->whereNotNull('final_score')
            ->orderBy('rank', 'asc')
            ->get();
        
        return view('asesor.rankings', compact('rankings'));
    }

    /**
     * Mostrar el perfil del asesor
     */
    public function miPerfil()
    {
        $user = Auth::user();
        
        // Obtener estadísticas del asesor
        $equiposCount = Project::where('advisor_id', $user->id)
            ->distinct('team_id')
            ->count('team_id');
        
        $proyectosCount = Project::where('advisor_id', $user->id)->count();
        
        $eventosCount = Project::where('advisor_id', $user->id)
            ->distinct('event_id')
            ->count('event_id');
        
        return view('asesor.mi-perfil', compact('user', 'equiposCount', 'proyectosCount', 'eventosCount'));
    }

    /**
     * Mostrar detalle de un proyecto
     */
    public function proyectoDetalle($id)
    {
        $user = Auth::user();
        
        // Obtener proyecto con todas sus relaciones
        $proyecto = Project::where('id', $id)
            ->where('advisor_id', $user->id)
            ->with(['team.members', 'event'])
            ->firstOrFail();
        
        // Obtener comentarios del proyecto
        $comentarios = ProjectComment::where('project_id', $id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('asesor.proyecto-detalle', compact('proyecto', 'comentarios'));
    }

    /**
     * Agregar comentario a un proyecto
     */
    public function agregarComentario(StoreComentarioRequest $request, $id)
    {
        $user = Auth::user();
        
        // Verificar que el proyecto existe y es del asesor
        $proyecto = Project::where('id', $id)
            ->where('advisor_id', $user->id)
            ->firstOrFail();
        
        // Crear comentario
        $comentario = ProjectComment::create([
            'project_id' => $id,
            'user_id' => $user->id,
            'comment' => $request->comment,
            'created_at' => now()
        ]);
        
        // Notificar a los miembros del equipo
        $teamMembers = DB::table('team_members')
            ->where('team_id', $proyecto->team_id)
            ->pluck('user_id');
        
        foreach ($teamMembers as $memberId) {
            DB::table('notifications')->insert([
                'id' => \Illuminate\Support\Str::uuid(),
                'user_id' => $memberId,
                'type' => 'advisor_comment',
                'title' => 'Nuevo comentario del asesor',
                'message' => $user->name . ' comentó en ' . $proyecto->title,
                'data' => json_encode(['project_id' => $id]),
                'is_read' => 0,
                'created_at' => now()->format('Y-m-d H:i:s')
            ]);
        }
        
        return redirect()->back()->with('success', 'Comentario agregado correctamente');
    }
    /**
 * Actualizar perfil del asesor
 */
public function actualizarPerfil(UpdatePerfilRequest $request)
{
    $user = Auth::user();
    $user->update($request->validated());
    return redirect()->back()->with('success', 'Perfil actualizado correctamente');
}

/**
 * Actualizar contraseña del asesor
 */
public function actualizarPassword(UpdatePasswordRequest $request)
{
    $user = Auth::user();
    $user->password = Hash::make($request->password);
    $user->save();
    return redirect()->back()->with('success', 'Contraseña actualizada correctamente');
}
}
