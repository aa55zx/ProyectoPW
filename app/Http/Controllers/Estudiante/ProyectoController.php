<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProyectoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $equipos = Team::whereHas('members', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with(['event', 'project'])->get();
        
        $proyectos = Project::whereIn('team_id', $equipos->pluck('id'))
                            ->with(['team.event', 'team.leader'])
                            ->orderBy('created_at', 'desc')
                            ->get();
        
        return view('estudiante.proyectos', compact('proyectos', 'equipos'));
    }

    public function show($id)
    {
        $user = Auth::user();
        $proyecto = Project::with(['team.members', 'team.event', 'evaluations.judge'])->findOrFail($id);
        
        if (!$proyecto->team->isMember($user->id)) {
            abort(403, 'No tienes permiso para ver este proyecto');
        }
        
        return view('estudiante.proyecto-detalle', compact('proyecto'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
        ], [
            'team_id.required' => 'Debes seleccionar un equipo',
            'title.required' => 'El título es obligatorio',
            'description.required' => 'La descripción es obligatoria',
        ]);

        $user = Auth::user();
        $team = Team::findOrFail($request->team_id);

        if (!$team->isMember($user->id)) {
            return response()->json(['success' => false, 'message' => 'No eres miembro de este equipo'], 403);
        }

        if ($team->project) {
            return response()->json(['success' => false, 'message' => 'Este equipo ya tiene un proyecto'], 422);
        }

        try {
            $proyecto = Project::create([
                'id' => Str::uuid(),
                'team_id' => $request->team_id,
                'event_id' => $team->event_id,
                'title' => $request->title,
                'description' => $request->description,
                'status' => 'in_progress',
            ]);

            return response()->json(['success' => true, 'message' => 'Proyecto creado exitosamente']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
        ]);

        $user = Auth::user();
        $proyecto = Project::with('team')->findOrFail($id);

        if ($proyecto->team->leader_id !== $user->id) {
            return response()->json(['success' => false, 'message' => 'Solo el líder puede editar'], 403);
        }

        try {
            $proyecto->update(['title' => $request->title, 'description' => $request->description]);
            return response()->json(['success' => true, 'message' => 'Actualizado']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $proyecto = Project::with('team')->findOrFail($id);

        if ($proyecto->team->leader_id !== $user->id) {
            return response()->json(['success' => false, 'message' => 'Solo el líder puede eliminar'], 403);
        }

        try {
            $proyecto->delete();
            return response()->json(['success' => true, 'message' => 'Eliminado']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
