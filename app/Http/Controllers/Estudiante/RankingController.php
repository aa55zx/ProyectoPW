<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{
    /**
     * Mostrar rankings globales y del usuario
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Obtener eventos con proyectos evaluados
        $eventos = Event::where('is_published', true)
                       ->whereHas('projects', function($q) {
                           $q->where('status', 'evaluated')
                             ->whereNotNull('final_score');
                       })
                       ->withCount('projects')
                       ->get();
        
        // Evento seleccionado (por defecto el primero)
        $eventoId = $request->get('event_id', $eventos->first()?->id);
        $eventoSeleccionado = Event::find($eventoId);
        
        // Obtener proyectos del evento seleccionado ordenados por puntuación
        $proyectosRanking = collect();
        $miProyecto = null;
        $miPosicion = null;
        
        if ($eventoSeleccionado) {
            $proyectosRanking = Project::where('event_id', $eventoSeleccionado->id)
                                      ->where('status', 'evaluated')
                                      ->whereNotNull('final_score')
                                      ->with(['team.leader', 'team.members'])
                                      ->orderBy('final_score', 'desc')
                                      ->get()
                                      ->map(function($proyecto, $index) {
                                          $proyecto->rank = $index + 1;
                                          return $proyecto;
                                      });
            
            // Encontrar el proyecto del usuario
            $equiposUsuario = Team::whereHas('members', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->pluck('id');
            
            $miProyecto = $proyectosRanking->first(function($proyecto) use ($equiposUsuario) {
                return $equiposUsuario->contains($proyecto->team_id);
            });
            
            if ($miProyecto) {
                $miPosicion = $miProyecto->rank;
            }
        }
        
        // Estadísticas generales
        $stats = [
            'total_equipos' => Team::whereHas('members', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->count(),
            
            'proyectos_participados' => Project::whereIn('team_id', function($query) use ($user) {
                $query->select('team_id')
                      ->from('team_members')
                      ->where('user_id', $user->id);
            })->count(),
            
            'puntuacion_maxima' => Project::whereIn('team_id', function($query) use ($user) {
                $query->select('team_id')
                      ->from('team_members')
                      ->where('user_id', $user->id);
            })->max('final_score') ?? 0,
            
            'criterios_evaluados' => 4,
        ];
        
        // Top 3 para el podio
        $top3 = $proyectosRanking->take(3);
        
        return view('estudiante.rankings', compact(
            'eventos',
            'eventoSeleccionado',
            'proyectosRanking',
            'miProyecto',
            'miPosicion',
            'stats',
            'top3'
        ));
    }
    
    /**
     * Ver detalles de un proyecto en el ranking
     */
    public function verProyecto($id)
    {
        $proyecto = Project::with(['team.members', 'team.event', 'evaluations.judge.rubric'])
                          ->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'proyecto' => $proyecto,
        ]);
    }
}
