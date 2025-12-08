<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Project;
use App\Models\Event;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $proyectosCount = $misProyectos->where('status', '!=', 'completed')->count();
        
        // Obtener EVENTOS donde tiene equipos asignados
        $eventosConEquipos = Event::whereIn('id', $misProyectos->pluck('event_id'))
            ->where(function($query) {
                $query->where('status', 'upcoming')
                      ->orWhere('status', 'open');
            })
            ->count();
        
        // Solicitudes pendientes - NO usar tabla advisor_requests (no existe)
        $solicitudesPendientes = 0;
        
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
        $activosCount = $eventos->where('status', 'open')->count();
        $proximosCount = $eventos->where('status', 'upcoming')->count();
        $finalizadosCount = $eventos->where('status', 'finished')->count();
        
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
        
        // Solicitudes pendientes - NO usar tabla advisor_requests
        $solicitudesPendientes = collect();
        
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
        
        $misSolicitudesEnviadas = [];
        
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
        
        // Asignar directamente (sin sistema de solicitudes)
        $proyecto->advisor_id = $user->id;
        $proyecto->save();
        
        // Notificar al líder del equipo
        $lider = DB::table('team_members')
            ->where('team_id', $proyecto->team_id)
            ->where('role', 'leader')
            ->first();
        
        if ($lider) {
            Notification::create([
                'id' => \Illuminate\Support\Str::uuid(),
                'user_id' => $lider->user_id,
                'type' => 'advisor_assigned',
                'title' => 'Asesor Asignado',
                'message' => $user->name . ' ahora es su asesor',
                'data' => json_encode(['team_id' => $proyecto->team_id]),
                'is_read' => false,
            ]);
        }
        
        return redirect()->back()->with('success', 'Ahora eres asesor de este equipo');
    }

    /**
     * Aceptar solicitud de asesoría (deshabilitado - tabla no existe)
     */
    public function aceptarSolicitud(Request $request, $solicitudId)
    {
        return redirect()->back()->with('error', 'Función no disponible');
    }

    /**
     * Rechazar solicitud de asesoría (deshabilitado - tabla no existe)
     */
    public function rechazarSolicitud(Request $request, $solicitudId)
    {
        return redirect()->back()->with('error', 'Función no disponible');
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
        
        // Contar proyectos por estado
        $todosCount = $proyectos->count();
        $enProgresoCount = $proyectos->whereIn('status', ['draft', 'in_progress'])->count();
        $entregadosCount = $proyectos->where('status', 'submitted')->count();
        $evaluadosCount = $proyectos->where('status', 'evaluated')->count();
        
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
}
