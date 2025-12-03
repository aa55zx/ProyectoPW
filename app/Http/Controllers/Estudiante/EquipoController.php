<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EquipoController extends Controller
{
    /**
     * Mostrar lista de equipos del usuario
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $query = Team::whereHas('members', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with(['event', 'leader', 'members']);

        // Filtro por evento
        if ($request->filled('event_id') && $request->event_id !== 'all') {
            $query->where('event_id', $request->event_id);
        }

        // Filtro por rol
        if ($request->filled('role')) {
            if ($request->role === 'leader') {
                $query->where('leader_id', $user->id);
            }
        }

        $equipos = $query->get();
        $eventos = Event::where('is_published', true)->get();

        // Si es petición AJAX, retornar JSON
        if ($request->ajax()) {
            return response()->json([
                'equipos' => $equipos,
                'count' => $equipos->count()
            ]);
        }

        return view('estudiante.equipos', compact('equipos', 'eventos'));
    }

    /**
     * Crear nuevo equipo
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'event_id' => 'required|exists:events,id',
        ], [
            'name.required' => 'El nombre del equipo es obligatorio',
            'event_id.required' => 'Debes seleccionar un evento',
            'event_id.exists' => 'El evento seleccionado no existe',
        ]);

        $user = Auth::user();
        $evento = Event::findOrFail($request->event_id);

        // Verificar si ya tiene un equipo en este evento
        $equipoExistente = Team::where('event_id', $request->event_id)
                                ->whereHas('members', function($query) use ($user) {
                                    $query->where('user_id', $user->id);
                                })
                                ->first();

        if ($equipoExistente) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ya tienes un equipo en este evento'
                ], 422);
            }
            return back()->withErrors(['event_id' => 'Ya tienes un equipo en este evento']);
        }

        // Verificar límite de equipos del evento
        if ($evento->max_teams && $evento->registered_teams_count >= $evento->max_teams) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'El evento ha alcanzado el límite de equipos'
                ], 422);
            }
            return back()->withErrors(['event_id' => 'El evento ha alcanzado el límite de equipos']);
        }

        try {
            // Crear equipo
            $teamId = Str::uuid();
            $team = Team::create([
                'id' => $teamId,
                'name' => $request->name,
                'description' => $request->description,
                'event_id' => $request->event_id,
                'leader_id' => $user->id,
                'status' => 'active',
                'invitation_code' => strtoupper(substr(md5(rand()), 0, 6)),
                'members_count' => 1,
            ]);

            // Agregar al usuario como líder
            \DB::table('team_members')->insert([
                'id' => Str::uuid(),
                'team_id' => $teamId,
                'user_id' => $user->id,
                'role' => 'leader',
                'joined_at' => now(),
            ]);

            // Incrementar contador en el evento
            $evento->increment('registered_teams_count');

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Equipo creado exitosamente',
                    'team' => $team->load(['event', 'leader', 'members']),
                ]);
            }

            return redirect()->route('estudiante.equipos')->with('success', 'Equipo creado exitosamente');

        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al crear el equipo: ' . $e->getMessage()
                ], 500);
            }
            return back()->withErrors(['error' => 'Error al crear el equipo'])->withInput();
        }
    }

    /**
     * Ver detalle de un equipo
     */
    public function show($id)
    {
        $user = Auth::user();
        $equipo = Team::with(['event', 'leader', 'members', 'project'])->findOrFail($id);

        // Verificar que el usuario sea miembro del equipo
        if (!$equipo->isMember($user->id) && !$equipo->isLeader($user->id)) {
            abort(403, 'No tienes permiso para ver este equipo');
        }

        return view('estudiante.equipo-detalle', compact('equipo'));
    }

    /**
     * Abandonar un equipo
     */
    public function leave($id)
    {
        $user = Auth::user();
        $equipo = Team::with('members')->findOrFail($id);

        // Verificar que el usuario sea miembro
        if (!$equipo->isMember($user->id)) {
            return response()->json([
                'success' => false,
                'message' => 'No eres miembro de este equipo'
            ], 403);
        }

        // El líder no puede abandonar si hay otros miembros
        if ($equipo->isLeader($user->id) && $equipo->members_count > 1) {
            return response()->json([
                'success' => false,
                'message' => 'Como líder, debes transferir el liderazgo o eliminar a los miembros antes de salir'
            ], 422);
        }

        try {
            // Eliminar al usuario del equipo
            \DB::table('team_members')
                ->where('team_id', $id)
                ->where('user_id', $user->id)
                ->delete();

            // Actualizar contador
            $equipo->decrement('members_count');

            // Si era el líder y era el último miembro, eliminar el equipo
            if ($equipo->members_count == 0) {
                $equipo->delete();
                // Decrementar contador del evento
                $equipo->event->decrement('registered_teams_count');
            }

            return response()->json([
                'success' => true,
                'message' => 'Has abandonado el equipo exitosamente'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al abandonar el equipo: ' . $e->getMessage()
            ], 500);
        }
    }
}
