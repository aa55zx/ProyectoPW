<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Team;
use App\Models\Project;
use App\Models\Evaluation;
use App\Models\EventJudge;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Mostrar el dashboard del administrador
     */
    public function dashboard()
    {
        // Estadísticas generales
        $totalEventos = Event::count();
        $totalEquipos = Team::count();
        $totalProyectos = Project::count();
        $totalEvaluaciones = Evaluation::where('status', 'completed')->count();

        // Eventos recientes
        $eventosRecientes = Event::with(['teams', 'projects'])
            ->withCount(['teams', 'projects'])
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        // Actividad reciente del sistema (últimos cambios en la BD)
        $actividadReciente = $this->getRecentActivity();

        return view('admin.dashboard', compact(
            'totalEventos',
            'totalEquipos',
            'totalProyectos',
            'totalEvaluaciones',
            'eventosRecientes',
            'actividadReciente'
        ));
    }

    /**
     * Mostrar la lista de eventos
     */
    public function eventos(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');
        $category = $request->get('category');

        $query = Event::with(['judges', 'advisors'])
            ->withCount(['teams', 'projects', 'judges', 'advisors']);

        // Filtros
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        if ($status && $status !== 'Todos') {
            $statusMap = [
                'Activo' => 'in_progress',
                'Próximo' => 'open',
                'Finalizado' => 'finished'
            ];
            $query->where('status', $statusMap[$status] ?? $status);
        }

        if ($category && $category !== 'Todas') {
            $query->where('category', $category);
        }

        $eventos = $query->orderBy('created_at', 'desc')->paginate(10);

        // Obtener jueces y asesores para asignación (usar user_type en lugar de role)
        $jueces = User::where('user_type', 'juez')->orWhere('role', 'juez')->get();
        $asesores = User::where('user_type', 'maestro')->orWhere('role', 'asesor')->get();

        return view('admin.eventos', compact('eventos', 'jueces', 'asesores'));
    }

    /**
     * Crear un nuevo evento
     */
    public function crearEvento(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'event_start_date' => 'required|date',
            'event_end_date' => 'required|date|after_or_equal:event_start_date',
            'registration_start_date' => 'required|date',
            'registration_end_date' => 'required|date|after_or_equal:registration_start_date',
            'min_team_size' => 'required|integer|min:1',
            'max_team_size' => 'required|integer|min:1',
            'max_teams' => 'nullable|integer|min:1',
            'location' => 'nullable|string',
            'is_online' => 'boolean',
        ]);

        // Determinar el status basado en las fechas
        $now = now();
        $status = 'upcoming'; // Por defecto
        
        if ($now->greaterThan($request->event_end_date)) {
            $status = 'finished';
        } elseif ($now->between($request->event_start_date, $request->event_end_date)) {
            $status = 'in_progress';
        } elseif ($now->lessThan($request->event_start_date)) {
            $status = 'upcoming';
        }

        $evento = Event::create([
            'id' => (string) Str::uuid(),
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'short_description' => Str::limit($request->description, 200),
            'category' => $request->category,
            'event_type' => $request->event_type ?? 'competition',
            'status' => $status,
            'registration_start_date' => $request->registration_start_date,
            'registration_end_date' => $request->registration_end_date,
            'event_start_date' => $request->event_start_date,
            'event_end_date' => $request->event_end_date,
            'min_team_size' => $request->min_team_size,
            'max_team_size' => $request->max_team_size,
            'max_teams' => $request->max_teams,
            'location' => $request->location,
            'is_online' => $request->is_online ?? false,
            'organizer_id' => auth()->id(),
            'organizer_name' => auth()->user()->name,
            'contact_email' => auth()->user()->email,
            'is_published' => true,
        ]);

        return redirect()->route('admin.eventos')->with('success', 'Evento creado exitosamente.');
    }

    /**
     * Ver detalles de un evento
     */
    public function verEvento($id)
    {
        $evento = Event::with(['teams.members', 'projects', 'judges'])->findOrFail($id);
        return view('admin.evento-detalle', compact('evento'));
    }

    /**
     * Actualizar un evento
     */
    public function actualizarEvento(Request $request, $id)
    {
        $evento = Event::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'event_start_date' => 'required|date',
            'event_end_date' => 'required|date|after_or_equal:event_start_date',
            'registration_start_date' => 'required|date',
            'registration_end_date' => 'required|date|after_or_equal:registration_start_date',
            'min_team_size' => 'required|integer|min:1',
            'max_team_size' => 'required|integer|min:1',
            'max_teams' => 'nullable|integer|min:1',
            'location' => 'nullable|string',
            'is_online' => 'boolean',
        ]);

        // Recalcular el status basado en las nuevas fechas
        $now = now();
        $status = 'upcoming';
        
        if ($now->greaterThan($request->event_end_date)) {
            $status = 'finished';
        } elseif ($now->between($request->event_start_date, $request->event_end_date)) {
            $status = 'in_progress';
        } elseif ($now->lessThan($request->event_start_date)) {
            $status = 'upcoming';
        }

        $evento->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'short_description' => Str::limit($request->description, 200),
            'category' => $request->category,
            'status' => $status,
            'registration_start_date' => $request->registration_start_date,
            'registration_end_date' => $request->registration_end_date,
            'event_start_date' => $request->event_start_date,
            'event_end_date' => $request->event_end_date,
            'min_team_size' => $request->min_team_size,
            'max_team_size' => $request->max_team_size,
            'max_teams' => $request->max_teams,
            'location' => $request->location,
            'is_online' => $request->is_online ?? false,
        ]);

        return redirect()->route('admin.eventos')->with('success', 'Evento actualizado exitosamente.');
    }

    /**
     * Eliminar un evento
     */
    public function eliminarEvento($id)
    {
        $evento = Event::findOrFail($id);
        
        // Verificar si tiene equipos o proyectos asociados
        if ($evento->teams()->count() > 0 || $evento->projects()->count() > 0) {
            return redirect()->back()->with('error', 'No se puede eliminar un evento con equipos o proyectos asociados.');
        }

        $evento->delete();

        return redirect()->route('admin.eventos')->with('success', 'Evento eliminado exitosamente.');
    }

    /**
     * Asignar jueces a un evento
     */
    public function asignarJueces(Request $request, $id)
    {
        $request->validate([
            'judges' => 'array',
            'judges.*' => 'exists:users,id',
        ]);

        $evento = Event::findOrFail($id);

        // Eliminar asignaciones anteriores
        EventJudge::where('event_id', $id)->delete();

        // Crear nuevas asignaciones si hay jueces seleccionados
        if ($request->has('judges') && is_array($request->judges)) {
            foreach ($request->judges as $judgeId) {
                EventJudge::create([
                    'id' => (string) Str::uuid(),
                    'event_id' => $id,
                    'judge_id' => $judgeId,
                    'status' => 'active',
                    'assigned_at' => now(),
                    'assigned_by' => auth()->id(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'Jueces asignados exitosamente.');
    }

    /**
     * Asignar asesores a un evento
     */
    public function asignarAsesores(Request $request, $id)
    {
        $request->validate([
            'advisors' => 'array',
            'advisors.*' => 'exists:users,id',
        ]);

        $evento = Event::findOrFail($id);

        // Eliminar asignaciones anteriores de asesores
        DB::table('event_advisors')->where('event_id', $id)->delete();

        // Crear nuevas asignaciones si hay asesores seleccionados
        if ($request->has('advisors') && is_array($request->advisors)) {
            foreach ($request->advisors as $advisorId) {
                DB::table('event_advisors')->insert([
                    'id' => (string) Str::uuid(),
                    'event_id' => $id,
                    'advisor_id' => $advisorId,
                    'status' => 'active',
                    'assigned_at' => now(),
                    'assigned_by' => auth()->id(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'Asesores asignados exitosamente.');
    }

    /**
     * Eliminar un equipo
     */
    public function eliminarEquipo($id)
    {
        $equipo = Team::findOrFail($id);
        
        // Eliminar el equipo
        $equipo->delete();

        return redirect()->back()->with('success', 'Equipo eliminado exitosamente.');
    }

    /**
     * Mostrar la lista de equipos
     */
    public function equipos(Request $request)
    {
        $search = $request->get('search');
        $eventId = $request->get('event_id');

        $query = Team::with(['event', 'leader', 'members', 'project'])
            ->withCount('members');

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        if ($eventId) {
            $query->where('event_id', $eventId);
        }

        $equipos = $query->orderBy('created_at', 'desc')->paginate(12);
        $eventos = Event::all();

        return view('admin.equipos', compact('equipos', 'eventos'));
    }

    /**
     * Mostrar los rankings
     */
    public function rankings(Request $request)
    {
        $eventId = $request->get('event_id');

        $query = Project::with(['team.leader', 'team.members', 'event'])
            ->where('status', 'evaluated')
            ->whereNotNull('final_score');

        if ($eventId) {
            $query->where('event_id', $eventId);
        }

        $proyectos = $query->orderBy('final_score', 'desc')->get();

        // Asignar ranking
        $proyectos = $proyectos->map(function($proyecto, $index) {
            $proyecto->display_rank = $index + 1;
            return $proyecto;
        });

        $eventos = Event::whereHas('projects', function($query) {
            $query->where('status', 'evaluated');
        })->get();

        return view('admin.rankings', compact('proyectos', 'eventos', 'eventId'));
    }

    /**
     * Mostrar el panel de administración
     */
    public function administracion(Request $request)
    {
        $search = $request->get('search');
        $role = $request->get('role');

        // No contar proyectos para evitar error si la columna advisor_id no existe
        $query = User::withCount(['teams']);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        if ($role && $role !== 'all') {
            $query->where(function($q) use ($role) {
                $q->where('role', $role)->orWhere('user_type', $role);
            });
        }

        $usuarios = $query->orderBy('created_at', 'desc')->paginate(15);

        // Actividad reciente
        $actividadReciente = $this->getRecentActivity();

        // Conteos por rol (considerar tanto role como user_type)
        $totalEstudiantes = User::where('role', 'estudiante')->orWhere('user_type', 'estudiante')->count();
        $totalJueces = User::where('role', 'juez')->orWhere('user_type', 'juez')->count();
        $totalAsesores = User::where('role', 'asesor')->orWhere('user_type', 'maestro')->count();

        return view('admin.administracion', compact('usuarios', 'actividadReciente', 'totalEstudiantes', 'totalJueces', 'totalAsesores'));
    }

    /**
     * Crear un nuevo usuario
     */
    public function crearUsuario(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'numero_control' => 'nullable|string|max:50',
            'password' => 'required|min:8|confirmed',
            'user_type' => 'required|in:estudiante,juez,maestro,admin',
        ]);

        $usuario = User::create([
            'id' => (string) Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'numero_control' => $request->numero_control,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
            'is_active' => true,
        ]);

        return redirect()->back()->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Actualizar un usuario
     */
    public function actualizarUsuario(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:estudiante,asesor,juez,admin,maestro',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'user_type' => $request->role === 'asesor' ? 'maestro' : $request->role,
        ];

        $usuario->update($updateData);

        return redirect()->back()->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Eliminar un usuario
     */
    public function eliminarUsuario($id)
    {
        $usuario = User::findOrFail($id);

        // No permitir eliminar al propio admin
        if ($usuario->id === auth()->id()) {
            return redirect()->back()->with('error', 'No puedes eliminar tu propia cuenta.');
        }

        $usuario->delete();

        return redirect()->back()->with('success', 'Usuario eliminado exitosamente.');
    }

    /**
     * Mostrar el perfil del administrador
     */
    public function perfil()
    {
        $usuario = auth()->user();

        // Estadísticas del admin
        $totalEventos = Event::count();
        $totalUsuarios = User::count();
        $totalEquipos = Team::count();
        $totalProyectos = Project::count();

        return view('admin.mi-perfil', compact(
            'usuario',
            'totalEventos',
            'totalUsuarios',
            'totalEquipos',
            'totalProyectos'
        ));
    }

    /**
     * Actualizar perfil del administrador
     */
    public function actualizarPerfil(Request $request)
    {
        $usuario = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'bio' => 'nullable|string|max:500',
        ]);

        $usuario->update($request->only(['name', 'email', 'bio']));

        return redirect()->back()->with('success', 'Perfil actualizado exitosamente.');
    }

    /**
     * Actualizar contraseña del administrador
     */
    public function actualizarPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $usuario = auth()->user();

        if (!Hash::check($request->current_password, $usuario->password)) {
            return redirect()->back()->with('error', 'La contraseña actual no es correcta.');
        }

        $usuario->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Contraseña actualizada exitosamente.');
    }

    /**
     * Obtener actividad reciente del sistema
     */
    private function getRecentActivity()
    {
        $actividades = [];

        // Últimos equipos registrados
        $equiposRecientes = Team::with('event')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        foreach ($equiposRecientes as $equipo) {
            $actividades[] = [
                'tipo' => 'equipo',
                'mensaje' => "Nuevo equipo registrado: {$equipo->name}",
                'tiempo' => $equipo->created_at->diffForHumans(),
                'color' => 'green'
            ];
        }

        // Últimos proyectos evaluados
        $proyectosEvaluados = Project::where('status', 'evaluated')
            ->with('team')
            ->whereNotNull('updated_at')
            ->orderBy('updated_at', 'desc')
            ->take(3)
            ->get();

        foreach ($proyectosEvaluados as $proyecto) {
            $actividades[] = [
                'tipo' => 'evaluacion',
                'mensaje' => "Proyecto evaluado: {$proyecto->title}",
                'tiempo' => $proyecto->updated_at->diffForHumans(),
                'color' => 'blue'
            ];
        }

        // Últimos usuarios registrados
        $usuariosRecientes = User::orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        foreach ($usuariosRecientes as $usuario) {
            $actividades[] = [
                'tipo' => 'usuario',
                'mensaje' => "Usuario nuevo registrado: {$usuario->name}",
                'tiempo' => $usuario->created_at->diffForHumans(),
                'color' => 'purple'
            ];
        }

        // Últimos eventos actualizados
        $eventosActualizados = Event::orderBy('updated_at', 'desc')
            ->take(2)
            ->get();

        foreach ($eventosActualizados as $evento) {
            $actividades[] = [
                'tipo' => 'evento',
                'mensaje' => "Evento actualizado: {$evento->title}",
                'tiempo' => $evento->updated_at->diffForHumans(),
                'color' => 'orange'
            ];
        }

        // Ordenar por tiempo
        usort($actividades, function($a, $b) {
            return strcmp($a['tiempo'], $b['tiempo']);
        });

        return array_slice($actividades, 0, 4);
    }
}
