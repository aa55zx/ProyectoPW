<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Team;
use App\Models\JoinRequest;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EventoController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::where('is_published', true);

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('date_range')) {
            $range = $request->date_range;
            $now = now();
            
            if ($range === 'this_month') {
                $query->whereBetween('event_start_date', [$now->startOfMonth(), $now->endOfMonth()]);
            } elseif ($range === 'next_month') {
                $query->whereBetween('event_start_date', [$now->addMonth()->startOfMonth(), $now->addMonth()->endOfMonth()]);
            }
        }

        $eventos = $query->with(['teams'])->orderBy('event_start_date', 'desc')->get();

        if ($request->ajax()) {
            return response()->json($eventos);
        }

        return view('estudiante.eventos', compact('eventos'));
    }

    public function show($id)
    {
        $evento = Event::with(['schedule' => function($query) {
            $query->orderBy('day')->orderBy('order_index');
        }])->findOrFail($id);

        $evento->increment('views_count');

        $user = Auth::user();
        
        // Verificar si ya tiene equipo en este evento
        $miEquipo = Team::where('event_id', $id)
                        ->whereHas('members', function($query) use ($user) {
                            $query->where('user_id', $user->id);
                        })
                        ->with(['leader', 'members'])
                        ->first();

        // Obtener equipos del evento con información de líder y miembros
        $equiposInscritos = Team::where('event_id', $id)
                                ->where('status', 'active')
                                ->with(['leader', 'members'])
                                ->withCount('members')
                                ->get();

        // Obtener solicitudes pendientes del usuario para este evento
        $solicitudesPendientes = [];
        if (!$miEquipo) {
            $solicitudesPendientes = \DB::table('join_requests')
                                        ->where('user_id', $user->id)
                                        ->where('status', 'pending')
                                        ->whereIn('team_id', $equiposInscritos->pluck('id'))
                                        ->pluck('team_id')
                                        ->toArray();
        }

        return view('estudiante.evento-detalle', compact('evento', 'miEquipo', 'equiposInscritos', 'solicitudesPendientes'));
    }

    public function registrarEquipo(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'team_name' => 'required|string|max:255',
            'team_description' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        $evento = Event::findOrFail($request->event_id);

        $equipoExistente = Team::where('event_id', $request->event_id)
                                ->whereHas('members', function($query) use ($user) {
                                    $query->where('user_id', $user->id);
                                })
                                ->first();

        if ($equipoExistente) {
            return response()->json([
                'success' => false,
                'message' => 'Ya eres miembro de un equipo en este evento'
            ], 422);
        }

        if ($evento->max_teams && $evento->registered_teams_count >= $evento->max_teams) {
            return response()->json([
                'success' => false,
                'message' => 'El evento ha alcanzado el límite máximo de equipos'
            ], 422);
        }

        try {
            $teamId = Str::uuid();
            $team = Team::create([
                'id' => $teamId,
                'name' => $request->team_name,
                'description' => $request->team_description,
                'event_id' => $request->event_id,
                'leader_id' => $user->id,
                'status' => 'active',
                'members_count' => 1,
            ]);

            \DB::table('team_members')->insert([
                'id' => Str::uuid(),
                'team_id' => $teamId,
                'user_id' => $user->id,
                'role' => 'leader',
                'joined_at' => now(),
            ]);

            $evento->increment('registered_teams_count');

            return response()->json([
                'success' => true,
                'message' => 'Equipo registrado exitosamente',
                'team' => $team,
                'redirect' => route('estudiante.equipos')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el equipo: ' . $e->getMessage()
            ], 500);
        }
    }

    public function solicitarUnirse(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
        ]);

        $user = Auth::user();
        $team = Team::with(['event', 'leader'])->findOrFail($request->team_id);

        // Verificar si ya tiene equipo en este evento
        $equipoExistente = Team::where('event_id', $team->event_id)
                                ->whereHas('members', function($query) use ($user) {
                                    $query->where('user_id', $user->id);
                                })
                                ->first();

        if ($equipoExistente) {
            return response()->json([
                'success' => false,
                'message' => 'Ya eres miembro de un equipo en este evento'
            ], 422);
        }

        // Verificar si ya envió solicitud
        $solicitudExistente = \DB::table('join_requests')
                                 ->where('team_id', $team->id)
                                 ->where('user_id', $user->id)
                                 ->where('status', 'pending')
                                 ->first();

        if ($solicitudExistente) {
            return response()->json([
                'success' => false,
                'message' => 'Ya enviaste una solicitud a este equipo'
            ], 422);
        }

        // Verificar si el equipo está lleno
        if ($team->members_count >= $team->event->max_team_size) {
            return response()->json([
                'success' => false,
                'message' => 'El equipo ya está completo'
            ], 422);
        }

        try {
            // Crear solicitud
            \DB::table('join_requests')->insert([
                'id' => Str::uuid(),
                'team_id' => $team->id,
                'user_id' => $user->id,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Crear notificación para el líder
            Notification::create([
                'id' => Str::uuid(),
                'user_id' => $team->leader_id,
                'type' => 'join_request',
                'title' => 'Nueva solicitud de unión',
                'message' => $user->name . ' quiere unirse a tu equipo "' . $team->name . '"',
                'data' => json_encode([
                    'team_id' => $team->id,
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'team_name' => $team->name,
                ]),
                'is_read' => false,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Solicitud enviada al líder del equipo'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al enviar solicitud: ' . $e->getMessage()
            ], 500);
        }
    }
}
