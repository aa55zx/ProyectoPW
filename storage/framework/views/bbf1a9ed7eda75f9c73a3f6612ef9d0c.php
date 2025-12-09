<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('breadcrumb', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Encabezado de Bienvenida -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">¡Hola, <?php echo e(explode(' ', auth()->user()->name)[0]); ?>!</h1>
        <p class="text-gray-600 mt-2 text-lg">Administra la plataforma y supervisa todas las actividades.</p>
    </div>

    <!-- Tarjetas de Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Total Eventos -->
        <a href="<?php echo e(route('admin.eventos')); ?>" class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100 cursor-pointer">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 mb-2">Total Eventos</p>
                    <p class="text-4xl font-bold text-gray-900 mb-1"><?php echo e($totalEventos); ?></p>
                    <p class="text-sm text-green-600 font-medium">Eventos activos</p>
                </div>
                <div class="bg-blue-50 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </a>

        <!-- Total Equipos -->
        <a href="<?php echo e(route('admin.equipos')); ?>" class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100 cursor-pointer">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 mb-2">Total Equipos</p>
                    <p class="text-4xl font-bold text-gray-900 mb-1"><?php echo e($totalEquipos); ?></p>
                    <p class="text-sm text-green-600 font-medium">Equipos registrados</p>
                </div>
                <div class="bg-purple-50 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </a>

        <!-- Total Proyectos -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 mb-2">Total Proyectos</p>
                    <p class="text-4xl font-bold text-gray-900 mb-1"><?php echo e($totalProyectos); ?></p>
                    <p class="text-sm text-gray-500 font-medium">Proyectos en plataforma</p>
                </div>
                <div class="bg-green-50 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Evaluaciones -->
        <a href="<?php echo e(route('admin.rankings')); ?>" class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100 cursor-pointer">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 mb-2">Evaluaciones</p>
                    <p class="text-4xl font-bold text-gray-900 mb-1"><?php echo e($totalEvaluaciones); ?></p>
                    <p class="text-sm text-gray-500 font-medium">Evaluaciones completadas</p>
                </div>
                <div class="bg-orange-50 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
            </div>
        </a>
    </div>

    <!-- Contenido Principal: Actividad General y Eventos Recientes -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Actividad General (2/3 del ancho) -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Gráfico de Actividad General -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Actividad General</h2>
                
                <!-- Aquí iría el gráfico - por ahora un placeholder -->
                <div class="h-64 bg-gray-50 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-200">
                    <div class="text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <p class="text-gray-500 font-medium">Gráfico de actividad por mes</p>
                    </div>
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Acciones Rápidas</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Crear Evento -->
                    <a href="<?php echo e(route('admin.eventos')); ?>" class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white hover:shadow-xl transition-all duration-300">
                        <div class="flex items-start justify-between mb-4">
                            <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Crear Evento</h3>
                        <p class="text-blue-100 text-sm">Configura un nuevo evento académico</p>
                    </a>

                    <!-- Gestionar Usuarios -->
                    <a href="<?php echo e(route('admin.administracion')); ?>" class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg p-6 text-white hover:shadow-xl transition-all duration-300">
                        <div class="flex items-start justify-between mb-4">
                            <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Gestionar Usuarios</h3>
                        <p class="text-purple-100 text-sm">Administra roles y permisos</p>
                    </a>

                    <!-- Ver Rankings -->
                    <a href="<?php echo e(route('admin.rankings')); ?>" class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white hover:shadow-xl transition-all duration-300">
                        <div class="flex items-start justify-between mb-4">
                            <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Ver Rankings</h3>
                        <p class="text-green-100 text-sm">Estadísticas y análisis detallados</p>
                    </a>

                    <!-- Configuración -->
                    <a href="<?php echo e(route('admin.perfil')); ?>" class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl shadow-lg p-6 text-white hover:shadow-xl transition-all duration-300">
                        <div class="flex items-start justify-between mb-4">
                            <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Configuración</h3>
                        <p class="text-orange-100 text-sm">Ajustes del sistema</p>
                    </a>
                </div>
            </div>
        </div>

        <!-- Panel Lateral Derecho: Eventos Recientes -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Eventos Recientes -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Eventos Recientes</h2>
                
                <div class="space-y-4">
                    <?php $__empty_1 = true; $__currentLoopData = $eventosRecientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('admin.eventos.ver', $evento->id)); ?>" class="flex gap-3 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-<?php echo e($evento->status === 'in_progress' ? 'green' : ($evento->status === 'open' ? 'blue' : 'gray')); ?>-100 rounded-lg flex items-center justify-center">
                                <span class="text-xl">
                                    <?php if($evento->category === 'Tecnología'): ?>
                                        🏆
                                    <?php elseif($evento->category === 'Ciencias'): ?>
                                        🔬
                                    <?php elseif($evento->category === 'Negocios'): ?>
                                        💼
                                    <?php else: ?>
                                        🤖
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 mb-1"><?php echo e(Str::limit($evento->title, 40)); ?></p>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="px-2 py-0.5 bg-<?php echo e($evento->status === 'in_progress' ? 'green' : ($evento->status === 'open' ? 'blue' : 'gray')); ?>-100 text-<?php echo e($evento->status === 'in_progress' ? 'green' : ($evento->status === 'open' ? 'blue' : 'gray')); ?>-700 text-xs font-medium rounded">
                                    <?php echo e($evento->getStatusLabel()); ?>

                                </span>
                                <p class="text-xs text-gray-500"><?php echo e($evento->teams_count); ?> equipos</p>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-gray-500 text-sm text-center py-4">No hay eventos recientes</p>
                    <?php endif; ?>
                </div>

                <a href="<?php echo e(route('admin.eventos')); ?>" class="w-full mt-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 rounded-xl transition-colors border border-gray-200 flex items-center justify-center">
                    Ver todos los eventos
                </a>
            </div>

            <!-- Actividad Reciente del Sistema -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Actividad Reciente</h2>
                
                <div class="space-y-4">
                    <?php $__empty_1 = true; $__currentLoopData = $actividadReciente; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $actividad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex gap-3 items-start">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-2 h-2 bg-<?php echo e($actividad['color']); ?>-500 rounded-full"></div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-900 font-medium"><?php echo e($actividad['mensaje']); ?></p>
                            <p class="text-xs text-gray-500 mt-0.5"><?php echo e($actividad['tiempo']); ?></p>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-gray-500 text-sm text-center py-4">No hay actividad reciente</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\em556\Desktop\ProyectoPW\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>