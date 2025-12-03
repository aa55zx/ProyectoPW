<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EventoController extends Controller
{
    /**
     * Mostrar lista de eventos
     */
    public function index(Request $request)
    {
        $query = Event::where('is_published', true);

        // Filtro por categoría
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Filtro por estado
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Búsqueda por texto
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filtro por fechas
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

        // Si es petición AJAX, retornar JSON
        if ($request->ajax()) {
            return response()->json($eventos);
        }

        return view('estudiante.eventos', compact('eventos'));
    }

    /**
     * Mostrar detalle de un evento
     */
    public function show($id)
    {
        $evento = Event::with(['schedule' => function($query) {
            $query->orderBy('day')->orderBy('order_index');
        }, 'teams'])->findOrFail($id);

        // Incrementar contador de vistas
        $evento->increment('views_count');

        // Verificar si el usuario ya tiene un equipo en este evento
        $user = Auth::user();
        $miEquipo = Team::where('event_id', $id)
                        ->whereHas('members', function($query) use ($user) {
                            $query->where('user_id', $user->id);
                        })
                        ->first();

        return view('estudiante.evento-detalle', compact('evento', 'miEquipo'));
    }

    /**
     * Registrar un nuevo equipo en un evento
     */
    public function registrarEquipo(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'team_name' => 'required|string|max:255',
            'team_description' => 'nullable|string|max:1000',
        ], [
            'event_id.required' => 'El evento es obligatorio',
            'event_id.exists' => 'El evento no existe',
            'team_name.required' => 'El nombre del equipo es obligatorio',
            'team_name.max' => 'El nombre es demasiado largo',
        ]);

        $user = Auth::user();
        $evento = Event::findOrFail($request->event_id);

        // Verificar si el usuario ya tiene un equipo en este evento
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

        // Verificar límite de equipos
        if ($evento->max_teams && $evento->registered_teams_count >= $evento->max_teams) {
            return response()->json([
                'success' => false,
                'message' => 'El evento ha alcanzado el límite máximo de equipos'
            ], 422);
        }

        try {
            // Crear el equipo
            $teamId = Str::uuid();
            $team = Team::create([
                'id' => $teamId,
                'name' => $request->team_name,
                'description' => $request->team_description,
                'event_id' => $request->event_id,
                'leader_id' => $user->id,
                'status' => 'active',
                'invitation_code' => strtoupper(substr(md5(rand()), 0, 6)),
                'members_count' => 1,
            ]);

            // Agregar al usuario como líder del equipo
            \DB::table('team_members')->insert([
                'id' => Str::uuid(),
                'team_id' => $teamId,
                'user_id' => $user->id,
                'role' => 'leader',
                'joined_at' => now(),
            ]);

            // Incrementar contador de equipos registrados
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
}
