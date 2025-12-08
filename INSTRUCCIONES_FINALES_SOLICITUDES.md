# INSTRUCCIONES FINALES - SISTEMA DE SOLICITUDES DE ASESORÍA
# EJECUTAR EN ORDEN

## ✅ YA ESTÁ HECHO (90%):

1. ✅ routes/web.php - Rutas actualizadas
2. ✅ proyecto-detalle.blade.php - Vista completa con solicitudes
3. ✅ Migración advisor_requests creada

## ⏳ FALTA (10%) - COPIAR CÓDIGO:

### ARCHIVO 1: ProyectoController.php
**Ubicación:** `app/Http/Controllers/Estudiante/ProyectoController.php`

**OPCIÓN A: Agregar solo los métodos nuevos (RECOMENDADO)**

Busca el método `assignAdvisor()` (línea ~249) y REEMPLÁZALO con estos 2 métodos:

```php
    /**
     * Solicitar asesor (envía solicitud en lugar de asignar directamente)
     */
    public function solicitarAsesor(Request $request, $id)
    {
        $request->validate([
            'advisor_id' => 'required|exists:users,id',
            'mensaje' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        $proyecto = Project::with('team')->findOrFail($id);

        if (!$proyecto->team->isLeader($user->id)) {
            return response()->json(['success' => false, 'message' => 'Solo el líder puede solicitar asesor'], 403);
        }

        $solicitudExistente = DB::table('advisor_requests')
            ->where('project_id', $proyecto->id)
            ->where('status', 'pending')
            ->exists();

        if ($solicitudExistente) {
            return response()->json(['success' => false, 'message' => 'Ya tienes una solicitud pendiente para este proyecto'], 422);
        }

        if ($proyecto->advisor_id) {
            return response()->json(['success' => false, 'message' => 'Este proyecto ya tiene un asesor asignado'], 422);
        }

        try {
            $requestId = Str::uuid();
            DB::table('advisor_requests')->insert([
                'id' => $requestId,
                'project_id' => $proyecto->id,
                'team_id' => $proyecto->team_id,
                'advisor_id' => $request->advisor_id,
                'requested_by' => $user->id,
                'status' => 'pending',
                'message' => $request->mensaje,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $asesor = User::find($request->advisor_id);
            \App\Models\Notification::create([
                'id' => Str::uuid(),
                'user_id' => $request->advisor_id,
                'type' => 'advisor_request',
                'title' => 'Nueva Solicitud de Asesoría',
                'message' => $user->name . ' solicita que seas asesor de su proyecto "' . $proyecto->title . '"',
                'data' => json_encode([
                    'project_id' => $proyecto->id,
                    'team_id' => $proyecto->team_id,
                    'request_id' => $requestId,
                ]),
                'is_read' => false,
            ]);

            return response()->json([
                'success' => true, 
                'message' => 'Solicitud enviada a ' . $asesor->name . ' exitosamente'
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function cancelarSolicitudAsesor($id)
    {
        $user = Auth::user();
        $proyecto = Project::with('team')->findOrFail($id);

        if (!$proyecto->team->isLeader($user->id)) {
            return response()->json(['success' => false, 'message' => 'Solo el líder puede cancelar la solicitud'], 403);
        }

        try {
            $deleted = DB::table('advisor_requests')
                ->where('project_id', $proyecto->id)
                ->where('status', 'pending')
                ->delete();

            if ($deleted) {
                return response()->json(['success' => true, 'message' => 'Solicitud cancelada']);
            } else {
                return response()->json(['success' => false, 'message' => 'No hay solicitud pendiente'], 404);
            }

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
```

**También modifica el método `show()` línea ~95:**

ANTES:
```php
return view('estudiante.proyecto-detalle', compact('proyecto', 'asesoresDisponibles', 'esLider'));
```

DESPUÉS:
```php
// Verificar estado de solicitud de asesor
$solicitudAsesor = DB::table('advisor_requests')
    ->where('project_id', $proyecto->id)
    ->whereIn('status', ['pending', 'accepted', 'rejected'])
    ->orderBy('created_at', 'desc')
    ->first();

return view('estudiante.proyecto-detalle', compact('proyecto', 'asesoresDisponibles', 'esLider', 'solicitudAsesor'));
```

---

