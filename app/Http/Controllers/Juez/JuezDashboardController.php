<?php

namespace App\Http\Controllers\Juez;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Project;
use App\Models\Evaluation;
use App\Models\EvaluationScore;
use App\Models\Rubric;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JuezDashboardController extends Controller
{
    public function dashboard()
    {
        $userId = auth()->id();

        // Obtener evaluaciones pendientes (solo de eventos asignados)
        $pendingEvaluations = Project::whereHas('event', function($query) use ($userId) {
            $query->where('status', 'in_progress')
                  ->whereHas('judgeAssignments', function($q) use ($userId) {
                      $q->where('judge_id', $userId)
                        ->where('status', 'active');
                  });
        })
        ->whereDoesntHave('evaluations', function($query) use ($userId) {
            $query->where('judge_id', $userId)
                  ->where('status', 'completed');
        })
        ->where('status', 'submitted')
        ->count();

        // Obtener evaluaciones completadas
        $completedEvaluations = Evaluation::where('judge_id', $userId)
            ->where('status', 'completed')
            ->count();

        // Obtener eventos asignados (todos los eventos donde el juez está asignado activamente)
        $assignedEvents = Event::whereHas('judgeAssignments', function($query) use ($userId) {
                $query->where('judge_id', $userId)
                      ->where('status', 'active');
            })
            ->count();

        // Calcular promedio de calificaciones otorgadas
        $averageScore = Evaluation::where('judge_id', $userId)
            ->where('status', 'completed')
            ->avg('total_score') ?? 0;

        // Obtener proyectos pendientes de evaluar (solo de eventos asignados)
        $pendingProjects = Project::with(['team.leader', 'event'])
            ->whereHas('event', function($query) use ($userId) {
                // Solo eventos donde el juez está asignado
                $query->where('status', 'in_progress')
                      ->whereHas('judgeAssignments', function($q) use ($userId) {
                          $q->where('judge_id', $userId)
                            ->where('status', 'active');
                      });
            })
            ->whereDoesntHave('evaluations', function($query) use ($userId) {
                $query->where('judge_id', $userId)
                      ->where('status', 'completed');
            })
            ->where('status', 'submitted')
            ->take(5)
            ->get();

        // Calcular promedios por criterio
        $criteriaAverages = EvaluationScore::whereHas('evaluation', function($query) use ($userId) {
            $query->where('judge_id', $userId)
                  ->where('status', 'completed');
        })
        ->with('criterion')
        ->get()
        ->groupBy(function($item) {
            return $item->criterion ? $item->criterion->name : 'Sin nombre';
        })
        ->map(function($scores) {
            return round($scores->avg('score'), 1);
        });

        return view('juez.dashboard', compact(
            'pendingEvaluations',
            'completedEvaluations',
            'assignedEvents',
            'averageScore',
            'pendingProjects',
            'criteriaAverages'
        ));
    }

    public function eventos(Request $request)
    {
        $userId = auth()->id();
        $search = $request->get('search');
        $status = $request->get('status');

        // Obtener eventos donde el juez está asignado
        $query = Event::withCount(['projects' => function($query) {
                $query->where('status', 'submitted');
            }])
            ->with(['projects' => function($query) use ($userId) {
                $query->whereHas('evaluations', function($q) use ($userId) {
                    $q->where('judge_id', $userId)
                      ->where('status', 'completed');
                });
            }])
            // IMPORTANTE: Solo eventos donde el juez está asignado
            ->whereHas('judgeAssignments', function($query) use ($userId) {
                $query->where('judge_id', $userId)
                      ->where('status', 'active');
            })
            ;

        // Aplicar filtro de búsqueda
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        // Aplicar filtro de estado
        if ($status) {
            $query->where('status', $status);
        }

        $events = $query->orderBy('event_start_date', 'desc')
            ->get();

        // Calcular progreso de evaluación para cada evento
        $events = $events->map(function($event) use ($userId) {
            $totalProjects = $event->projects_count;
            $evaluatedProjects = Evaluation::whereHas('project', function($query) use ($event) {
                $query->where('event_id', $event->id);
            })
            ->where('judge_id', $userId)
            ->where('status', 'completed')
            ->count();

            $event->evaluated_projects_count = $evaluatedProjects;
            $event->evaluation_progress = $totalProjects > 0 
                ? round(($evaluatedProjects / $totalProjects) * 100) 
                : 0;

            return $event;
        });

        return view('juez.eventos', compact('events'));
    }

    public function evaluaciones(Request $request)
    {
        $userId = auth()->id();
        $filter = $request->get('filter', 'pending');

        // Estadísticas
        $pendingCount = Project::whereHas('event', function($query) {
            $query->where('status', 'in_progress');
        })
        ->whereDoesntHave('evaluations', function($query) use ($userId) {
            $query->where('judge_id', $userId)
                  ->where('status', 'completed');
        })
        ->where('status', 'submitted')
        ->count();

        $completedCount = Evaluation::where('judge_id', $userId)
            ->where('status', 'completed')
            ->count();

        $averageScore = Evaluation::where('judge_id', $userId)
            ->where('status', 'completed')
            ->avg('total_score') ?? 0;

        // Evaluaciones según filtro
        if ($filter === 'pending') {
            $evaluations = Project::with(['team.leader', 'event', 'advisor'])
                ->whereHas('event', function($query) {
                    $query->where('status', 'in_progress');
                })
                ->whereDoesntHave('evaluations', function($query) use ($userId) {
                    $query->where('judge_id', $userId)
                          ->where('status', 'completed');
                })
                ->where('status', 'submitted')
                ->latest()
                ->paginate(10);

            $isPending = true;
        } elseif ($filter === 'completed') {
            $query = Evaluation::with(['project.team.leader', 'project.event', 'project.advisor', 'scores.criterion'])
                ->where('judge_id', $userId)
                ->where('status', 'completed');

            $evaluations = $query->latest('completed_at')->paginate(10);
            $isPending = false;
        } else {
            // Para "all", obtenemos tanto pendientes como completadas
            // Obtenemos proyectos pendientes
            $pendingProjects = Project::with(['team.leader', 'event', 'advisor'])
                ->whereHas('event', function($query) {
                    $query->where('status', 'in_progress');
                })
                ->whereDoesntHave('evaluations', function($query) use ($userId) {
                    $query->where('judge_id', $userId)
                          ->where('status', 'completed');
                })
                ->where('status', 'submitted')
                ->latest()
                ->get()
                ->map(function($project) {
                    $project->item_type = 'pending';
                    $project->sort_date = $project->updated_at;
                    return $project;
                });

            // Obtenemos evaluaciones completadas
            $completedEvaluations = Evaluation::with(['project.team.leader', 'project.event', 'project.advisor', 'scores.criterion'])
                ->where('judge_id', $userId)
                ->where('status', 'completed')
                ->latest('completed_at')
                ->get()
                ->map(function($evaluation) {
                    $evaluation->item_type = 'completed';
                    $evaluation->sort_date = $evaluation->completed_at;
                    return $evaluation;
                });

            // Combinar y ordenar por fecha
            $allItems = $pendingProjects->concat($completedEvaluations)
                ->sortByDesc('sort_date')
                ->values();

            // Paginación manual
            $perPage = 10;
            $currentPage = request()->get('page', 1);
            $offset = ($currentPage - 1) * $perPage;
            
            $items = $allItems->slice($offset, $perPage)->values();
            
            $evaluations = new \Illuminate\Pagination\LengthAwarePaginator(
                $items,
                $allItems->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );
            
            $isPending = 'mixed';
        }

        return view('juez.evaluaciones', compact(
            'evaluations',
            'isPending',
            'filter',
            'pendingCount',
            'completedCount',
            'averageScore'
        ));
    }

    public function evaluarProyecto($projectId)
    {
        $project = Project::with(['team.members', 'team.leader', 'event.rubrics.criteria'])
            ->findOrFail($projectId);

        // Verificar si ya fue evaluado por este juez
        $existingEvaluation = Evaluation::where('project_id', $projectId)
            ->where('judge_id', auth()->id())
            ->where('status', 'completed')
            ->first();

        if ($existingEvaluation) {
            return redirect()->route('juez.evaluaciones')
                ->with('error', 'Este proyecto ya ha sido evaluado por ti.');
        }

        // Obtener la rúbrica del evento
        $rubric = $project->event->rubrics()->with('criteria')->first();

        if (!$rubric) {
            return redirect()->route('juez.evaluaciones')
                ->with('error', 'Este evento no tiene una rúbrica de evaluación configurada.');
        }

        return view('juez.evaluar-proyecto', compact('project', 'rubric'));
    }

    public function guardarEvaluacion(Request $request, $projectId)
    {
        $project = Project::with('event.rubrics.criteria')->findOrFail($projectId);
        $rubric = $project->event->rubrics()->first();

        if (!$rubric) {
            return redirect()->back()->with('error', 'No se encontró la rúbrica de evaluación.');
        }

        // Validar scores dinámicamente según los max_points de cada criterio
        $rules = [
            'scores' => 'required|array',
            'comments' => 'nullable|string|max:1000',
        ];

        // Agregar reglas específicas para cada criterio
        foreach ($rubric->criteria as $criterion) {
            $rules["scores.{$criterion->id}"] = "required|numeric|min:0|max:{$criterion->max_points}";
        }

        $request->validate($rules);

        // Crear la evaluación
        $evaluation = Evaluation::create([
            'id' => (string) Str::uuid(),
            'project_id' => $projectId,
            'judge_id' => auth()->id(),
            'rubric_id' => $rubric->id,
            'total_score' => 0, // Se calculará después
            'comments' => $request->comments,
            'status' => 'completed',
            'started_at' => now(),
            'completed_at' => now(),
        ]);

        // Guardar las calificaciones por criterio y calcular total
        $totalScore = 0;
        $maxPossibleScore = 0;

        foreach ($request->scores as $criterionId => $score) {
            $criterion = $rubric->criteria->find($criterionId);
            
            EvaluationScore::create([
                'id' => (string) Str::uuid(),
                'evaluation_id' => $evaluation->id,
                'criterion_id' => $criterionId,
                'score' => $score,
            ]);

            $totalScore += $score;
            $maxPossibleScore += $criterion->max_points;
        }

        // Normalizar el score a escala de 100
        $normalizedScore = $maxPossibleScore > 0 ? ($totalScore / $maxPossibleScore) * 100 : 0;
        
        $evaluation->update(['total_score' => round($normalizedScore, 2)]);

        // Actualizar el proyecto
        $project->update([
            'status' => 'in_review',
            'evaluated_at' => now(),
        ]);

        // Recalcular el score final del proyecto si todas las evaluaciones están completas
        $this->updateProjectFinalScore($project);

        return redirect()->route('juez.evaluaciones')
            ->with('success', 'Evaluación guardada exitosamente.');
    }

    private function updateProjectFinalScore(Project $project)
    {
        $completedEvaluations = $project->evaluations()
            ->where('status', 'completed')
            ->count();

        // Si hay al menos una evaluación completa, calcular el promedio
        if ($completedEvaluations > 0) {
            $averageScore = $project->evaluations()
                ->where('status', 'completed')
                ->avg('total_score');

            $project->update([
                'final_score' => $averageScore,
                'status' => 'evaluated',
            ]);
        }
    }

    public function rankings(Request $request)
    {
        $eventId = $request->get('event_id');
        $category = $request->get('category');

        // Obtener eventos para el selector
        $events = Event::published()
            ->whereHas('projects', function($query) {
                $query->where('status', 'evaluated');
            })
            ->orderBy('event_start_date', 'desc')
            ->get();

        // Seleccionar el evento por defecto (el más reciente con proyectos evaluados)
        if (!$eventId && $events->isNotEmpty()) {
            $eventId = $events->first()->id;
        }

        // Obtener proyectos del evento seleccionado
        $query = Project::with(['team.leader', 'team.members', 'event', 'evaluations.scores.criterion'])
            ->where('status', 'evaluated')
            ->whereNotNull('final_score');

        if ($eventId) {
            $query->where('event_id', $eventId);
        }

        if ($category) {
            $query->whereHas('event', function($q) use ($category) {
                $q->where('category', $category);
            });
        }

        $projects = $query->orderBy('final_score', 'desc')
            ->get();

        // Asignar rankings
        $projects = $projects->map(function($project, $index) {
            $project->display_rank = $index + 1;
            
            // Calcular promedios por criterio
            $criteriaScores = [];
            foreach ($project->evaluations as $evaluation) {
                foreach ($evaluation->scores as $score) {
                    $criterionName = $score->criterion->name;
                    if (!isset($criteriaScores[$criterionName])) {
                        $criteriaScores[$criterionName] = [];
                    }
                    $criteriaScores[$criterionName][] = $score->score;
                }
            }

            $project->criteria_averages = collect($criteriaScores)->map(function($scores) {
                return round(array_sum($scores) / count($scores), 1);
            });

            return $project;
        });

        $selectedEvent = $eventId ? Event::find($eventId) : null;

        return view('juez.rankings', compact('projects', 'events', 'selectedEvent', 'eventId', 'category'));
    }

    public function perfil()
    {
        $user = auth()->user();
        $userId = $user->id;

        // Estadísticas del juez
        $totalEvaluations = Evaluation::where('judge_id', $userId)
            ->where('status', 'completed')
            ->count();

        $eventsParticipated = Event::whereHas('projects.evaluations', function($query) use ($userId) {
            $query->where('judge_id', $userId)
                  ->where('status', 'completed');
        })->count();

        $averageScore = Evaluation::where('judge_id', $userId)
            ->where('status', 'completed')
            ->avg('total_score') ?? 0;

        return view('juez.perfil', compact(
            'user',
            'totalEvaluations',
            'eventsParticipated',
            'averageScore'
        ));
    }

    public function updatePerfil(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'bio' => 'nullable|string|max:500',
        ]);

        $user->update($request->only(['name', 'email', 'bio']));

        return redirect()->back()->with('success', 'Perfil actualizado exitosamente.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!\Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'La contraseña actual no es correcta.');
        }

        $user->update([
            'password' => \Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Contraseña actualizada exitosamente.');
    }
}
