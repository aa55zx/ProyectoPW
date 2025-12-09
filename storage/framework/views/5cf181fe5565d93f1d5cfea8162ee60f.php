

<?php $__env->startSection('title', 'Detalle del Proyecto - Asesor'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1">
            <li>
                <a href="<?php echo e(route('asesor.dashboard')); ?>" class="flex items-center text-gray-500 hover:text-gray-700">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <a href="<?php echo e(route('asesor.proyectos')); ?>" class="text-sm text-gray-500 hover:text-gray-700">Proyectos</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm font-medium text-gray-800"><?php echo e($proyecto->title); ?></span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header con estado -->
    <div class="mb-8 flex items-start justify-between">
        <div class="flex-1">
            <h1 class="text-3xl font-bold text-gray-900 mb-2"><?php echo e($proyecto->title); ?></h1>
            <p class="text-gray-600"><?php echo e($proyecto->description ?? 'Sin descripción'); ?></p>
        </div>
        <div>
            <?php if($proyecto->status === 'draft' || $proyecto->status === 'in_progress'): ?>
                <span class="px-4 py-2 bg-yellow-100 text-yellow-700 text-sm font-semibold rounded-full">En progreso</span>
            <?php elseif($proyecto->status === 'submitted'): ?>
                <span class="px-4 py-2 bg-blue-100 text-blue-700 text-sm font-semibold rounded-full">Entregado</span>
            <?php elseif($proyecto->status === 'evaluated'): ?>
                <span class="px-4 py-2 bg-green-100 text-green-700 text-sm font-semibold rounded-full">Evaluado</span>
            <?php endif; ?>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Columna principal -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Información del equipo -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Equipo</h2>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-lg"><?php echo e(substr($proyecto->team->name, 0, 2)); ?></span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900"><?php echo e($proyecto->team->name); ?></h3>
                        <p class="text-sm text-gray-500"><?php echo e($proyecto->team->members->count()); ?> miembros</p>
                    </div>
                </div>

                <h3 class="font-semibold text-gray-900 mb-3">Miembros del equipo</h3>
                <div class="space-y-2">
                    <?php $__currentLoopData = $proyecto->team->members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                            <span class="text-gray-700 font-semibold text-sm"><?php echo e(substr($member->name, 0, 2)); ?></span>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-900"><?php echo e($member->name); ?></p>
                            <p class="text-xs text-gray-500"><?php echo e($member->email); ?></p>
                        </div>
                        <?php if($member->pivot->role === 'leader'): ?>
                        <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded">Líder</span>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- Recursos del proyecto -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Recursos del Proyecto</h2>
                
                <div class="space-y-3">
                    <?php if($proyecto->repository_url): ?>
                    <a href="<?php echo e($proyecto->repository_url); ?>" target="_blank" class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">Repositorio</p>
                            <p class="text-sm text-gray-500">Ver código fuente</p>
                        </div>
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    <?php endif; ?>

                    <?php if($proyecto->demo_url): ?>
                    <a href="<?php echo e($proyecto->demo_url); ?>" target="_blank" class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">Demo</p>
                            <p class="text-sm text-gray-500">Ver proyecto en vivo</p>
                        </div>
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    <?php endif; ?>

                    <?php if(!$proyecto->repository_url && !$proyecto->demo_url): ?>
                    <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-gray-300 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-500">No hay recursos disponibles</p>
                            <p class="text-sm text-gray-400">El equipo aún no ha agregado enlaces</p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Columna lateral -->
        <div class="space-y-6">
            <!-- Información del evento -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Evento</h2>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-500">Nombre</p>
                        <p class="font-semibold text-gray-900"><?php echo e($proyecto->event->title); ?></p>
                    </div>
                    <div>
                        <p class="text-gray-500">Fecha inicio</p>
                        <p class="font-semibold text-gray-900"><?php echo e(\Carbon\Carbon::parse($proyecto->event->event_start_date)->format('d/m/Y')); ?></p>
                    </div>
                    <div>
                        <p class="text-gray-500">Fecha fin</p>
                        <p class="font-semibold text-gray-900"><?php echo e(\Carbon\Carbon::parse($proyecto->event->event_end_date)->format('d/m/Y')); ?></p>
                    </div>
                </div>
            </div>

            <!-- Puntuación -->
            <?php if($proyecto->final_score): ?>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Evaluación</h2>
                <div class="text-center">
                    <div class="text-5xl font-bold text-gray-900 mb-2"><?php echo e($proyecto->final_score); ?></div>
                    <p class="text-sm text-gray-500">Puntuación final</p>
                    <?php if($proyecto->rank): ?>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-2xl font-bold text-blue-600">#<?php echo e($proyecto->rank); ?></p>
                        <p class="text-sm text-gray-500">Posición en ranking</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Fechas del proyecto -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Información</h2>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-500">Creado</p>
                        <p class="font-semibold text-gray-900"><?php echo e(\Carbon\Carbon::parse($proyecto->created_at)->format('d/m/Y H:i')); ?></p>
                    </div>
                    <?php if($proyecto->submitted_at): ?>
                    <div>
                        <p class="text-gray-500">Entregado</p>
                        <p class="font-semibold text-gray-900"><?php echo e(\Carbon\Carbon::parse($proyecto->submitted_at)->format('d/m/Y H:i')); ?></p>
                    </div>
                    <?php endif; ?>
                    <div>
                        <p class="text-gray-500">Última actualización</p>
                        <p class="font-semibold text-gray-900"><?php echo e(\Carbon\Carbon::parse($proyecto->updated_at)->format('d/m/Y H:i')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sección de Comentarios del Asesor -->
    <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Comentarios del Asesor</h2>
        
        <!-- Formulario para nuevo comentario -->
        <form action="<?php echo e(route('asesor.proyecto.comentario', $proyecto->id)); ?>" method="POST" class="mb-6">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Agregar un comentario</label>
                <textarea 
                    name="comment" 
                    id="comment" 
                    rows="4" 
                    required
                    maxlength="1000"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none" 
                    placeholder="Escribe tus observaciones, sugerencias o comentarios sobre el proyecto..."></textarea>
                <p class="mt-1 text-xs text-gray-500">Máximo 1000 caracteres</p>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    Publicar Comentario
                </button>
            </div>
        </form>

        <!-- Lista de comentarios -->
        <?php if($comentarios && $comentarios->count() > 0): ?>
        <div class="space-y-4 border-t border-gray-200 pt-6">
            <?php $__currentLoopData = $comentarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comentario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex gap-4">
                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-white font-semibold text-sm"><?php echo e(substr($comentario->user->name, 0, 2)); ?></span>
                </div>
                <div class="flex-1">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="font-semibold text-gray-900"><?php echo e($comentario->user->name); ?></h4>
                            <span class="text-xs text-gray-500"><?php echo e(\Carbon\Carbon::parse($comentario->created_at)->diffForHumans()); ?></span>
                        </div>
                        <p class="text-gray-700"><?php echo e($comentario->comment); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php else: ?>
        <div class="text-center py-8 border-t border-gray-200 mt-6">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            <p class="text-gray-500 font-medium">Aún no hay comentarios</p>
            <p class="text-sm text-gray-400 mt-1">Sé el primero en comentar sobre este proyecto</p>
        </div>
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.asesor-dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\merin\Downloads\ProyectoPW\resources\views/asesor/proyecto-detalle.blade.php ENDPATH**/ ?>