### ARCHIVO 2: AsesorController.php
**Ubicación:** `app/Http/Controllers/AsesorController.php`

**Modificar método `proyectos()` (línea ~201):**

REEMPLAZAR:
```php
public function proyectos()
{
    $user = Auth::user();
    
    // Obtener proyectos donde es asesor
    $proyectos = Project::where('advisor_id', $user->id)
        ->with(['team.members', 'event'])
        ->get();
    
    // Contar proyectos por estado
    $todosCount = $proyectos->count();
    $enProgresoCount = $proyectos->whereIn('status', ['draft', 'in_progress'])->count();
    $entregadosCount = $proyectos->where('status', 'submitted')->count();
    $evaluadosCount = $proyectos->where('status', 'evaluated')->count();
    
    return view('asesor.proyectos', compact(
        'proyectos',
        'todosCount',
        'enProgresoCount',
        'entregadosCount',
        'evaluadosCount'
    ));
}
```

CON:
```php
public function proyectos()
{
    $user = Auth::user();
    
    // Proyectos donde es asesor
    $proyectos = Project::where('advisor_id', $user->id)
        ->with(['team.members', 'event'])
        ->get();
    
    // SOLICITUDES PENDIENTES
    $solicitudesPendientes = DB::table('advisor_requests')
        ->where('advisor_id', $user->id)
        ->where('status', 'pending')
        ->join('projects', 'advisor_requests.project_id', '=', 'projects.id')
        ->join('teams', 'advisor_requests.team_id', '=', 'teams.id')
        ->join('users', 'advisor_requests.requested_by', '=', 'users.id')
        ->select(
            'advisor_requests.*',
            'projects.title as project_title',
            'teams.name as team_name',
            'users.name as requester_name'
        )
        ->orderBy('advisor_requests.created_at', 'desc')
        ->get();
    
    // Contar proyectos por estado
    $todosCount = $proyectos->count();
    $enProgresoCount = $proyectos->whereIn('status', ['draft', 'in_progress'])->count();
    $entregadosCount = $proyectos->where('status', 'submitted')->count();
    $evaluadosCount = $proyectos->where('status', 'evaluated')->count();
    
    return view('asesor.proyectos', compact(
        'proyectos',
        'solicitudesPendientes',
        'todosCount',
        'enProgresoCount',
        'entregadosCount',
        'evaluadosCount'
    ));
}
```

**Modificar métodos aceptarSolicitud() y rechazarSolicitud() (líneas ~185-196):**

REEMPLAZAR:
```php
public function aceptarSolicitud(Request $request, $solicitudId)
{
    return redirect()->back()->with('error', 'Función no disponible');
}

public function rechazarSolicitud(Request $request, $solicitudId)
{
    return redirect()->back()->with('error', 'Función no disponible');
}
```

CON:
```php
public function aceptarSolicitud(Request $request, $id)
{
    $user = Auth::user();
    
    $solicitud = DB::table('advisor_requests')
        ->where('id', $id)
        ->where('advisor_id', $user->id)
        ->where('status', 'pending')
        ->first();
    
    if (!$solicitud) {
        return redirect()->back()->with('error', 'Solicitud no encontrada');
    }
    
    try {
        DB::beginTransaction();
        
        // Actualizar solicitud
        DB::table('advisor_requests')
            ->where('id', $id)
            ->update([
                'status' => 'accepted',
                'response_message' => $request->input('mensaje', 'Solicitud aceptada'),
                'responded_at' => now(),
                'updated_at' => now()
            ]);
        
        // Asignar asesor al proyecto
        Project::where('id', $solicitud->project_id)
            ->update(['advisor_id' => $user->id]);
        
        // Notificar al estudiante
        \App\Models\Notification::create([
            'id' => \Illuminate\Support\Str::uuid(),
            'user_id' => $solicitud->requested_by,
            'type' => 'advisor_accepted',
            'title' => '¡Solicitud Aceptada!',
            'message' => $user->name . ' aceptó ser tu asesor',
            'data' => json_encode(['project_id' => $solicitud->project_id]),
            'is_read' => false,
        ]);
        
        DB::commit();
        
        return redirect()->back()->with('success', 'Solicitud aceptada. Ahora eres asesor de este proyecto.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
    }
}

public function rechazarSolicitud(Request $request, $id)
{
    $user = Auth::user();
    
    $solicitud = DB::table('advisor_requests')
        ->where('id', $id)
        ->where('advisor_id', $user->id)
        ->where('status', 'pending')
        ->first();
    
    if (!$solicitud) {
        return redirect()->back()->with('error', 'Solicitud no encontrada');
    }
    
    try {
        // Actualizar solicitud
        DB::table('advisor_requests')
            ->where('id', $id)
            ->update([
                'status' => 'rejected',
                'response_message' => $request->input('mensaje', 'Solicitud rechazada'),
                'responded_at' => now(),
                'updated_at' => now()
            ]);
        
        // Notificar al estudiante
        \App\Models\Notification::create([
            'id' => \Illuminate\Support\Str::uuid(),
            'user_id' => $solicitud->requested_by,
            'type' => 'advisor_rejected',
            'title' => 'Solicitud Rechazada',
            'message' => $user->name . ' rechazó tu solicitud de asesoría',
            'data' => json_encode(['project_id' => $solicitud->project_id]),
            'is_read' => false,
        ]);
        
        return redirect()->back()->with('success', 'Solicitud rechazada');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
    }
}
```

