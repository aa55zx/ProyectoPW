<?php $__env->startSection('title', 'Eventos - EvenTec'); ?>
<?php $__env->startSection('breadcrumb', 'Eventos'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Encabezado -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Eventos Asignados</h1>
        <p class="text-gray-600 mt-2 text-lg">Gestiona los eventos donde participas como juez evaluador.</p>
    </div>

    <!-- Filtros -->
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-8 border border-gray-100">
        <form method="GET" action="<?php echo e(route('juez.eventos')); ?>">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Buscar evento</label>
                    <input type="text" 
                           name="search"
                           value="<?php echo e(request('search')); ?>"
                           placeholder="Nombre del evento..." 
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                <div class="w-full md:w-48">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                    <select name="status" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Todos</option>
                        <option value="in_progress" <?php echo e(request('status') == 'in_progress' ? 'selected' : ''); ?>>En curso</option>
                        <option value="upcoming" <?php echo e(request('status') == 'upcoming' ? 'selected' : ''); ?>>Próximamente</option>
                        <option value="completed" <?php echo e(request('status') == 'completed' ? 'selected' : ''); ?>>Finalizado</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-all duration-300">
                        Filtrar
                    </button>
                </div>
            </div>
        </form>
    </div>

    <?php if($events->isEmpty()): ?>
        <div class="bg-white rounded-2xl shadow-sm p-12 text-center border border-gray-100">
            <svg class="w-20 h-20 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No hay eventos disponibles</h3>
            <p class="text-gray-600">No se encontraron eventos con proyectos para evaluar.</p>
        </div>
    <?php else: ?>
        <!-- Grid de Eventos -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    // Determinar el estado del evento
                    $now = now();
                    $isUpcoming = $event->event_start_date > $now;
                    $isCompleted = $event->status === 'completed' || $event->event_end_date < $now;
                    $isInProgress = !$isUpcoming && !$isCompleted;
                    
                    // Badge del estado
                    if ($isCompleted) {
                        $statusBadge = 'bg-gray-600';
                        $statusText = 'Finalizado';
                    } elseif ($isUpcoming) {
                        $statusBadge = 'bg-blue-600';
                        $statusText = 'Próximamente';
                    } else {
                        $statusBadge = 'bg-green-500';
                        $statusText = 'En curso';
                    }
                    
                    // Formatear fechas
                    $startDate = \Carbon\Carbon::parse($event->event_start_date)->format('d M');
                    $endDate = \Carbon\Carbon::parse($event->event_end_date)->format('d M');
                    $dateRange = $startDate === $endDate ? $startDate : "$startDate-$endDate";
                    
                    // Imagen por defecto basada en la categoría
                    $categoryImages = [
                        'technology' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&q=80',
                        'science' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80',
                        'business' => 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=800&q=80',
                        'engineering' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=800&q=80',
                    ];
                    $eventImage = $event->banner_image ?? $categoryImages[$event->category] ?? 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80';
                ?>

                <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 border border-gray-100">
                    <div class="relative h-48">
                        <img src="<?php echo e($eventImage); ?>" 
                             alt="<?php echo e($event->title); ?>" 
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1.5 <?php echo e($statusBadge); ?> text-white text-xs font-semibold rounded-full shadow-lg">
                                <?php echo e($statusText); ?>

                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-xl font-bold text-white"><?php echo e($event->title); ?></h3>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex items-center gap-4 mb-4 text-sm text-gray-600">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="font-medium"><?php echo e($dateRange); ?></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span class="font-medium"><?php echo e($event->projects_count); ?> proyecto<?php echo e($event->projects_count != 1 ? 's' : ''); ?></span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="flex justify-between text-sm mb-2">
                                <span class="text-gray-600 font-medium">Proyectos evaluados</span>
                                <span class="font-bold <?php echo e($event->evaluation_progress == 100 ? 'text-green-600' : 'text-indigo-600'); ?>">
                                    <?php echo e($event->evaluated_projects_count); ?>/<?php echo e($event->projects_count); ?>

                                </span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="h-2 rounded-full transition-all duration-500 <?php echo e($event->evaluation_progress == 100 ? 'bg-green-600' : 'bg-indigo-600'); ?>" 
                                     style="width: <?php echo e($event->evaluation_progress); ?>%"></div>
                            </div>
                        </div>
                        
                        <?php if($isCompleted): ?>
                            <a href="<?php echo e(route('juez.rankings', ['event_id' => $event->id])); ?>" 
                               class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 px-5 rounded-xl transition-all duration-300 flex items-center justify-center gap-2">
                                Ver resultados
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </a>
                        <?php elseif($isUpcoming): ?>
                            <button class="w-full bg-gray-300 text-gray-500 font-semibold py-3 px-5 rounded-xl cursor-not-allowed flex items-center justify-center gap-2">
                                Próximamente
                            </button>
                        <?php else: ?>
                            <a href="<?php echo e(route('juez.evaluaciones', ['event_id' => $event->id])); ?>" 
                               class="w-full bg-gray-900 hover:bg-gray-800 text-white font-semibold py-3 px-5 rounded-xl transition-all duration-300 flex items-center justify-center gap-2">
                                Ver proyectos
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.juez', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Cheluis\Documentos\7Semestre\Programacion web\ProyectoPW\resources\views/juez/eventos.blade.php ENDPATH**/ ?>