<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Team;
use App\Models\Project;

class PerfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Equipos del estudiante
        $equipos = Team::whereHas('members', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with(['event', 'leader', 'project'])->get();

        // Proyectos del estudiante
        $proyectos = Project::whereIn('team_id', $equipos->pluck('id'))
                           ->with(['team.event'])
                           ->get();

        // Estadísticas
        $stats = [
            'total_equipos' => $equipos->count(),
            'equipos_liderados' => $equipos->where('leader_id', $user->id)->count(),
            'total_proyectos' => $proyectos->count(),
            'proyectos_evaluados' => $proyectos->where('status', 'evaluated')->count(),
            'proyectos_en_progreso' => $proyectos->where('status', 'in_progress')->count(),
            'promedio_puntuacion' => round($proyectos->where('status', 'evaluated')->avg('final_score') ?? 0, 1),
            'mejor_posicion' => $proyectos->where('rank', '!=', null)->min('rank') ?? 0,
            'puntuacion_maxima' => $proyectos->where('status', 'evaluated')->max('final_score') ?? 0,
        ];

        // Logros
        $logros = $this->calcularLogros($stats, $proyectos);

        return view('estudiante.perfil', compact('user', 'equipos', 'proyectos', 'stats', 'logros'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'semester' => 'nullable|integer|min:1|max:12',
            'career' => 'nullable|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'semester' => $request->semester,
            'career' => $request->career,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Perfil actualizado exitosamente'
        ]);
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'La contraseña actual es incorrecta'
            ], 422);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Contraseña actualizada exitosamente'
        ]);
    }

    private function calcularLogros($stats, $proyectos)
    {
        $logros = [];

        // Primer proyecto
        if ($stats['total_proyectos'] > 0) {
            $logros[] = [
                'titulo' => 'Primer Proyecto',
                'descripcion' => 'Has creado tu primer proyecto',
                'icono' => '🎯',
                'obtenido' => true,
            ];
        }

        // Trabajo en equipo
        if ($stats['total_equipos'] >= 3) {
            $logros[] = [
                'titulo' => 'Trabajo en Equipo',
                'descripcion' => 'Has participado en 3 o más equipos',
                'icono' => '👥',
                'obtenido' => true,
            ];
        }

        // Líder nato
        if ($stats['equipos_liderados'] > 0) {
            $logros[] = [
                'titulo' => 'Líder Nato',
                'descripcion' => 'Has liderado al menos un equipo',
                'icono' => '👑',
                'obtenido' => true,
            ];
        }

        // Excelencia
        if ($stats['puntuacion_maxima'] >= 90) {
            $logros[] = [
                'titulo' => 'Excelencia',
                'descripcion' => 'Has obtenido una puntuación de 90+',
                'icono' => '⭐',
                'obtenido' => true,
            ];
        }

        // Top 3
        if ($stats['mejor_posicion'] > 0 && $stats['mejor_posicion'] <= 3) {
            $logros[] = [
                'titulo' => 'Top 3',
                'descripcion' => 'Has quedado en el top 3 de un evento',
                'icono' => '🏆',
                'obtenido' => true,
            ];
        }

        // Participante activo
        if ($stats['proyectos_evaluados'] >= 5) {
            $logros[] = [
                'titulo' => 'Participante Activo',
                'descripcion' => 'Has completado 5 o más proyectos',
                'icono' => '🔥',
                'obtenido' => true,
            ];
        }

        return $logros;
    }
}
