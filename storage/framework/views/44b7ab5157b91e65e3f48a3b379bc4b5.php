<?php $__env->startSection('title', $evento->title . ' - EventTec'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Botón de regresar -->
    <button onclick="window.history.back()" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 mb-6 font-medium transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        <span>Volver a eventos</span>
    </button>

    <!-- Hero del evento -->
    <div class="relative h-96 rounded-3xl overflow-hidden mb-8 shadow-xl">
        <?php if($evento->cover_image_url): ?>
            <img src="<?php echo e($evento->cover_image_url); ?>" alt="<?php echo e($evento->title); ?>" class="w-full h-full object-cover">
        <?php else: ?>
            <div class="w-full h-full bg-gradient-to-r from-blue-500 to-purple-600"></div>
        <?php endif; ?>
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 right-0 p-8">
            <div class="flex gap-3 mb-4">
                <?php if($evento->status === 'ongoing'): ?>
                    <span class="px-4 py-1.5 bg-green-500 text-white text-sm font-bold rounded-full">En curso</span>
                <?php elseif($evento->status === 'completed'): ?>
                    <span class="px-4 py-1.5 bg-gray-500 text-white text-sm font-bold rounded-full">Finalizado</span>
                <?php else: ?>
                    <span class="px-4 py-1.5 bg-blue-500 text-white text-sm font-bold rounded-full">Próximamente</span>
                <?php endif; ?>
                <span class="px-4 py-1.5 bg-white/90 text-gray-800 text-sm font-bold rounded-full"><?php echo e(ucfirst($evento->category)); ?></span>
            </div>
            <h1 class="text-5xl font-bold text-white mb-3"><?php echo e($evento->title); ?></h1>
            <p class="text-xl text-white/90 max-w-3xl"><?php echo e($evento->description); ?></p>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Información Principal -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Requisitos -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">📋 Requisitos</h2>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Equipo de <?php echo e($evento->min_team_size); ?>-<?php echo e($evento->max_team_size); ?> integrantes</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Estudiantes activos del TecNM</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Laptop personal</span>
                    </li>
                </ul>
            </div>

            <!-- Cronograma -->
            <?php if($evento->schedule && $evento->schedule->count() > 0): ?>
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">📅 Cronograma</h2>
                <div class="space-y-4">
                    <?php $__currentLoopData = $evento->schedule->groupBy('day'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day => $activities): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <h3 class="font-bold text-lg text-gray-900 mb-3">Día <?php echo e($day); ?></h3>
                            <div class="space-y-3">
                                <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0">
                                        <span class="text-sm font-medium text-blue-600"><?php echo e($activity->start_time); ?></span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-900"><?php echo e($activity->title); ?></p>
                                        <p class="text-sm text-gray-600"><?php echo e($activity->description); ?></p>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 sticky top-8 space-y-6">
                <!-- Estadísticas -->
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-blue-50 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Equipos inscritos</p>
                            <p class="text-2xl font-bold text-gray-900"><?php echo e($equiposCount); ?></p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-green-50 rounded-lg">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Tamaño de equipo</p>
                            <p class="text-2xl font-bold text-gray-900"><?php echo e($evento->min_team_size); ?>-<?php echo e($evento->max_team_size); ?> integrantes</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-purple-50 rounded-lg">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Premio principal</p>
                            <p class="text-2xl font-bold text-gray-900">$50,000 MXN</p>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <!-- Información para asesor -->
                    <p class="text-sm text-gray-600 text-center mb-4">
                        Vista de asesor - Puedes ver los equipos participantes en la sección de Equipos
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.asesor-dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Cheluis\Documentos\7Semestre\Programacion web\ProyectoPW\resources\views/asesor/evento-detalle.blade.php ENDPATH**/ ?>