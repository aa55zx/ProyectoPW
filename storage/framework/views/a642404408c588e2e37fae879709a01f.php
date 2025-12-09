<?php $__env->startSection('title', 'Mis Equipos - Asesor'); ?>

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
                    <span class="text-sm font-medium text-gray-800">Equipos</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Mis Equipos</h1>
            <p class="text-gray-600 mt-1">Gestiona los equipos que asesoras</p>
        </div>
        <a href="<?php echo e(route('asesor.equipos-disponibles')); ?>" class="px-6 py-3 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors font-medium flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            Buscar Equipos
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

    <!-- Solicitudes Pendientes -->
    <?php if(isset($solicitudesPendientes) && $solicitudesPendientes->count() > 0): ?>
    <div class="mb-8 bg-yellow-50 border border-yellow-200 rounded-xl p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            Solicitudes Pendientes (<?php echo e($solicitudesPendientes->count()); ?>)
        </h2>

        <div class="space-y-4">
            <?php $__currentLoopData = $solicitudesPendientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $solicitud): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white border border-gray-200 rounded-xl p-4">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900"><?php echo e($solicitud->team_name); ?></h3>
                        <p class="text-sm text-gray-600 mt-1">
                            <span class="font-medium">Evento:</span> <?php echo e($solicitud->event_title); ?>

                        </p>
                        <p class="text-sm text-gray-600">
                            <span class="font-medium">Solicitado por:</span> <?php echo e($solicitud->requester_name); ?>

                        </p>
                        <?php if($solicitud->message): ?>
                        <p class="text-sm text-gray-700 mt-2 italic">"<?php echo e($solicitud->message); ?>"</p>
                        <?php endif; ?>
                        <p class="text-xs text-gray-500 mt-2">
                            Fecha: <?php echo e(\Carbon\Carbon::parse($solicitud->created_at)->format('d/m/Y H:i')); ?>

                        </p>
                    </div>
                    <div class="flex gap-2 ml-4">
                        <form method="POST" action="<?php echo e(route('asesor.solicitudes.aceptar', $solicitud->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm font-medium">
                                ✓ Aceptar
                            </button>
                        </form>
                        <button onclick="mostrarModalRechazar('<?php echo e($solicitud->id); ?>')" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm font-medium">
                            ✗ Rechazar
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Lista de Equipos -->
    <?php if($equipos->count() > 0): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between mb-4">
                <div class="flex-1">
                    <h3 class="font-bold text-gray-900 text-lg"><?php echo e($equipo->name); ?></h3>
                    <?php if($equipo->event): ?>
                    <p class="text-sm text-gray-600 mt-1"><?php echo e($equipo->event->title); ?></p>
                    <?php endif; ?>
                </div>
                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>

            <?php if($equipo->description): ?>
            <p class="text-sm text-gray-600 mb-4"><?php echo e(Str::limit($equipo->description, 100)); ?></p>
            <?php endif; ?>

            <div class="flex items-center gap-4 text-sm text-gray-600 mb-4">
                <div class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span><?php echo e($equipo->members_count); ?> miembros</span>
                </div>
                <div class="flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                    <span><?php echo e(ucfirst($equipo->status)); ?></span>
                </div>
            </div>

            <div class="flex gap-2">
                <a href="<?php echo e(route('asesor.proyectos')); ?>" class="flex-1 px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors text-sm font-medium text-center">
                    Ver Proyecto
                </a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php else: ?>
    <!-- Estado vacío -->
    <div class="bg-white rounded-xl p-12 shadow-sm border border-gray-200 text-center">
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">No tienes equipos asignados</h3>
        <p class="text-gray-600">Los equipos aparecerán aquí cuando aceptes solicitudes de asesoría</p>
    </div>
    <?php endif; ?>
</div>

<!-- Modal para Rechazar Solicitud -->
<div id="modalRechazar" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Rechazar Solicitud</h3>
        <form id="formRechazar" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Mensaje (opcional)</label>
                <textarea name="mensaje" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent" placeholder="Explica por qué rechazas esta solicitud..."></textarea>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="cerrarModalRechazar()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancelar
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    Rechazar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function mostrarModalRechazar(solicitudId) {
    const modal = document.getElementById('modalRechazar');
    const form = document.getElementById('formRechazar');
    form.action = `/asesor/solicitudes/${solicitudId}/rechazar`;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function cerrarModalRechazar() {
    const modal = document.getElementById('modalRechazar');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.asesor-dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\merin\Downloads\ProyectoPW\resources\views/asesor/equipos.blade.php ENDPATH**/ ?>