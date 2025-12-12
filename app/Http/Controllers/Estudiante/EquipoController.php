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
        })->with(['leader', 'members']);

        if ($request->filled('role') && $request->role === 'leader') {
            $query->where('leader_id', $user->id);
        }

        $equipos = $query->orderBy('created_at', 'desc')->get();
        
        // Para cada equipo, obtener sus eventos participados y solicitudes pendientes
        foreach ($equipos as $equipo) {
            $equipo->eventos_count = DB::table('event_registrations')
                ->where('team_id', $equipo->id)
                ->count();
            
            // Contar solicitudes pendientes si es líder
            if ($equipo->leader_id === $user->id) {
                $equipo->solicitudes_count = DB::table('join_requests')
                    ->where('join_requests.team_id', $equipo->id)
                    ->where('join_requests.status', 'pending')
                    ->count();
            } else {
                $equipo->solicitudes_count = 0;
            }
        }

        // Obtener TODAS las solicitudes pendientes de los equipos donde el usuario es líder
        $solicitudesPendientes = DB::table('join_requests')
            ->whereIn('join_requests.team_id', function($query) use ($user) {
                $query->select('id')
                      ->from('teams')
                      ->where('leader_id', $user->id);
            })
            ->where('join_requests.status', 'pending')
            ->join('users', 'join_requests.user_id', '=', 'users.id')
            ->join('teams', 'join_requests.team_id', '=', 'teams.id')
            ->select(
                'join_requests.id',
                'join_requests.team_id',
                'join_requests.user_id',
                'join_requests.created_at',
                'users.name as user_name', 
                'users.email', 
                'users.career', 
                'users.semester',
                'teams.name as team_name'
            )
            ->orderBy('join_requests.created_at', 'desc')
            ->get();

        $totalSolicitudes = $solicitudesPendientes->count();

        if ($request->ajax()) {
            return response()->json(['equipos' => $equipos, 'count' => $equipos->count()]);
        }

        return view('estudiante.equipos', compact('equipos', 'solicitudesPendientes', 'totalSolicitudes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'team_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();

        try {
            DB::beginTransaction();

            $teamId = Str::uuid();
            $team = Team::create([
                'id' => $teamId,
                'name' => $request->team_name,
                'description' => $request->description,
                'event_id' => null,
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
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true, 
                'message' => 'Equipo creado exitosamente',
                'team_id' => $teamId
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $user = Auth::user();
        $equipo = Team::with(['leader', 'members'])->findOrFail($id);

        if (!$equipo->isMember($user->id)) {
            abort(403, 'No tienes permiso para ver este equipo');
        }

        // Obtener eventos donde el equipo participa
        $eventosParticipados = DB::table('event_registrations')
            ->where('event_registrations.team_id', $id)
            ->join('events', 'event_registrations.event_id', '=', 'events.id')
            ->join('projects', 'event_registrations.project_id', '=', 'projects.id')
            ->select(
                'events.*', 
                'event_registrations.registered_at',
                'projects.id as project_id',
                'projects.title as project_title'
            )
            ->orderBy('event_registrations.registered_at', 'desc')
            ->get();

        // Obtener solicitudes pendientes si es líder
        $solicitudesPendientes = [];
        if ($equipo->isLeader($user->id)) {
            $solicitudesPendientes = DB::table('join_requests')
                ->where('join_requests.team_id', $id)
                ->where('join_requests.status', 'pending')
                ->join('users', 'join_requests.user_id', '=', 'users.id')
                ->select('join_requests.*', 'users.name', 'users.email', 'users.career', 'users.semester')
                ->orderBy('join_requests.created_at', 'desc')
                ->get();
        }

        return view('estudiante.equipo-detalle', compact('equipo', 'solicitudesPendientes', 'eventosParticipados'));
    }

    public function leave($id)
    {
        $user = Auth::user();
        $equipo = Team::with('members')->findOrFail($id);

        if (!$equipo->isMember($user->id)) {
            return response()->json(['success' => false, 'message' => 'No eres miembro de este equipo'], 403);
        }

        if ($equipo->isLeader($user->id) && $equipo->members_count > 1) {
            return response()->json(['success' => false, 'message' => 'Debes transferir el liderazgo antes de salir o elimina el equipo'], 422);
        }

        try {
            DB::beginTransaction();

            DB::table('team_members')
                ->where('team_id', $id)
                ->where('user_id', $user->id)
                ->delete();
            
            $equipo->decrement('members_count');

            if ($equipo->members_count == 0) {
                DB::table('event_registrations')->where('team_id', $id)->delete();
                DB::table('projects')->where('team_id', $id)->delete();
                $equipo->delete();
            }

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Has abandonado el equipo exitosamente']);
        } catch (\Exception $e) {
            DB::rollBack();
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

        $equipo = Team::findOrFail($solicitud->team_id);

        if (!$equipo->isLeader($user->id)) {
            return response()->json(['success' => false, 'message' => 'Solo el líder puede aceptar solicitudes'], 403);
        }

        // Verificar conflictos de eventos
        $eventosEquipo = DB::table('event_registrations')
            ->where('team_id', $equipo->id)
            ->pluck('event_id');
        
        if ($eventosEquipo->count() > 0) {
            $tieneConflicto = DB::table('event_registrations')
                ->whereIn('event_id', $eventosEquipo)
                ->whereExists(function($query) use ($solicitud) {
                    $query->select(DB::raw(1))
                          ->from('team_members')
                          ->whereColumn('team_members.team_id', 'event_registrations.team_id')
                          ->where('team_members.user_id', $solicitud->user_id);
                })
                ->exists();
            
            if ($tieneConflicto) {
                DB::table('join_requests')
                    ->where('id', $request->request_id)
                    ->update([
                        'status' => 'rejected',
                        'responded_at' => now(),
                        'updated_at' => now(),
                    ]);

                return response()->json(['success' => false, 'message' => 'El usuario ya participa en un evento con otro equipo'], 422);
            }
        }

        try {
            DB::beginTransaction();

            DB::table('team_members')->insert([
                'id' => Str::uuid(),
                'team_id' => $equipo->id,
                'user_id' => $solicitud->user_id,
                'role' => 'member',
                'joined_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $equipo->increment('members_count');

            DB::table('join_requests')
                ->where('id', $request->request_id)
                ->update([
                    'status' => 'accepted',
                    'responded_at' => now(),
                    'updated_at' => now(),
                ]);

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

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Solicitud aceptada exitosamente'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
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

        if (!$equipo->isLeader($user->id)) {
            return response()->json(['success' => false, 'message' => 'Solo el líder puede rechazar solicitudes'], 403);
        }

        try {
            DB::table('join_requests')
                ->where('id', $request->request_id)
                ->update([
                    'status' => 'rejected',
                    'responded_at' => now(),
                    'updated_at' => now(),
                ]);

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
