# SISTEMA DE SOLICITUDES DE ASESORÍA
# Implementación Completa - EventTec
# Fecha: 08 Dic 2025

## RESUMEN DE CAMBIOS

El sistema ahora funciona con SOLICITUDES en lugar de asignación directa:

1. ✅ Estudiante SOLICITA asesor
2. ✅ Asesor recibe NOTIFICACIÓN
3. ✅ Asesor ACEPTA o RECHAZA
4. ✅ Estudiante ve ESTADO de solicitud

---

## PASO 1: MIGRACIÓN - Crear tabla advisor_requests

**Archivo:** `database/migrations/2024_12_08_000001_create_advisor_requests_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('advisor_requests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('project_id');
            $table->uuid('team_id');
            $table->uuid('advisor_id');
            $table->uuid('requested_by');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->text('message')->nullable();
            $table->text('response_message')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('advisor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('requested_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('advisor_requests');
    }
};
```

**Ejecutar:**
```bash
php artisan migrate --path=database/migrations/2024_12_08_000001_create_advisor_requests_table.php
```

---

## PASO 2: RUTAS - Agregar en web.php

**Ubicación:** Dentro del grupo `Route::prefix('estudiante')`

```php
// PROYECTOS - AGREGAR ESTAS DOS RUTAS:
Route::post('/proyectos/{id}/solicitar-asesor', [ProyectoController::class, 'solicitarAsesor'])
    ->name('proyectos.solicitar-asesor');
Route::post('/proyectos/{id}/cancelar-solicitud-asesor', [ProyectoController::class, 'cancelarSolicitudAsesor'])
    ->name('proyectos.cancelar-solicitud-asesor');
```

**Ubicación:** Dentro del grupo `Route::prefix('asesor')`

```php
// SOLICITUDES - YA EXISTEN ESTAS RUTAS:
Route::post('/solicitudes/{id}/aceptar', [AsesorController::class, 'aceptarSolicitud'])
    ->name('solicitudes.aceptar');
Route::post('/solicitudes/{id}/rechazar', [AsesorController::class, 'rechazarSolicitud'])
    ->name('solicitudes.rechazar');
```

---

## PASO 3: CONTROLADORES

### A) ProyectoController - Agregar métodos

**Archivo:** `app/Http/Controllers/Estudiante/ProyectoController.php`

