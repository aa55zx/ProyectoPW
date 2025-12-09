<?php $__env->startSection('title', 'Dashboard - EvenTec'); ?>
<?php $__env->startSection('breadcrumb', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Encabezado de Bienvenida -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">¡Hola, Dr.<?php echo e(explode(' ', auth()->user()->name)[count(explode(' ', auth()->user()->name))-1]); ?>!</h1>
        <p class="text-gray-600 mt-2 text-lg">Evalúa los proyectos asignados con criterios objetivos.</p>
    </div>

    <!-- Tarjetas de Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Pendientes de Evaluar -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 mb-2">Pendientes de Evaluar</p>
                    <p class="text-4xl font-bold text-gray-900 mb-1"><?php echo e($pendingEvaluations); ?></p>
                </div>
                <div class="bg-indigo-50 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Evaluaciones Completadas -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 mb-2">Evaluaciones Completadas</p>
                    <p class="text-4xl font-bold text-gray-900 mb-1"><?php echo e($completedEvaluations); ?></p>
                </div>
                <div class="bg-green-50 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Eventos Asignados -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 mb-2">Eventos Asignados</p>
                    <p class="text-4xl font-bold text-gray-900 mb-1"><?php echo e($assignedEvents); ?></p>
                </div>
                <div class="bg-blue-50 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Promedio Otorgado -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 mb-2">Promedio Otorgado</p>
                    <p class="text-4xl font-bold text-gray-900 mb-1"><?php echo e(number_format($averageScore, 1)); ?>%</p>
                </div>
                <div class="bg-purple-50 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido Principal: Proyectos y Gráfico -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Proyectos por Evaluar (2/3 del ancho) -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900">Proyectos por Evaluar</h2>
                </div>

                <?php if($pendingProjects->isEmpty()): ?>
                    <div class="p-8 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-gray-600 text-lg">No hay proyectos pendientes de evaluar</p>
                        <p class="text-gray-500 text-sm mt-2">¡Excelente trabajo! Has completado todas tus evaluaciones.</p>
                    </div>
                <?php else: ?>
                    <div class="divide-y divide-gray-100">
                        <?php $__currentLoopData = $pendingProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2"><?php echo e($project->title); ?></h3>
                                    <p class="text-sm text-gray-600 mb-1">
                                        <span class="font-medium">Equipo:</span> <?php echo e($project->team->name); ?>

                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Evento:</span> <?php echo e($project->event->title); ?>

                                    </p>
                                </div>
                                <a href="<?php echo e(route('juez.evaluar-proyecto', $project->id)); ?>" 
                                   class="px-6 py-2.5 bg-gray-900 hover:bg-gray-800 text-white font-semibold rounded-xl transition-all duration-300 shadow-md hover:shadow-lg">
                                    Evaluar
                                </a>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <?php if($pendingEvaluations > 5): ?>
                    <div class="p-4 border-t border-gray-100 text-center">
                        <a href="<?php echo e(route('juez.evaluaciones')); ?>" class="text-indigo-600 hover:text-indigo-700 font-medium text-sm">
                            Ver todos los proyectos pendientes (<?php echo e($pendingEvaluations); ?>)
                        </a>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Promedios por Criterio (1/3 del ancho) -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Promedios por Criterio</h2>
                
                <?php if($criteriaAverages->isEmpty()): ?>
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <p class="text-gray-500 text-sm">Sin datos de criterios</p>
                    </div>
                <?php else: ?>
                    <div class="space-y-4 mb-8">
                        <?php $__currentLoopData = $criteriaAverages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $criterionName => $average): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700"><?php echo e($criterionName); ?></span>
                                <span class="text-sm font-bold text-indigo-600"><?php echo e(number_format($average, 1)); ?>%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-indigo-600 h-3 rounded-full transition-all duration-500" style="width: <?php echo e($average); ?>%"></div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Gráfico de Barras -->
                    <div class="pt-6 border-t border-gray-100">
                        <canvas id="criteriosChart" class="w-full" height="250"></canvas>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php if($criteriaAverages->isNotEmpty()): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('criteriosChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($criteriaAverages->keys(), 15, 512) ?>,
                datasets: [{
                    label: 'Promedio',
                    data: <?php echo json_encode($criteriaAverages->values(), 15, 512) ?>,
                    backgroundColor: Array(<?php echo json_encode($criteriaAverages->count(), 15, 512) ?>).fill('rgba(99, 102, 241, 0.8)'),
                    borderColor: Array(<?php echo json_encode($criteriaAverages->count(), 15, 512) ?>).fill('rgba(99, 102, 241, 1)'),
                    borderWidth: 2,
                    borderRadius: 8,
                    barThickness: 30
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: function(value) {
                                return value;
                            },
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            display: true,
                            drawBorder: false,
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.juez', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\em556\Desktop\ProyectoPW\resources\views/juez/dashboard.blade.php ENDPATH**/ ?>