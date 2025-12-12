<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Team;
use App\Models\Project;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\TeamRegisteredMail;

class EventoController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el tab actual (por defecto: próximos)
        $tab = $request->get('tab', 'proximos');
        
        // Base query: solo eventos publicados
        $baseQuery = Event::where('is_published', true);

        // Filtrar por categoría si se especifica
        if ($request->filled('category') && $request->category !== 'all') {
            $baseQuery->where('category', $request->category);
        }

        // Filtrar por búsqueda si se especifica
        if ($request->filled('search')) {
            $baseQuery->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Separar eventos por estado - basándonos principalmente en el status
        // PRÓXIMOS: todos los eventos con status 'upcoming'
        $eventosProximos = (clone $baseQuery)
            ->where('status', 'upcoming')
            ->orderBy('event_start_date', 'asc')
            ->get();

        // ACTIVOS: todos los eventos con status 'in_progress'
        $eventosActivos = (clone $baseQuery)
            ->where('status', 'in_progress')
            ->orderBy('event_start_date', 'desc')
            ->get();

        // TERMINADOS: todos los eventos con status 'finished'
        $eventosTerminados = (clone $baseQuery)
            ->where('status', 'finished')
            ->orderBy('event_end_date', 'desc')
            ->get();

        // Si es una petición AJAX, devolver JSON con los tres arrays
        if ($request->ajax()) {
            return response()->json([
                'proximos' => $eventosProximos,
                'activos' => $eventosActivos,
                'terminados' => $eventosTerminados,
            ]);
        }

        return view('estudiante.eventos', compact('eventosProximos', 'eventosActivos', 'eventosTerminados', 'tab'));
    }

    public function show($id)
    {
        $evento = Event::with([
            'schedule' => function($query) {
                $query->orderBy('day')->orderBy('order_index');
            },
            'judges',
            'advisors'
        ])->findOrFail($id);

        $evento->increment('views_count');

        $user = Auth::user();
        
        // 1. OBTENER TODOS LOS EQUIPOS DEL USUARIO (independientes del evento)
        $misEquipos = Team::whereHas('members', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['members', 'leader'])->get();
        
        // 2. BUSCAR SI EL USUARIO ESTÁ EN ALGÚN EQUIPO INSCRITO EN ESTE EVENTO
        $equiposUsuarioEnEvento = DB::table('event_registrations')
            ->where('event_id', $id)
            ->whereIn('team_id', function($query) use ($user) {
                $query->select('team_id')
                      ->from('team_members')
                      ->where('user_id', $user->id);
            })
            ->get();
        
        $miEquipo = null;
        
        if ($equiposUsuarioEnEvento->count() > 0) {
            $primerRegistro = $equiposUsuarioEnEvento->first();
            $miEquipo = Team::with(['members', 'leader'])->find($primerRegistro->team_id);
        }
        
        // 3. OBTENER TODOS LOS EQUIPOS INSCRITOS EN EL EVENTO
        $registrations = DB::table('event_registrations')
            ->where('event_id', $id)
            ->get();
        
        $equiposInscritos = collect();
        
        foreach ($registrations as $reg) {
            $team = Team::with(['leader', 'members'])->find($reg->team_id);
            if ($team) {
                $team->registered_at = $reg->registered_at;
                $equiposInscritos->push($team);
            }
        }
        
        // Fallback: Si no hay en event_registrations, buscar en sistema antiguo
        if ($equiposInscritos->count() == 0) {
            $equiposInscritos = Team::where('event_id', $id)
                ->with(['leader', 'members'])
                ->get();
                
            if (!$miEquipo) {
                $miEquipo = $equiposInscritos->first(function($equipo) use ($user) {
                    return $equipo->members->contains('id', $user->id);
                });
            }
        }
        
        // 4. OBTENER SOLICITUDES PENDIENTES DEL USUARIO (solo si NO tiene equipo)
        $solicitudesPendientes = [];
        if (!$miEquipo) {
            $solicitudesPendientes = DB::table('join_requests')
                ->where('user_id', $user->id)
                ->where('status', 'pending')
                ->whereIn('team_id', $equiposInscritos->pluck('id'))
                ->pluck('team_id')
                ->toArray();
        }
        
        // 5. OBTENER ASESORES DISPONIBLES (asignados al evento pero sin proyecto asignado)
        $asesoresDisponibles = $evento->advisors->filter(function($asesor) use ($id) {
            // Verificar si el asesor ya tiene un proyecto asignado en este evento
            $tieneProyecto = DB::table('projects')
                ->where('event_id', $id)
                ->where('advisor_id', $asesor->id)
                ->exists();
            
            return !$tieneProyecto;
        });

        return view('estudiante.evento-detalle', compact(
            'evento', 
            'miEquipo', 
            'misEquipos', 
            'equiposInscritos', 
            'solicitudesPendientes',
            'asesoresDisponibles'
        ));
    }

    public function inscribirEquipo(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'team_id' => 'required|exists:teams,id',
            'project_title' => 'required|string|max:255',
            'project_description' => 'required|string|max:2000',
        ]);

        $user = Auth::user();
        $team = Team::with('members')->findOrFail($request->team_id);
        $event = Event::findOrFail($request->event_id);

        // VALIDACIÓN 1: Usuario es miembro del equipo
        if (!$team->isMember($user->id)) {
            return response()->json(['success' => false, 'message' => 'No eres miembro de este equipo'], 403);
        }

        // VALIDACIÓN 2: El evento está disponible para inscripciones (SOLO UPCOMING)
        if (!$event->is_published) {
            return response()->json(['success' => false, 'message' => 'Este evento no está disponible'], 403);
        }
        
        if ($event->status !== 'upcoming') {
            return response()->json(['success' => false, 'message' => 'Solo puedes inscribirte a eventos próximos. Este evento ya está en curso o ha finalizado.'], 403);
        }

        // VALIDACIÓN 3: El equipo NO está ya inscrito en este evento
        $registroExistente = DB::table('event_registrations')
            ->where('team_id', $request->team_id)
            ->where('event_id', $request->event_id)
            ->first();

        if ($registroExistente) {
            return response()->json(['success' => false, 'message' => 'Este equipo ya está inscrito en este evento'], 422);
        }

        // VALIDACIÓN 4: NINGÚN MIEMBRO del equipo puede estar ya en OTRO EQUIPO de este evento
        $miembrosIds = DB::table('team_members')
            ->where('team_id', $request->team_id)
            ->pluck('user_id');
        
        $conflictoMiembros = DB::table('event_registrations')
            ->where('event_id', $request->event_id)
            ->where('team_id', '!=', $request->team_id)
            ->whereExists(function($query) use ($miembrosIds) {
                $query->select(DB::raw(1))
                      ->from('team_members')
                      ->whereColumn('team_members.team_id', 'event_registrations.team_id')
                      ->whereIn('team_members.user_id', $miembrosIds);
            })
            ->first();

        if ($conflictoMiembros) {
            $equipoConflicto = Team::find($conflictoMiembros->team_id);
            $miembroConflicto = DB::table('team_members')
                ->whereIn('user_id', $miembrosIds)
                ->where('team_id', $conflictoMiembros->team_id)
                ->first();
            
            $usuarioConflicto = \App\Models\User::find($miembroConflicto->user_id);
            
            return response()->json([
                'success' => false, 
                'message' => "No se puede inscribir: {$usuarioConflicto->name} ya está participando en este evento con el equipo '{$equipoConflicto->name}'"
            ], 422);
        }

        // VALIDACIÓN 5: Límite de equipos en el evento
        if ($event->max_teams) {
            $equiposInscritos = DB::table('event_registrations')
                ->where('event_id', $request->event_id)
                ->count();
            
            if ($equiposInscritos >= $event->max_teams) {
                return response()->json(['success' => false, 'message' => 'El evento ha alcanzado el límite de equipos'], 422);
            }
        }

        try {
            DB::beginTransaction();

            // Crear proyecto
            $projectId = Str::uuid();
            DB::table('projects')->insert([
                'id' => $projectId,
                'team_id' => $request->team_id,
                'event_id' => $request->event_id,
                'title' => $request->project_title,
                'description' => $request->project_description,
                'status' => 'draft',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Registrar equipo en evento
            DB::table('event_registrations')->insert([
                'id' => Str::uuid(),
                'team_id' => $request->team_id,
                'event_id' => $request->event_id,
                'project_id' => $projectId,
                'registered_by' => $user->id,
                'registered_at' => now(),
            ]);

            // Incrementar contador de equipos registrados
            $event->increment('registered_teams_count');

            DB::commit();

            // Enviar email de confirmación a todos los miembros del equipo
            try {
                $emailsEnviados = 0;
                foreach ($team->members as $member) {
                    if ($member->user && $member->user->email && filter_var($member->user->email, FILTER_VALIDATE_EMAIL)) {
                        try {
                            Mail::to($member->user->email)->send(new TeamRegisteredMail($team, $event));
                            $emailsEnviados++;
                        } catch (\Exception $e) {
                            \Log::error("Error al enviar email a miembro {$member->user->email}: " . $e->getMessage());
                        }
                    }
                }
                \Log::info("Emails enviados al inscribir equipo '{$team->name}': {$emailsEnviados} de {$team->members->count()} miembros");
            } catch (\Exception $e) {
                \Log::error('Error general al enviar emails de registro de equipo: ' . $e->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Equipo inscrito al evento exitosamente. Se ha enviado confirmación por email.',
                'project_id' => $projectId
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
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

        // VALIDACIÓN: Solo eventos UPCOMING
        if ($evento->status !== 'upcoming') {
            return response()->json([
                'success' => false,
                'message' => 'Solo puedes crear equipos para eventos próximos. Este evento ya está en curso o ha finalizado.'
            ], 403);
        }

        // VALIDACIÓN: El usuario NO debe estar ya en otro equipo de este evento
        $usuarioYaEnEvento = DB::table('event_registrations')
            ->where('event_id', $request->event_id)
            ->whereExists(function($query) use ($user) {
                $query->select(DB::raw(1))
                      ->from('team_members')
                      ->whereColumn('team_members.team_id', 'event_registrations.team_id')
                      ->where('team_members.user_id', $user->id);
            })
            ->first();

        if ($usuarioYaEnEvento) {
            $equipoExistente = Team::find($usuarioYaEnEvento->team_id);
            return response()->json([
                'success' => false,
                'message' => "Ya estás participando en este evento con el equipo '{$equipoExistente->name}'. No puedes estar en dos equipos del mismo evento."
            ], 422);
        }

        // Verificar límite de equipos en el evento
        if ($evento->max_teams) {
            $equiposInscritos = DB::table('event_registrations')
                ->where('event_id', $request->event_id)
                ->count();
            
            if ($equiposInscritos >= $evento->max_teams) {
                return response()->json([
                    'success' => false,
                    'message' => 'El evento ha alcanzado el límite máximo de equipos'
                ], 422);
            }
        }

        try {
            DB::beginTransaction();

            // Crear equipo SIN event_id (equipos independientes)
            $teamId = Str::uuid();
            $team = Team::create([
                'id' => $teamId,
                'name' => $request->team_name,
                'description' => $request->team_description,
                'event_id' => null,
                'leader_id' => $user->id,
                'status' => 'active',
                'members_count' => 1,
            ]);

            // Agregar al usuario como líder (con timestamps para compatibilidad con Railway)
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

            \Log::info("Equipo creado exitosamente: {$team->name} por usuario {$user->name}");

            return response()->json([
                'success' => true,
                'message' => 'Equipo creado exitosamente. Ahora inscríbelo al evento.',
                'team' => $team,
                'team_id' => $teamId
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error al crear equipo: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Error al crear el equipo. Por favor, intenta de nuevo.',
                'error_detail' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function solicitarUnirse(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
        ]);

        $user = Auth::user();
        $team = Team::with(['leader'])->findOrFail($request->team_id);

        // VALIDACIÓN: El usuario NO puede enviar solicitud si ya está en un equipo del evento
        $eventoId = DB::table('event_registrations')
            ->where('team_id', $team->id)
            ->value('event_id');
        
        if ($eventoId) {
            // Verificar que el evento sea UPCOMING
            $evento = Event::find($eventoId);
            if ($evento && $evento->status !== 'upcoming') {
                return response()->json([
                    'success' => false,
                    'message' => 'Solo puedes unirte a equipos de eventos próximos. Este evento ya está en curso o ha finalizado.'
                ], 403);
            }

            // Verificar si el usuario ya está en otro equipo de este evento
            $usuarioYaEnEvento = DB::table('event_registrations')
                ->where('event_id', $eventoId)
                ->whereExists(function($query) use ($user) {
                    $query->select(DB::raw(1))
                          ->from('team_members')
                          ->whereColumn('team_members.team_id', 'event_registrations.team_id')
                          ->where('team_members.user_id', $user->id);
                })
                ->first();

            if ($usuarioYaEnEvento) {
                $equipoExistente = Team::find($usuarioYaEnEvento->team_id);
                return response()->json([
                    'success' => false,
                    'message' => "Ya estás participando en este evento con el equipo '{$equipoExistente->name}'"
                ], 422);
            }
        }

        // Verificar si ya envió solicitud
        $solicitudExistente = DB::table('join_requests')
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

        try {
            // Crear solicitud
            DB::table('join_requests')->insert([
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
