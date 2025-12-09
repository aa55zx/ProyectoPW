<?php $__env->startSection('title', 'Dashboard - Asesor'); ?>

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
                    <span class="text-sm font-medium text-gray-800">Dashboard</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">¡Hola, <?php echo e(Auth::user()->name); ?>!</h1>
        <p class="text-gray-600 mt-1">Gestiona tus equipos y ayúdales a alcanzar el éxito.</p>
    </div>

    <!-- Estadísticas Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Equipos Asesorados -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm font-medium text-gray-600">Equipos Asesorados</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1"><?php echo e($equiposCount ?? 0); ?></p>
                </div>
                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Proyectos Activos -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm font-medium text-gray-600">Proyectos Activos</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1"><?php echo e($proyectosCount ?? 0); ?></p>
                </div>
                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Eventos Activos -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm font-medium text-gray-600">Eventos Activos</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1"><?php echo e($eventosConEquipos ?? 0); ?></p>
                </div>
                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Solicitudes Pendientes -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm font-medium text-gray-600">Solicitudes Pendientes</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1"><?php echo e($solicitudesPendientes ?? 0); ?></p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Mis Equipos Recientes -->
    <?php if(isset($misProyectos) && $misProyectos->count() > 0): ?>
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Mis Equipos Recientes</h2>
        <div class="space-y-4">
            <?php $__currentLoopData = $misProyectos->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proyecto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-900"><?php echo e($proyecto->team->name ?? 'Sin nombre'); ?></h3>
                    <p class="text-sm text-gray-500 mt-1">
                        <span class="font-medium">Proyecto:</span> <?php echo e($proyecto->title); ?>

                    </p>
                    <p class="text-sm text-gray-500">
                        <span class="font-medium">Evento:</span> <?php echo e($proyecto->event->title ?? 'Sin evento'); ?>

                    </p>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="px-2 py-1 text-xs rounded-full
                            <?php echo e($proyecto->status === 'submitted' ? 'bg-green-100 text-green-800' : ''); ?>

                            <?php echo e($proyecto->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : ''); ?>

                            <?php echo e($proyecto->status === 'draft' ? 'bg-gray-100 text-gray-800' : ''); ?>

                            <?php echo e($proyecto->status === 'evaluated' ? 'bg-purple-100 text-purple-800' : ''); ?>">
                            <?php echo e(ucfirst($proyecto->status)); ?>

                        </span>
                        <span class="text-xs text-gray-500">• <?php echo e($proyecto->team->members_count ?? 0); ?> integrantes</span>
                    </div>
                </div>
                <a href="<?php echo e(route('asesor.proyectos')); ?>" class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors text-sm font-medium">
                    Ver Proyecto
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <?php if($misProyectos->count() > 5): ?>
        <div class="mt-4 text-center">
            <a href="<?php echo e(route('asesor.equipos')); ?>" class="text-sm text-gray-600 hover:text-gray-900 font-medium">
                Ver todos los equipos →
            </a>
        </div>
        <?php endif; ?>
    </div>
    <?php else: ?>
    <!-- Estado vacío -->
    <div class="bg-white rounded-xl p-12 shadow-sm border border-gray-200 text-center">
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">No tienes equipos asignados aún</h3>
        <p class="text-gray-600 mb-6">Los equipos aparecerán aquí cuando aceptes solicitudes de asesoría</p>
        <a href="<?php echo e(route('asesor.equipos')); ?>" class="inline-block px-6 py-3 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors font-medium">
            Ver Solicitudes
        </a>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.asesor-dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Cheluis\Documentos\7Semestre\Programacion web\ProyectoPW\resources\views/asesor/dashboard.blade.php ENDPATH**/ ?>