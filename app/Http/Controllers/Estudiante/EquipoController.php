<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Event;
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
                'invitation_code' => strtoupper(substr(md5(rand()), 0, 6)),
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

        return view('estudiante.equipo-detalle', compact('equipo'));
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

    public function join(Request $request)
    {
        $request->validate(['invitation_code' => 'required|string|size:6']);

        $user = Auth::user();
        $code = strtoupper($request->invitation_code);

        $equipo = Team::where('invitation_code', $code)->with(['event', 'members'])->first();

        if (!$equipo) {
            return response()->json(['success' => false, 'message' => 'Código inválido'], 404);
        }

        if ($equipo->isMember($user->id)) {
            return response()->json(['success' => false, 'message' => 'Ya eres miembro'], 422);
        }

        $equipoExistente = Team::where('event_id', $equipo->event_id)
                                ->whereHas('members', function($query) use ($user) {
                                    $query->where('user_id', $user->id);
                                })
                                ->first();

        if ($equipoExistente) {
            return response()->json(['success' => false, 'message' => 'Ya tienes un equipo en este evento'], 422);
        }

        if ($equipo->members_count >= $equipo->event->max_team_size) {
            return response()->json(['success' => false, 'message' => 'Equipo lleno'], 422);
        }

        try {
            DB::table('team_members')->insert([
                'id' => Str::uuid(),
                'team_id' => $equipo->id,
                'user_id' => $user->id,
                'role' => 'member',
                'joined_at' => now(),
            ]);

            $equipo->increment('members_count');

            return response()->json(['success' => true, 'message' => 'Te has unido a ' . $equipo->name]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
