<div class="evento-card bg-white rounded-lg shadow-sm hover:shadow-md transition-all overflow-hidden border border-gray-200" 
     data-category="<?php echo e($evento->category); ?>">
    
    <!-- Imagen del evento -->
    <div class="relative h-48">
        <?php if($evento->cover_image_url): ?>
            <img src="<?php echo e($evento->cover_image_url); ?>" alt="<?php echo e($evento->title); ?>" class="w-full h-full object-cover">
        <?php else: ?>
            <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        <?php endif; ?>
        
        <!-- Badge de categoría -->
        <div class="absolute top-4 right-4">
            <span class="px-3 py-1 bg-white text-gray-900 text-xs font-medium rounded border border-gray-200 shadow-sm">
                <?php echo e($evento->category); ?>

            </span>
        </div>

        <!-- Badge de estado -->
        <div class="absolute top-4 left-4">
            <?php if($tipo === 'proximo'): ?>
                <span class="px-3 py-1 bg-blue-600 text-white text-xs font-medium rounded shadow-sm flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Próximamente
                </span>
            <?php elseif($tipo === 'activo'): ?>
                <span class="px-3 py-1 bg-green-600 text-white text-xs font-medium rounded shadow-sm flex items-center gap-1.5">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                    </span>
                    En Curso
                </span>
            <?php else: ?>
                <span class="px-3 py-1 bg-gray-600 text-white text-xs font-medium rounded shadow-sm flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Finalizado
                </span>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Contenido -->
    <div class="p-6">
        <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2 hover:text-blue-600 transition-colors">
            <?php echo e($evento->title); ?>

        </h3>
        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
            <?php echo e($evento->short_description ?? Str::limit($evento->description, 100)); ?>

        </p>
        
        <!-- Info del evento -->
        <div class="space-y-2.5 mb-5 text-sm text-gray-600">
            <div class="flex items-center gap-2.5">
                <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span class="text-gray-700">
                    <?php if($tipo === 'proximo'): ?>
                        Inicia: <?php echo e(\Carbon\Carbon::parse($evento->event_start_date)->format('d M Y')); ?>

                    <?php elseif($tipo === 'activo'): ?>
                        Finaliza: <?php echo e(\Carbon\Carbon::parse($evento->event_end_date)->format('d M Y')); ?>

                    <?php else: ?>
                        Finalizó: <?php echo e(\Carbon\Carbon::parse($evento->event_end_date)->format('d M Y')); ?>

                    <?php endif; ?>
                </span>
            </div>
            <div class="flex items-center gap-2.5">
                <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span class="text-gray-700"><?php echo e($evento->registered_teams_count ?? 0); ?> equipos inscritos</span>
            </div>
            <div class="flex items-center gap-2.5">
                <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <span class="text-gray-700"><?php echo e($evento->min_team_size); ?>-<?php echo e($evento->max_team_size); ?> integrantes</span>
            </div>
        </div>
        
        <!-- Botón -->
        <a href="<?php echo e(route('estudiante.evento-detalle', $evento->id)); ?>" 
           class="block w-full py-2.5 px-4 bg-gray-900 text-white text-center rounded-lg hover:bg-gray-800 transition-colors font-medium text-sm shadow-sm hover:shadow">
            <?php if($tipo === 'proximo'): ?>
                Ver detalles e inscribirme
            <?php elseif($tipo === 'activo'): ?>
                Ver evento en curso
            <?php else: ?>
                Ver resultados
            <?php endif; ?>
        </a>
    </div>
</div>
<?php /**PATH D:\Cheluis\Documentos\7Semestre\Programacion web\ProyectoPW\resources\views/estudiante/partials/evento-card.blade.php ENDPATH**/ ?>