---

### ARCHIVO 3: asesor/proyectos.blade.php
**Ubicación:** `resources/views/asesor/proyectos.blade.php`

AGREGAR AL INICIO (después del header, antes de las tabs):

```blade
<!-- Banner de Solicitudes Pendientes -->
@if(isset($solicitudesPendientes) && $solicitudesPendientes->count() > 0)
<div class="mb-8 bg-white rounded-xl shadow-sm border-2 border-blue-200 overflow-hidden">
    <div class="p-6">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold text-gray-900">
                    {{ $solicitudesPendientes->count() }} Solicitud{{ $solicitudesPendientes->count() > 1 ? 'es' : '' }} Pendiente{{ $solicitudesPendientes->count() > 1 ? 's' : '' }}
                </h3>
                <p class="text-sm text-gray-600">Equipos que solicitan tu asesoría</p>
            </div>
        </div>

        <div class="space-y-3">
            @foreach($solicitudesPendientes as $solicitud)
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="font-semibold text-gray-900 mb-1">
                                {{ $solicitud->project_title }}
                            </div>
                            <div class="text-sm text-gray-600 mb-2">
                                Equipo: {{ $solicitud->team_name }} | Solicitado por: {{ $solicitud->requester_name }}
                            </div>
                            @if($solicitud->message)
                                <div class="text-sm text-gray-700 bg-white p-3 rounded border border-gray-200 mb-3">
                                    "{{ $solicitud->message }}"
                                </div>
                            @endif
                            <div class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($solicitud->created_at)->diffForHumans() }}
                            </div>
                        </div>
                        <div class="flex gap-2 flex-shrink-0">
                            <form method="POST" action="{{ route('asesor.solicitudes.aceptar', $solicitud->id) }}" class="inline">
                                @csrf
                                <button type="submit" 
                                        onclick="return confirm('¿Aceptar esta solicitud?')"
                                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm font-medium">
                                    ✓ Aceptar
                                </button>
                            </form>
                            <form method="POST" action="{{ route('asesor.solicitudes.rechazar', $solicitud->id) }}" class="inline">
                                @csrf
                                <button type="submit"
                                        onclick="return confirm('¿Rechazar esta solicitud?')"
                                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm font-medium">
                                    ✗ Rechazar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif
```

---

## 🚀 EJECUCIÓN FINAL:

```bash
# 1. Ejecutar migración y limpiar caché
APLICAR_SOLICITUDES_COMPLETO.bat

# 2. Copiar código de arriba a los archivos
# 3. Probar
```

---

## 🧪 PRUEBAS:

**Estudiante:**
1. Email: carlos1@estudiante.com / password123
2. Ve a un proyecto sin asesor
3. Click "Solicitar asesor"
4. Elige asesor y envía mensaje
5. DEBE mostrar "Solicitud enviada"

**Asesor:**
1. Email: juan@maestro.com / password123
2. Ve a "Proyectos"
3. DEBE ver banner con solicitud
4. Click "Aceptar"
5. DEBE asignar asesor

---

FIN DE INSTRUCCIONES