Agregar AL FINAL de la clase (antes del cierre `}`):

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
        return response()->json(['success' => false, 'message' => 'Ya tienes una solicitud pendiente'], 422);
    }

    if ($proyecto->advisor_id) {
        return response()->json(['success' => false, 'message' => 'Ya tienes un asesor asignado'], 422);
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
            'message' => $user->name . ' solicita que seas asesor de "' . $proyecto->title . '"',
            'data' => json_encode([
                'project_id' => $proyecto->id,
                'request_id' => $requestId,
            ]),
            'is_read' => false,
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Solicitud enviada a ' . $asesor->name
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
        return response()->json(['success' => false, 'message' => 'Solo el líder puede cancelar'], 403);
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

### B) ProyectoController - Modificar método `show()`

BUSCAR el método `show()` y AGREGAR después de `$asesoresDisponibles`:

```php
// Verificar estado de solicitud de asesor
$solicitudAsesor = DB::table('advisor_requests')
    ->where('project_id', $proyecto->id)
    ->whereIn('status', ['pending', 'accepted', 'rejected'])
    ->orderBy('created_at', 'desc')
    ->first();

return view('estudiante.proyecto-detalle', compact(
    'proyecto', 
    'asesoresDisponibles', 
    'esLider',
    'solicitudAsesor'  // ← AGREGAR ESTA VARIABLE
));
```

### C) AsesorController - Modificar método `proyectos()`

BUSCAR el método `proyectos()` y REEMPLAZAR:

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
    
    $todosCount = $proyectos->count();
    $enProgresoCount = $proyectos->whereIn('status', ['draft', 'in_progress'])->count();
    $entregadosCount = $proyectos->where('status', 'submitted')->count();
    $evaluadosCount = $proyectos->where('status', 'evaluated')->count();
    
    return view('asesor.proyectos', compact(
        'proyectos',
        'solicitudesPendientes',  // ← AGREGAR
        'todosCount',
        'enProgresoCount',
        'entregadosCount',
        'evaluadosCount'
    ));
}
```

### D) AsesorController - Modificar métodos aceptar/rechazar

REEMPLAZAR los métodos existentes:

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

## PASO 4: VISTAS

### A) Vista Estudiante - Modal Solicitar Asesor

**Archivo:** `resources/views/estudiante/proyecto-detalle.blade.php`

BUSCAR el modal "Seleccionar Asesor" y REEMPLAZAR TODO el modal con:

```blade
<!-- Modal: Solicitar Asesor -->
<div id="modal-seleccionar-asesor" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto relative">
        <button onclick="document.getElementById('modal-seleccionar-asesor').classList.add('hidden')" 
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <div class="p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Solicitar Asesor</h3>
            <p class="text-gray-600 mb-6">Elige un asesor y envía tu solicitud</p>

            <form id="form-solicitar-asesor" class="space-y-6">
                @csrf
                <input type="hidden" name="project_id" value="{{ $proyecto->id }}">
                
                <!-- Lista de asesores -->
                <div class="space-y-3">
                    @forelse($asesoresDisponibles as $asesor)
                        <label class="flex items-center gap-4 p-4 border border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all asesor-option">
                            <input type="radio" name="advisor_id" value="{{ $asesor->id }}" 
                                   class="w-5 h-5 text-blue-600" required>
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-700 font-bold text-lg flex-shrink-0">
                                {{ strtoupper(substr($asesor->name, 0, 2)) }}
                            </div>
                            <div class="flex-1">
                                <div class="font-semibold text-gray-900">{{ $asesor->name }}</div>
                                <div class="text-sm text-gray-600">{{ $asesor->email }}</div>
                            </div>
                            <svg class="w-5 h-5 text-blue-600 hidden check-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </label>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            No hay asesores disponibles en este momento
                        </div>
                    @endforelse
                </div>

                <!-- Mensaje opcional -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Mensaje para el asesor (opcional)
                    </label>
                    <textarea name="mensaje" rows="3" 
                              placeholder="Cuéntale al asesor sobre tu proyecto..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
                </div>

                <!-- Botones -->
                <div class="flex gap-3">
                    <button type="button" 
                            onclick="document.getElementById('modal-seleccionar-asesor').classList.add('hidden')"
                            class="flex-1 py-3 px-4 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                        Cancelar
                    </button>
                    <button type="submit" class="flex-1 py-3 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                        Enviar Solicitud
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Manejar selección visual de asesor
document.querySelectorAll('.asesor-option').forEach(option => {
    const radio = option.querySelector('input[type="radio"]');
    const checkIcon = option.querySelector('.check-icon');
    
    radio.addEventListener('change', function() {
        document.querySelectorAll('.asesor-option').forEach(opt => {
            opt.classList.remove('border-blue-500', 'bg-blue-50');
            opt.querySelector('.check-icon').classList.add('hidden');
        });
        if (this.checked) {
            option.classList.add('border-blue-500', 'bg-blue-50');
            checkIcon.classList.remove('hidden');
        }
    });
});

