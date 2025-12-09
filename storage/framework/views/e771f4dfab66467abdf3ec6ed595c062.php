<?php $__env->startSection('title', 'Mis Proyectos - EventTec'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Proyectos</h1>
            <p class="text-gray-600 text-lg">Gestiona tus proyectos y entregas</p>
        </div>
        <button onclick="abrirModalCrearProyecto()" class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors font-semibold flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Nuevo Proyecto
        </button>
    </div>

    <!-- Grid de proyectos -->
    <?php if($proyectos->count() > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $proyectos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proyecto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-gray-100 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2"><?php echo e($proyecto->title); ?></h3>
                                
                                <!-- Estado -->
                                <?php if($proyecto->status === 'draft'): ?>
                                    <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full">
                                        📝 Borrador
                                    </span>
                                <?php elseif($proyecto->status === 'in_progress'): ?>
                                    <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">
                                        🔨 En progreso
                                    </span>
                                <?php elseif($proyecto->status === 'submitted'): ?>
                                    <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                                        ✓ Entregado
                                    </span>
                                <?php elseif($proyecto->status === 'evaluated'): ?>
                                    <span class="inline-flex items-center px-3 py-1 bg-purple-100 text-purple-800 text-xs font-semibold rounded-full">
                                        ⭐ Evaluado
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <p class="text-gray-600 text-sm mb-4 line-clamp-3"><?php echo e($proyecto->description); ?></p>

                        <div class="space-y-2 text-sm text-gray-600 mb-4">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span><?php echo e($proyecto->team->name); ?></span>
                            </div>
                            
                            <?php if($proyecto->event): ?>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span><?php echo e($proyecto->event->title); ?></span>
                            </div>
                            <?php endif; ?>

                            <?php if($proyecto->advisor): ?>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Asesor: <?php echo e($proyecto->advisor->name); ?></span>
                            </div>
                            <?php endif; ?>

                            <?php if($proyecto->final_score): ?>
                            <div class="flex items-center gap-2 text-purple-600 font-semibold">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <span><?php echo e($proyecto->final_score); ?> puntos</span>
                            </div>
                            <?php endif; ?>
                        </div>

                        <a href="<?php echo e(route('estudiante.proyectos.show', $proyecto->id)); ?>" 
                           class="block w-full py-3 px-4 bg-gray-900 text-white text-center rounded-xl hover:bg-gray-800 transition-colors font-semibold">
                            Ver detalles
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="text-center py-16">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">No tienes proyectos</h3>
            <p class="text-gray-600 mb-6">Para crear un proyecto, ve a la sección de Eventos y selecciona "Inscribirme con mi equipo"</p>
            <a href="<?php echo e(route('estudiante.eventos')); ?>" 
               class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Ir a Eventos
            </a>
        </div>
    <?php endif; ?>
</div>

<!-- Modal Crear Proyecto -->
<div id="modalCrearProyecto" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-2xl bg-white">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-gray-900">Crear Nuevo Proyecto</h3>
            <button onclick="cerrarModalCrearProyecto()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <form id="formCrearProyecto" onsubmit="crearProyecto(event)">
            <?php echo csrf_field(); ?>

            <!-- Nombre del Proyecto -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre del Proyecto *</label>
                <input type="text" name="title" required maxlength="255"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Ej: Sistema de Gestión Escolar">
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Descripción *</label>
                <textarea name="description" required maxlength="2000" rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Describe tu proyecto..."></textarea>
            </div>

            <!-- Seleccionar Equipo -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Seleccionar Equipo *</label>
                <select name="team_id" id="teamSelect" required onchange="verificarEquipo()"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Selecciona un equipo --</option>
                    <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($equipo->id); ?>"><?php echo e($equipo->name); ?> (<?php echo e($equipo->members_count); ?> miembros)</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- Seleccionar Evento -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Seleccionar Evento *</label>
                <select name="event_id" id="eventSelect" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Selecciona un evento --</option>
                    <?php $__currentLoopData = $eventos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($evento->id); ?>"><?php echo e($evento->title); ?> - Inicia: <?php echo e(\Carbon\Carbon::parse($evento->event_start_date)->format('d/m/Y')); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div id="alertaEquipo" class="hidden mb-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <p class="text-sm text-yellow-800"></p>
            </div>

            <!-- Botones -->
            <div class="flex gap-3 justify-end">
                <button type="button" onclick="cerrarModalCrearProyecto()"
                    class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-semibold">
                    Cancelar
                </button>
                <button type="submit" id="btnCrearProyecto"
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                    Crear Proyecto
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function abrirModalCrearProyecto() {
    document.getElementById('modalCrearProyecto').classList.remove('hidden');
}

function cerrarModalCrearProyecto() {
    document.getElementById('modalCrearProyecto').classList.add('hidden');
    document.getElementById('formCrearProyecto').reset();
    document.getElementById('alertaEquipo').classList.add('hidden');
}

function verificarEquipo() {
    // Aquí podrías agregar lógica adicional si lo necesitas
}

function crearProyecto(event) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    const btnCrear = document.getElementById('btnCrearProyecto');
    
    btnCrear.disabled = true;
    btnCrear.textContent = 'Creando...';
    
    fetch('<?php echo e(route("estudiante.proyectos.store")); ?>', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
            'Accept': 'application/json',
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            window.location.reload();
        } else {
            alert(data.message || 'Error al crear el proyecto');
            btnCrear.disabled = false;
            btnCrear.textContent = 'Crear Proyecto';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al crear el proyecto');
        btnCrear.disabled = false;
        btnCrear.textContent = 'Crear Proyecto';
    });
}

// Cerrar modal al hacer clic fuera
document.getElementById('modalCrearProyecto')?.addEventListener('click', function(e) {
    if (e.target === this) {
        cerrarModalCrearProyecto();
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.estudiante', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Cheluis\Documentos\7Semestre\Programacion web\ProyectoPW\resources\views/estudiante/proyectos.blade.php ENDPATH**/ ?>