<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Team;
use App\Models\Project;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Mostrar el dashboard del estudiante
     */
    public function index()
    {
        $user = Auth::user();

        // Obtener equipos del estudiante
        $teams = $user->teams()
                     ->with(['event', 'leader'])
                     ->latest()
                     ->get();

        // Obtener proyectos del estudiante
        $projects = Project::whereIn('team_id', $teams->pluck('id'))
                          ->with(['team', 'event'])
                          ->latest()
                          ->get();

        // Obtener eventos activos
        $activeEvents = Event::published()
                            ->where('status', 'in_progress')
                            ->latest()
                            ->limit(1)
                            ->get();

        // Obtener próximos eventos
        $upcomingEvents = Event::published()
                              ->whereIn('status', ['open', 'draft'])
                              ->where('event_start_date', '>=', now())
                              ->orderBy('event_start_date')
                              ->limit(2)
                              ->get();

        // Obtener notificaciones recientes no leídas
        $notificationsCount = $user->notifications()->unread()->count();
        
        $notifications = $user->notifications()
                             ->orderBy('created_at', 'desc')
                             ->limit(3)
                             ->get();

        // Obtener logros del usuario
        $achievements = $user->achievements()->latest()->limit(2)->get();

        // Calcular estadísticas
        $stats = [
            'total_events' => $teams->count(),
            'total_projects' => $projects->count(),
            'average_score' => round($projects->where('status', 'evaluated')->avg('final_score') ?? 0, 1),
            'total_teams' => $teams->count(),
        ];

        return view('estudiante.dashboard', compact(
            'user',
            'teams',
            'projects',
            'activeEvents',
            'upcomingEvents',
            'notifications',
            'notificationsCount',
            'achievements',
            'stats'
        ));
    }
}
