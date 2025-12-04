<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Event;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class EquipoController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $query = Team::whereHas('members', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with(['event', 'leader', 'members']);

        if ($request->filled('event_id') && $request->event_id !== 'all') {
            $query->where('event_id', $request->event_id);
        }

        if ($request->filled('role') && $request->role === 'leader') {
            $query->where('leader_id', $user->id);
        }

        $equipos = $query->get();
        $eventos = Event::where('is_published', true)->get();

        if ($request->ajax()) {
            return response()->json(['equipos' => $equipos, 'count' => $equipos->count()]);
        }

        return view('estudiante.equipos', compact('equipos', 'eventos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'team_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'event_id' => 'required|exists:events,id',
        ]);

        $user = Auth::user();
        $evento = Event::findOrFail($request->event_id);

        $equipoExistente = Team::where('event_id', $request->event_id)
                                ->whereHas('members', function($query) use ($user) {
                                    $query->where('user_id', $user->id);
                                })
                                ->first();

        if ($equipoExistente) {
            return response()->json(['success' => false, 'message' => 'Ya tienes un equipo en este evento'], 422);
        }

        if ($evento->max_teams && $evento->registered_teams_count >= $evento->max_teams) {
            return response()->json(['success' => false, 'message' => 'Límite de equipos alcanzado'], 422);
        }

        try {
            $teamId = Str::uuid();
            $team = Team::create([
                'id' => $teamId,
                'name' => $request->team_name,
                'description' => $request->description,
                'event_id' => $request->event_id,
                'leader_id' => $user->id,
                'status' => 'active',
                'members_count' => 1,
            ]);

            DB::table('team_members')->insert([
                'id' => Str::uuid(),
                'team_id' => $teamId,
                'user_id' => $user->id,
                'role' => 'leader',
                'joined_at' => now(),
            ]);

            $evento->increment('registered_teams_count');

            return response()->json(['success' => true, 'message' => 'Equipo creado']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $user = Auth::user();
        $equipo = Team::with(['event', 'leader', 'members', 'project'])->findOrFail($id);

        if (!$equipo->isMember($user->id)) {
            abort(403);
        }

        // Obtener solicitudes pendientes si es líder
        $solicitudesPendientes = [];
        if ($equipo->isLeader($user->id)) {
            $solicitudesPendientes = DB::table('join_requests')
                ->where('team_id', $id)
                ->where('status', 'pending')
                ->join('users', 'join_requests.user_id', '=', 'users.id')
                ->select('join_requests.*', 'users.name', 'users.email', 'users.career', 'users.semester')
                ->orderBy('join_requests.created_at', 'desc')
                ->get();
        }

        return view('estudiante.equipo-detalle', compact('equipo', 'solicitudesPendientes'));
    }

    public function leave($id)
    {
        $user = Auth::user();
        $equipo = Team::with('members')->findOrFail($id);

        if (!$equipo->isMember($user->id)) {
            return response()->json(['success' => false, 'message' => 'No eres miembro'], 403);
        }

        if ($equipo->isLeader($user->id) && $equipo->members_count > 1) {
            return response()->json(['success' => false, 'message' => 'Transfiere el liderazgo primero'], 422);
        }

        try {
            DB::table('team_members')->where('team_id', $id)->where('user_id', $user->id)->delete();
            $equipo->decrement('members_count');

            if ($equipo->members_count == 0) {
                $equipo->delete();
                $equipo->event->decrement('registered_teams_count');
            }

            return response()->json(['success' => true, 'message' => 'Has abandonado el equipo']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function aceptarSolicitud(Request $request)
    {
        $request->validate([
            'request_id' => 'required|exists:join_requests,id',
        ]);

        $user = Auth::user();
        
        $solicitud = DB::table('join_requests')
            ->where('id', $request->request_id)
            ->first();

        if (!$solicitud) {
            return response()->json(['success' => false, 'message' => 'Solicitud no encontrada'], 404);
        }

        $equipo = Team::with('event')->findOrFail($solicitud->team_id);

        // Verificar que sea el líder
        if (!$equipo->isLeader($user->id)) {
            return response()->json(['success' => false, 'message' => 'No eres el líder'], 403);
        }

        // Verificar si el equipo está lleno
        if ($equipo->members_count >= $equipo->event->max_team_size) {
            return response()->json(['success' => false, 'message' => 'El equipo ya está completo'], 422);
        }

        // Verificar si el usuario ya tiene equipo en este evento
        $tieneEquipo = Team::where('event_id', $equipo->event_id)
            ->whereHas('members', function($query) use ($solicitud) {
                $query->where('user_id', $solicitud->user_id);
            })
            ->exists();

        if ($tieneEquipo) {
            // Rechazar automáticamente
            DB::table('join_requests')
                ->where('id', $request->request_id)
                ->update([
                    'status' => 'rejected',
                    'responded_at' => now(),
                    'updated_at' => now(),
                ]);

            return response()->json(['success' => false, 'message' => 'El usuario ya tiene un equipo en este evento'], 422);
        }

        try {
            // Agregar al usuario al equipo
            DB::table('team_members')->insert([
                'id' => Str::uuid(),
                'team_id' => $equipo->id,
                'user_id' => $solicitud->user_id,
                'role' => 'member',
                'joined_at' => now(),
            ]);

            $equipo->increment('members_count');

            // Actualizar solicitud
            DB::table('join_requests')
                ->where('id', $request->request_id)
                ->update([
                    'status' => 'accepted',
                    'responded_at' => now(),
                    'updated_at' => now(),
                ]);

            // Notificar al usuario
            Notification::create([
                'id' => Str::uuid(),
                'user_id' => $solicitud->user_id,
                'type' => 'join_accepted',
                'title' => 'Solicitud aceptada',
                'message' => 'Tu solicitud para unirte al equipo "' . $equipo->name . '" ha sido aceptada',
                'data' => json_encode([
                    'team_id' => $equipo->id,
                    'team_name' => $equipo->name,
                ]),
                'is_read' => false,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Solicitud aceptada exitosamente'
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function rechazarSolicitud(Request $request)
    {
        $request->validate([
            'request_id' => 'required|exists:join_requests,id',
        ]);

        $user = Auth::user();
        
        $solicitud = DB::table('join_requests')
            ->where('id', $request->request_id)
            ->first();

        if (!$solicitud) {
            return response()->json(['success' => false, 'message' => 'Solicitud no encontrada'], 404);
        }

        $equipo = Team::findOrFail($solicitud->team_id);

        // Verificar que sea el líder
        if (!$equipo->isLeader($user->id)) {
            return response()->json(['success' => false, 'message' => 'No eres el líder'], 403);
        }

        try {
            // Actualizar solicitud
            DB::table('join_requests')
                ->where('id', $request->request_id)
                ->update([
                    'status' => 'rejected',
                    'responded_at' => now(),
                    'updated_at' => now(),
                ]);

            // Notificar al usuario
            Notification::create([
                'id' => Str::uuid(),
                'user_id' => $solicitud->user_id,
                'type' => 'join_rejected',
                'title' => 'Solicitud rechazada',
                'message' => 'Tu solicitud para unirte al equipo "' . $equipo->name . '" ha sido rechazada',
                'data' => json_encode([
                    'team_id' => $equipo->id,
                    'team_name' => $equipo->name,
                ]),
                'is_read' => false,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Solicitud rechazada'
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
