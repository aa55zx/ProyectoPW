<?php $__env->startSection('title', 'Rankings'); ?>
<?php $__env->startSection('breadcrumb', 'Rankings'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Encabezado -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Rankings y Estadísticas</h1>
        <p class="text-gray-600 mt-2 text-lg">Visualiza el desempeño de equipos y participantes</p>
    </div>

    <!-- Filtros -->
    <form method="GET" action="<?php echo e(route('admin.rankings')); ?>" class="bg-white rounded-2xl shadow-sm p-6 mb-8 border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Evento</label>
                <select name="event_id" onchange="this.form.submit()" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
                    <option value="">Todos los eventos</option>
                    <?php $__currentLoopData = $eventos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($evento->id); ?>" <?php echo e(request('event_id') == $evento->id ? 'selected' : ''); ?>>
                        <?php echo e($evento->title); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Mostrar</label>
                <select class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
                    <option>Top 10</option>
                    <option>Top 20</option>
                    <option>Todos</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="button" onclick="exportRankings()" class="w-full px-4 py-2.5 bg-green-600 text-white rounded-xl hover:bg-green-700 transition-colors text-sm font-medium">
                    Exportar Rankings
                </button>
            </div>
        </div>
    </form>

    <?php if($proyectos->isEmpty()): ?>
    <div class="bg-white rounded-2xl shadow-sm p-12 text-center">
        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No hay proyectos evaluados</h3>
        <p class="text-gray-600">Los rankings aparecerán cuando los proyectos sean evaluados</p>
    </div>
    <?php else: ?>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Top Proyectos -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">Top Proyectos</h2>
                            <p class="text-sm text-gray-600 mt-1">Basado en puntuación de evaluaciones</p>
                        </div>
                        <?php if(request('event_id')): ?>
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 text-sm font-medium rounded-full">
                            Filtrado por evento
                        </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="divide-y divide-gray-100">
                    <?php $__currentLoopData = $proyectos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proyecto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="p-6 hover:bg-gray-50 transition-colors cursor-pointer" onclick="viewProjectDetails('<?php echo e($proyecto->id); ?>')">
                        <div class="flex items-center gap-4">
                            <!-- Posición -->
                            <div class="flex-shrink-0">
                                <?php if($proyecto->display_rank <= 3): ?>
                                <div class="w-16 h-16 rounded-full flex items-center justify-center
                                    <?php echo e($proyecto->display_rank == 1 ? 'bg-gradient-to-br from-yellow-400 to-yellow-500' : 
                                       ($proyecto->display_rank == 2 ? 'bg-gradient-to-br from-gray-300 to-gray-400' : 
                                        'bg-gradient-to-br from-orange-400 to-orange-500')); ?>

                                    shadow-lg">
                                    <span class="text-2xl font-bold text-white"><?php echo e($proyecto->display_rank); ?></span>
                                </div>
                                <?php else: ?>
                                <div class="w-16 h-16 rounded-full flex items-center justify-center bg-gray-100">
                                    <span class="text-2xl font-bold text-gray-700"><?php echo e($proyecto->display_rank); ?></span>
                                </div>
                                <?php endif; ?>
                            </div>

                            <!-- Información del Proyecto -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-gray-900 mb-1"><?php echo e($proyecto->title); ?></h3>
                                        <p class="text-sm text-gray-600 mb-2"><?php echo e($proyecto->team->name); ?></p>
                                        <div class="flex items-center gap-4">
                                            <div class="flex items-center gap-1 text-sm text-gray-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                                </svg>
                                                <span><?php echo e($proyecto->team->members_count); ?> integrantes</span>
                                            </div>
                                            <div class="flex items-center gap-1 text-sm text-gray-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <span><?php echo e($proyecto->event->title); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Puntuación -->
                                    <div class="flex-shrink-0 text-right">
                                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl text-white">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <span class="text-2xl font-bold"><?php echo e(number_format($proyecto->final_score, 1)); ?></span>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">de 100</p>
                                    </div>
                                </div>

                                <!-- Líder del Equipo -->
                                <div class="mt-3 flex items-center gap-2">
                                    <span class="text-xs text-gray-500">Líder:</span>
                                    <span class="text-sm font-medium text-gray-700"><?php echo e($proyecto->team->leader->name); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <!-- Estadísticas Laterales -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Estadística General -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Estadísticas Generales</h3>
                
                <div class="space-y-4">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4">
                        <p class="text-sm text-blue-700 mb-1">Promedio General</p>
                        <p class="text-3xl font-bold text-blue-900"><?php echo e(number_format($proyectos->avg('final_score'), 1)); ?></p>
                    </div>

                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4">
                        <p class="text-sm text-green-700 mb-1">Puntuación Más Alta</p>
                        <p class="text-3xl font-bold text-green-900"><?php echo e(number_format($proyectos->max('final_score'), 1)); ?></p>
                    </div>

                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-4">
                        <p class="text-sm text-purple-700 mb-1">Proyectos Evaluados</p>
                        <p class="text-3xl font-bold text-purple-900"><?php echo e($proyectos->count()); ?></p>
                    </div>

                    <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-4">
                        <p class="text-sm text-orange-700 mb-1">Equipos Participantes</p>
                        <p class="text-3xl font-bold text-orange-900"><?php echo e($proyectos->unique('team_id')->count()); ?></p>
                    </div>
                </div>
            </div>

            <!-- Top 3 Rápido -->
            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl shadow-sm p-6 border border-yellow-200">
                <h3 class="text-lg font-bold text-yellow-900 mb-4">🏆 Podio</h3>
                
                <div class="space-y-3">
                    <?php $__currentLoopData = $proyectos->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $top): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white/80 backdrop-blur rounded-xl p-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center
                                <?php echo e($top->display_rank == 1 ? 'bg-yellow-400' : ($top->display_rank == 2 ? 'bg-gray-300' : 'bg-orange-400')); ?>">
                                <span class="text-sm font-bold text-white"><?php echo e($top->display_rank); ?></span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-gray-900 truncate"><?php echo e(Str::limit($top->team->name, 20)); ?></p>
                                <p class="text-xs text-gray-600"><?php echo e(number_format($top->final_score, 1)); ?> pts</p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- Distribución de Puntuaciones -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Distribución</h3>
                
                <div class="space-y-3">
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm text-gray-600">90-100</span>
                            <span class="text-sm font-medium text-gray-900"><?php echo e($proyectos->where('final_score', '>=', 90)->count()); ?></span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: <?php echo e(($proyectos->where('final_score', '>=', 90)->count() / max($proyectos->count(), 1)) * 100); ?>%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm text-gray-600">80-89</span>
                            <span class="text-sm font-medium text-gray-900"><?php echo e($proyectos->whereBetween('final_score', [80, 89])->count()); ?></span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: <?php echo e(($proyectos->whereBetween('final_score', [80, 89])->count() / max($proyectos->count(), 1)) * 100); ?>%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm text-gray-600">70-79</span>
                            <span class="text-sm font-medium text-gray-900"><?php echo e($proyectos->whereBetween('final_score', [70, 79])->count()); ?></span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-yellow-500 h-2 rounded-full" style="width: <?php echo e(($proyectos->whereBetween('final_score', [70, 79])->count() / max($proyectos->count(), 1)) * 100); ?>%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm text-gray-600">< 70</span>
                            <span class="text-sm font-medium text-gray-900"><?php echo e($proyectos->where('final_score', '<', 70)->count()); ?></span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-red-500 h-2 rounded-full" style="width: <?php echo e(($proyectos->where('final_score', '<', 70)->count() / max($proyectos->count(), 1)) * 100); ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
function viewProjectDetails(projectId) {
    // Redirigir o abrir modal con detalles del proyecto
    window.location.href = `/admin/proyectos/${projectId}`;
}

function exportRankings() {
    alert('Funcionalidad de exportación en desarrollo. Los rankings se exportarán en formato CSV/PDF.');
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\em556\Desktop\ProyectoPW\resources\views/admin/rankings.blade.php ENDPATH**/ ?>