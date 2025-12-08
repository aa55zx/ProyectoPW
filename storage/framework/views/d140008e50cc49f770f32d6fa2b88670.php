<?php $__env->startSection('title', 'Rankings - EvenTec'); ?>
<?php $__env->startSection('breadcrumb', 'Rankings'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Encabezado -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Rankings de Proyectos</h1>
        <p class="text-gray-600 mt-2 text-lg">Visualiza los mejores proyectos basados en las evaluaciones.</p>
    </div>

    <!-- Filtro de Evento -->
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-8 border border-gray-100">
        <form method="GET" action="<?php echo e(route('juez.rankings')); ?>">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Seleccionar Evento</label>
                    <select name="event_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" onchange="this.form.submit()">
                        <option value="">Todos los eventos</option>
                        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($event->id); ?>" <?php echo e($eventId == $event->id ? 'selected' : ''); ?>>
                                <?php echo e($event->title); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="w-full md:w-48">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                    <select name="category" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" onchange="this.form.submit()">
                        <option value="">Todas</option>
                        <option value="technology" <?php echo e($category == 'technology' ? 'selected' : ''); ?>>Tecnología</option>
                        <option value="science" <?php echo e($category == 'science' ? 'selected' : ''); ?>>Ciencias</option>
                        <option value="business" <?php echo e($category == 'business' ? 'selected' : ''); ?>>Negocios</option>
                        <option value="engineering" <?php echo e($category == 'engineering' ? 'selected' : ''); ?>>Ingeniería</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    <?php if($selectedEvent): ?>
        <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-4 mb-6">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="flex-1">
                    <p class="text-sm font-medium text-indigo-900">
                        Mostrando resultados de: <span class="font-bold"><?php echo e($selectedEvent->title); ?></span>
                    </p>
                    <p class="text-xs text-indigo-700"><?php echo e($projects->count()); ?> proyecto<?php echo e($projects->count() != 1 ? 's' : ''); ?> evaluado<?php echo e($projects->count() != 1 ? 's' : ''); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if($projects->isEmpty()): ?>
        <div class="bg-white rounded-2xl shadow-sm p-12 text-center border border-gray-100">
            <svg class="w-20 h-20 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No hay rankings disponibles</h3>
            <p class="text-gray-600">No se encontraron proyectos evaluados para mostrar.</p>
        </div>
    <?php else: ?>
        <!-- Top 3 Podio -->
        <?php if($projects->count() >= 3): ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <?php
                $topThree = $projects->take(3);
                $second = $topThree->get(1);
                $first = $topThree->get(0);
                $third = $topThree->get(2);
            ?>

            <!-- Segundo Lugar -->
            <?php if($second): ?>
            <div class="order-2 md:order-1">
                <div class="bg-gradient-to-br from-gray-400 to-gray-500 rounded-t-2xl p-6 text-white text-center">
                    <div class="w-20 h-20 mx-auto mb-3 bg-white rounded-full flex items-center justify-center">
                        <span class="text-4xl">🥈</span>
                    </div>
                    <p class="text-sm font-medium mb-1">2do Lugar</p>
                    <p class="text-3xl font-bold"><?php echo e(number_format($second->final_score, 1)); ?></p>
                </div>
                <div class="bg-white rounded-b-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2"><?php echo e($second->title); ?></h3>
                    <p class="text-sm text-gray-600 mb-4"><?php echo e($second->team->name); ?></p>
                    <?php if($second->criteria_averages->isNotEmpty()): ?>
                        <div class="grid grid-cols-2 gap-3 text-xs">
                            <?php $__currentLoopData = $second->criteria_averages->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $criterionName => $score): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bg-gray-50 p-2 rounded-lg text-center">
                                    <p class="text-gray-600 truncate"><?php echo e($criterionName); ?></p>
                                    <p class="font-bold text-gray-900"><?php echo e(number_format($score, 0)); ?></p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Primer Lugar -->
            <?php if($first): ?>
            <div class="order-1 md:order-2">
                <div class="bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-t-2xl p-6 text-white text-center">
                    <div class="w-24 h-24 mx-auto mb-3 bg-white rounded-full flex items-center justify-center">
                        <span class="text-5xl">🥇</span>
                    </div>
                    <p class="text-sm font-medium mb-1">1er Lugar</p>
                    <p class="text-4xl font-bold"><?php echo e(number_format($first->final_score, 1)); ?></p>
                </div>
                <div class="bg-white rounded-b-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2"><?php echo e($first->title); ?></h3>
                    <p class="text-sm text-gray-600 mb-4"><?php echo e($first->team->name); ?></p>
                    <?php if($first->criteria_averages->isNotEmpty()): ?>
                        <div class="grid grid-cols-2 gap-3 text-xs">
                            <?php $__currentLoopData = $first->criteria_averages->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $criterionName => $score): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bg-gray-50 p-2 rounded-lg text-center">
                                    <p class="text-gray-600 truncate"><?php echo e($criterionName); ?></p>
                                    <p class="font-bold text-gray-900"><?php echo e(number_format($score, 0)); ?></p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Tercer Lugar -->
            <?php if($third): ?>
            <div class="order-3">
                <div class="bg-gradient-to-br from-orange-400 to-orange-500 rounded-t-2xl p-6 text-white text-center">
                    <div class="w-20 h-20 mx-auto mb-3 bg-white rounded-full flex items-center justify-center">
                        <span class="text-4xl">🥉</span>
                    </div>
                    <p class="text-sm font-medium mb-1">3er Lugar</p>
                    <p class="text-3xl font-bold"><?php echo e(number_format($third->final_score, 1)); ?></p>
                </div>
                <div class="bg-white rounded-b-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2"><?php echo e($third->title); ?></h3>
                    <p class="text-sm text-gray-600 mb-4"><?php echo e($third->team->name); ?></p>
                    <?php if($third->criteria_averages->isNotEmpty()): ?>
                        <div class="grid grid-cols-2 gap-3 text-xs">
                            <?php $__currentLoopData = $third->criteria_averages->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $criterionName => $score): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bg-gray-50 p-2 rounded-lg text-center">
                                    <p class="text-gray-600 truncate"><?php echo e($criterionName); ?></p>
                                    <p class="font-bold text-gray-900"><?php echo e(number_format($score, 0)); ?></p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Tabla Completa -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900">Clasificación Completa</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Posición</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Proyecto</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Equipo</th>
                            <?php if($projects->first() && $projects->first()->criteria_averages->isNotEmpty()): ?>
                                <?php $__currentLoopData = $projects->first()->criteria_averages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $criterionName => $score): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider"><?php echo e($criterionName); ?></th>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $rankClass = '';
                                if ($project->display_rank == 1) {
                                    $rankClass = 'bg-yellow-50';
                                } elseif ($project->display_rank == 2) {
                                    $rankClass = 'bg-gray-50';
                                } elseif ($project->display_rank == 3) {
                                    $rankClass = 'bg-orange-50';
                                }
                            ?>
                            <tr class="<?php echo e($rankClass); ?> hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <?php if($project->display_rank == 1): ?>
                                            <span class="text-2xl mr-2">🥇</span>
                                        <?php elseif($project->display_rank == 2): ?>
                                            <span class="text-2xl mr-2">🥈</span>
                                        <?php elseif($project->display_rank == 3): ?>
                                            <span class="text-2xl mr-2">🥉</span>
                                        <?php endif; ?>
                                        <span class="text-lg font-bold text-gray-900"><?php echo e($project->display_rank); ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-semibold text-gray-900"><?php echo e($project->title); ?></p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-700"><?php echo e($project->team->name); ?></p>
                                    <p class="text-xs text-gray-500"><?php echo e($project->team->leader->name); ?></p>
                                </td>
                                <?php if($project->criteria_averages->isNotEmpty()): ?>
                                    <?php $__currentLoopData = $project->criteria_averages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $score): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                                <?php echo e($score >= 90 ? 'bg-green-100 text-green-700' : 
                                                   ($score >= 80 ? 'bg-blue-100 text-blue-700' : 
                                                   ($score >= 70 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700'))); ?>">
                                                <?php echo e(number_format($score, 0)); ?>

                                            </span>
                                        </td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-4 py-2 rounded-full text-sm font-bold
                                        <?php echo e($project->final_score >= 90 ? 'bg-green-100 text-green-700' : 
                                           ($project->final_score >= 80 ? 'bg-blue-100 text-blue-700' : 
                                           ($project->final_score >= 70 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700'))); ?>">
                                        <?php echo e(number_format($project->final_score, 1)); ?>

                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.juez', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Cheluis\Documentos\7Semestre\Programacion web\ProyectoPW\resources\views/juez/rankings.blade.php ENDPATH**/ ?>