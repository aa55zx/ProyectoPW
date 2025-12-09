<?php $__env->startSection('title', 'Detalles del Evento'); ?>
<?php $__env->startSection('breadcrumb', 'Eventos / ' . $evento->title); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Encabezado con Banner -->
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-8 mb-8 text-white">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-3">
                    <h1 class="text-4xl font-bold"><?php echo e($evento->title); ?></h1>
                    <span class="px-4 py-1.5 bg-white/20 backdrop-blur-sm text-white text-sm font-semibold rounded-full">
                        <?php echo e($evento->getStatusLabel()); ?>

                    </span>
                </div>
                <p class="text-blue-100 mb-4 text-lg"><?php echo e($evento->short_description); ?></p>
                <div class="flex items-center gap-6 text-sm">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span><?php echo e($evento->event_start_date->format('d M Y')); ?> - <?php echo e($evento->event_end_date->format('d M Y')); ?></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span><?php echo e($evento->location ?? 'Online'); ?></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        <span><?php echo e($evento->category); ?></span>
                    </div>
                </div>
            </div>
            <a href="<?php echo e(route('admin.eventos')); ?>" class="px-6 py-3 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-xl transition-all font-medium">
                Volver
            </a>
        </div>
    </div>

    <!-- Estadísticas del Evento -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-gray-500">Equipos Inscritos</h3>
                <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <p class="text-3xl font-bold text-gray-900"><?php echo e($evento->teams->count()); ?></p>
            <?php if($evento->max_teams): ?>
            <p class="text-sm text-gray-600 mt-1">de <?php echo e($evento->max_teams); ?> máximo</p>
            <?php endif; ?>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-gray-500">Proyectos</h3>
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <p class="text-3xl font-bold text-gray-900"><?php echo e($evento->projects->count()); ?></p>
            <p class="text-sm text-gray-600 mt-1">presentados</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-gray-500">Jueces Asignados</h3>
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="text-3xl font-bold text-gray-900"><?php echo e($evento->judges->count()); ?></p>
            <p class="text-sm text-gray-600 mt-1">evaluando</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-gray-500">Participantes</h3>
                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <p class="text-3xl font-bold text-gray-900"><?php echo e($evento->teams->sum('members_count')); ?></p>
            <p class="text-sm text-gray-600 mt-1">en total</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Información Detallada -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Descripción -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900">Descripción</h2>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line"><?php echo e($evento->description); ?></p>
                </div>
            </div>

            <!-- Equipos Participantes -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-gray-900">Equipos Participantes</h2>
                        <span class="px-3 py-1 bg-purple-100 text-purple-700 text-sm font-medium rounded-full">
                            <?php echo e($evento->teams->count()); ?> equipos
                        </span>
                    </div>
                </div>
                <div class="divide-y divide-gray-100">
                    <?php $__empty_1 = true; $__currentLoopData = $evento->teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start gap-4 flex-1">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold">
                                    <?php echo e(substr($equipo->name, 0, 2)); ?>

                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-gray-900 mb-1"><?php echo e($equipo->name); ?></h3>
                                    <p class="text-sm text-gray-600 mb-2"><?php echo e($equipo->description); ?></p>
                                    <div class="flex items-center gap-4 text-sm">
                                        <span class="text-gray-600">
                                            <strong>Líder:</strong> <?php echo e($equipo->leader->name); ?>

                                        </span>
                                        <span class="text-gray-600">
                                            <strong>Miembros:</strong> <?php echo e($equipo->members_count); ?>

                                        </span>
                                        <?php if($equipo->project): ?>
                                        <span class="px-2 py-0.5 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                                            Con proyecto
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="p-12 text-center">
                        <p class="text-gray-500">No hay equipos inscritos aún</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Proyectos -->
            <?php if($evento->projects->count() > 0): ?>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-gray-900">Proyectos Presentados</h2>
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 text-sm font-medium rounded-full">
                            <?php echo e($evento->projects->count()); ?> proyectos
                        </span>
                    </div>
                </div>
                <div class="divide-y divide-gray-100">
                    <?php $__currentLoopData = $evento->projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proyecto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h3 class="font-bold text-gray-900 mb-1"><?php echo e($proyecto->title); ?></h3>
                                <p class="text-sm text-gray-600 mb-2"><?php echo e(Str::limit($proyecto->description, 100)); ?></p>
                                <p class="text-sm text-gray-600"><strong>Equipo:</strong> <?php echo e($proyecto->team->name); ?></p>
                            </div>
                            <span class="px-3 py-1 
                                <?php if($proyecto->status === 'evaluated'): ?> bg-green-100 text-green-700
                                <?php elseif($proyecto->status === 'submitted'): ?> bg-blue-100 text-blue-700
                                <?php else: ?> bg-gray-100 text-gray-700
                                <?php endif; ?>
                                text-xs font-medium rounded-full">
                                <?php echo e(ucfirst($proyecto->status)); ?>

                            </span>
                        </div>
                        <?php if($proyecto->final_score): ?>
                        <div class="flex items-center gap-2 mt-2">
                            <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <span class="text-sm font-semibold text-gray-900"><?php echo e(number_format($proyecto->final_score, 1)); ?>/100</span>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Panel Lateral -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Información del Evento -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Información del Evento</h3>
                
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Fecha de Registro</p>
                        <p class="text-sm font-semibold text-gray-900">
                            <?php echo e($evento->registration_start_date->format('d M Y')); ?> - 
                            <?php echo e($evento->registration_end_date->format('d M Y')); ?>

                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 mb-1">Tamaño del Equipo</p>
                        <p class="text-sm font-semibold text-gray-900">
                            <?php echo e($evento->min_team_size); ?> - <?php echo e($evento->max_team_size); ?> integrantes
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 mb-1">Tipo de Evento</p>
                        <p class="text-sm font-semibold text-gray-900"><?php echo e(ucfirst($evento->event_type ?? 'competition')); ?></p>
                    </div>

                    <?php if($evento->contact_email): ?>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Contacto</p>
                        <p class="text-sm font-semibold text-gray-900"><?php echo e($evento->contact_email); ?></p>
                    </div>
                    <?php endif; ?>

                    <div>
                        <p class="text-sm text-gray-500 mb-1">Modalidad</p>
                        <span class="inline-block px-3 py-1 <?php echo e($evento->is_online ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700'); ?> text-xs font-medium rounded-full">
                            <?php echo e($evento->is_online ? 'En línea' : 'Presencial'); ?>

                        </span>
                    </div>
                </div>
            </div>

            <!-- Jueces Asignados -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Jueces Asignados</h3>
                    <span class="px-2 py-1 bg-purple-100 text-purple-700 text-xs font-medium rounded-full">
                        <?php echo e($evento->judges->count()); ?>

                    </span>
                </div>
                
                <div class="space-y-3">
                    <?php $__empty_1 = true; $__currentLoopData = $evento->judges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $juez): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                        <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                            <?php echo e(substr($juez->name, 0, 2)); ?>

                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 truncate"><?php echo e($juez->name); ?></p>
                            <p class="text-xs text-gray-600 truncate"><?php echo e($juez->email); ?></p>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-sm text-gray-500 text-center py-4">No hay jueces asignados</p>
                    <?php endif; ?>
                </div>

                <button onclick="openJudgesModal('<?php echo e($evento->id); ?>', <?php echo e(json_encode($evento->judges->pluck('id'))); ?>)" class="w-full mt-4 px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-xl transition-colors">
                    Gestionar Jueces
                </button>
            </div>

            <!-- Acciones Rápidas -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Acciones</h3>
                
                <div class="space-y-3">
                    <button onclick="window.history.back()" class="w-full px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-xl transition-colors flex items-center justify-between">
                        <span>Volver a Eventos</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </button>
                    
                    <button class="w-full px-4 py-3 text-sm font-medium text-blue-700 hover:bg-blue-50 rounded-xl transition-colors flex items-center justify-between">
                        <span>Editar Evento</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    
                    <button onclick="confirmDelete('<?php echo e($evento->id); ?>', '<?php echo e($evento->title); ?>')" class="w-full px-4 py-3 text-sm font-medium text-red-700 hover:bg-red-50 rounded-xl transition-colors flex items-center justify-between">
                        <span>Eliminar Evento</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(eventId, eventName) {
    if (confirm(`¿Estás seguro de que deseas eliminar el evento "${eventName}"?`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/eventos/${eventId}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '<?php echo e(csrf_token()); ?>';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\em556\Desktop\ProyectoPW\resources\views/admin/evento-detalle.blade.php ENDPATH**/ ?>