// Enviar solicitud
document.getElementById('form-solicitar-asesor').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const btn = this.querySelector('button[type="submit"]');
    btn.disabled = true;
    btn.textContent = 'Enviando...';
    
    try {
        const response = await fetch('{{ route("estudiante.proyectos.solicitar-asesor", $proyecto->id) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert('✓ ' + data.message);
            window.location.reload();
        } else {
            alert('✗ ' + data.message);
            btn.disabled = false;
            btn.textContent = 'Enviar Solicitud';
        }
    } catch (error) {
        alert('✗ Error al enviar solicitud');
        btn.disabled = false;
        btn.textContent = 'Enviar Solicitud';
    }
});
</script>
```

### B) Vista Estudiante - Mostrar estado de solicitud

BUSCAR la sección "Asesor" en proyecto-detalle y REEMPLAZAR con:

```blade
<!-- Asesor -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
            </svg>
            Asesor
        </h3>
        
        @if($esLider && !$proyecto->advisor_id && !isset($solicitudAsesor))
            <button onclick="document.getElementById('modal-seleccionar-asesor').classList.remove('hidden')" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                Seleccionar asesor
            </button>
        @endif
    </div>

    @if($proyecto->advisor_id && $proyecto->advisor)
        <!-- Asesor asignado -->
        <div class="flex items-center gap-4 p-4 bg-green-50 border border-green-200 rounded-lg">
            <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center text-green-700 font-bold text-xl">
                {{ strtoupper(substr($proyecto->advisor->name, 0, 2)) }}
            </div>
            <div class="flex-1">
                <div class="font-semibold text-gray-900">{{ $proyecto->advisor->name }}</div>
                <div class="text-sm text-gray-600">{{ $proyecto->advisor->email }}</div>
            </div>
            <div class="px-3 py-1 bg-green-600 text-white text-xs font-medium rounded-full">
                Asignado
            </div>
        </div>
    @elseif(isset($solicitudAsesor))
        <!-- Estado de solicitud -->
        @if($solicitudAsesor->status === 'pending')
            <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <div class="flex items-center gap-3 mb-2">
                    <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-semibold text-yellow-900">Solicitud Pendiente</span>
                </div>
                <p class="text-sm text-yellow-700 mb-3">
                    Esperando respuesta del asesor...
                </p>
                @if($esLider)
                    <button onclick="cancelarSolicitud()" 
                            class="text-sm text-yellow-700 hover:text-yellow-900 font-medium underline">
                        Cancelar solicitud
                    </button>
                @endif
            </div>
        @elseif($solicitudAsesor->status === 'rejected')
            <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                <div class="flex items-center gap-3 mb-2">
                    <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-semibold text-red-900">Solicitud Rechazada</span>
                </div>
                <p class="text-sm text-red-700 mb-3">
                    {{ $solicitudAsesor->response_message ?? 'El asesor rechazó tu solicitud' }}
                </p>
                @if($esLider)
                    <button onclick="document.getElementById('modal-seleccionar-asesor').classList.remove('hidden')" 
                            class="text-sm text-red-700 hover:text-red-900 font-medium underline">
                        Solicitar otro asesor
                    </button>
                @endif
            </div>
        @endif
    @else
        <div class="text-center py-8 text-gray-500">
            <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <p class="font-medium">No hay asesor asignado</p>
            @if($esLider)
                <p class="text-sm mt-1">Solicita un asesor para tu proyecto</p>
            @endif
        </div>
    @endif
</div>

<script>
async function cancelarSolicitud() {
    if (!confirm('¿Cancelar la solicitud de asesoría?')) return;
    
    try {
        const response = await fetch('{{ route("estudiante.proyectos.cancelar-solicitud-asesor", $proyecto->id) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert('✓ ' + data.message);
            window.location.reload();
        } else {
            alert('✗ ' + data.message);
        }
    } catch (error) {
        alert('✗ Error al cancelar solicitud');
    }
}
</script>
```

---

## PASO 5: Vista Asesor - Notificaciones

**Archivo:** `resources/views/asesor/proyectos.blade.php`

AGREGAR AL INICIO (después del header):

```blade
<!-- Banner de Solicitudes Pendientes -->
@if($solicitudesPendientes->count() > 0)
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

## PASO 6: EJECUTAR

```bash
# 1. Migrar BD
php artisan migrate --path=database/migrations/2024_12_08_000001_create_advisor_requests_table.php

# 2. Limpiar cache
php artisan optimize:clear
php artisan config:cache
php artisan route:cache

# 3. Probar
# Estudiante: carlos1@estudiante.com / password123
# Asesor: juan@maestro.com / password123
```

---

## FLUJO COMPLETO

1. **Estudiante** va a proyecto → Click "Seleccionar asesor" → Elige asesor → Envía solicitud
2. **Sistema** crea registro en `advisor_requests` y notificación
3. **Asesor** ve banner con solicitudes → Click "Aceptar" o "Rechazar"
4. **Sistema** actualiza estado y asigna asesor (si acepta)
5. **Estudiante** ve estado: Pendiente/Aceptado/Rechazado

---

FIN DEL DOCUMENTO
