<?php $__env->startSection('title', 'Equipos Disponibles - Asesor'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-2" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1">
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <a href="<?php echo e(route('asesor.equipos')); ?>" class="text-sm font-medium text-gray-600 hover:text-gray-900">Equipos</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm font-medium text-gray-800">Equipos Disponibles</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Equipos Disponibles</h1>
            <p class="text-gray-600 mt-1">Solicita asesorar a equipos que aún no tienen asesor</p>
        </div>
        <a href="<?php echo e(route('asesor.equipos')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
            ← Volver a Mis Equipos
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <!-- Lista de Equipos Disponibles -->
    <?php if($proyectosDisponibles->count() > 0): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__currentLoopData = $proyectosDisponibles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proyecto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between mb-4">
                <div class="flex-1">
                    <h3 class="font-bold text-gray-900 text-lg"><?php echo e($proyecto->team->name ?? 'Sin nombre'); ?></h3>
                    <?php if($proyecto->event): ?>
                    <p class="text-sm text-gray-600 mt-1"><?php echo e($proyecto->event->title); ?></p>
                    <?php endif; ?>
                </div>
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>

            <p class="text-sm text-gray-700 mb-4">
                <span class="font-medium">Proyecto:</span> <?php echo e($proyecto->title); ?>

            </p>

            <div class="flex items-center gap-4 text-sm text-gray-600 mb-4">
                <div class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span><?php echo e($proyecto->team->members_count ?? 0); ?> miembros</span>
                </div>
                <div class="flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    <span>Sin asesor</span>
                </div>
            </div>

            <?php if(in_array($proyecto->id, $misSolicitudesEnviadas)): ?>
                <button disabled class="w-full px-4 py-2 bg-gray-300 text-gray-600 rounded-lg cursor-not-allowed text-sm font-medium">
                    ⏳ Solicitud Enviada
                </button>
            <?php else: ?>
                <button onclick="mostrarModalSolicitar('<?php echo e($proyecto->id); ?>', '<?php echo e($proyecto->team->name); ?>')" class="w-full px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors text-sm font-medium">
                    Solicitar Asesorar
                </button>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php else: ?>
    <!-- Estado vacío -->
    <div class="bg-white rounded-xl p-12 shadow-sm border border-gray-200 text-center">
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">No hay equipos disponibles</h3>
        <p class="text-gray-600">Todos los equipos ya tienen asesor asignado</p>
    </div>
    <?php endif; ?>
</div>

<!-- Modal para Solicitar Asesorar -->
<div id="modalSolicitar" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Solicitar Asesorar</h3>
        <p class="text-gray-600 mb-4">Vas a enviar una solicitud al equipo <span id="equipoNombre" class="font-semibold"></span></p>
        <form id="formSolicitar" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Mensaje (opcional)</label>
                <textarea name="mensaje" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent" placeholder="Presentate y menciona por qué quieres asesorar a este equipo..."></textarea>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="cerrarModalSolicitar()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancelar
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors">
                    Enviar Solicitud
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function mostrarModalSolicitar(projectId, teamName) {
    const modal = document.getElementById('modalSolicitar');
    const form = document.getElementById('formSolicitar');
    const nombreSpan = document.getElementById('equipoNombre');
    
    form.action = `/asesor/equipos/${projectId}/solicitar`;
    nombreSpan.textContent = teamName;
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function cerrarModalSolicitar() {
    const modal = document.getElementById('modalSolicitar');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.asesor-dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Cheluis\Documentos\7Semestre\Programacion web\ProyectoPW\resources\views/asesor/equipos-disponibles.blade.php ENDPATH**/ ?>