<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Team;
use App\Models\Project;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Equipos del estudiante
        $equipos = Team::whereHas('members', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with(['event', 'leader', 'project'])->latest()->get();

        // Proyectos del estudiante
        $proyectos = Project::whereIn('team_id', $equipos->pluck('id'))
                           ->with(['team.event'])
                           ->latest()
                           ->get();

        // Eventos activos (abiertos para registro)
        $eventosActivos = Event::where('is_published', true)
                              ->where('status', 'open')
                              ->latest()
                              ->limit(3)
                              ->get();

        // Próximos eventos
        $proximosEventos = Event::where('is_published', true)
                                ->where('status', 'upcoming')
                                ->orderBy('event_start_date')
                                ->limit(2)
                                ->get();

        // Notificaciones recientes
        $notificaciones = Notification::where('user_id', $user->id)
                                     ->orderBy('created_at', 'desc')
                                     ->limit(5)
                                     ->get();

        // Estadísticas
        $stats = [
            'total_equipos' => $equipos->count(),
            'total_proyectos' => $proyectos->count(),
            'proyectos_evaluados' => $proyectos->where('status', 'evaluated')->count(),
            'promedio_puntuacion' => round($proyectos->where('status', 'evaluated')->avg('final_score') ?? 0, 1),
            'mejor_posicion' => $proyectos->where('rank', '!=', null)->min('rank') ?? '-',
        ];

        // Proyecto destacado (mejor puntuación)
        $proyectoDestacado = $proyectos->where('status', 'evaluated')
                                      ->sortByDesc('final_score')
                                      ->first();

        // Actividad reciente
        $actividadReciente = $this->getActividadReciente($user, $equipos, $proyectos);

        return view('estudiante.dashboard', compact(
            'user',
            'equipos',
            'proyectos',
            'eventosActivos',
            'proximosEventos',
            'notificaciones',
            'stats',
            'proyectoDestacado',
            'actividadReciente'
        ));
    }

    private function getActividadReciente($user, $equipos, $proyectos)
    {
        $actividades = collect();

        // Equipos recientes
        foreach ($equipos->take(3) as $equipo) {
            $actividades->push([
                'tipo' => 'equipo',
                'icono' => 'users',
                'titulo' => 'Te uniste al equipo',
                'descripcion' => $equipo->name,
                'fecha' => $equipo->created_at,
                'url' => route('estudiante.equipos.show', $equipo->id),
            ]);
        }

        // Proyectos recientes
        foreach ($proyectos->take(3) as $proyecto) {
            $actividades->push([
                'tipo' => 'proyecto',
                'icono' => 'file',
                'titulo' => 'Proyecto creado',
                'descripcion' => $proyecto->title,
                'fecha' => $proyecto->created_at,
                'url' => route('estudiante.proyectos.show', $proyecto->id),
            ]);
        }

        return $actividades->sortByDesc('fecha')->take(5);
    }
}
