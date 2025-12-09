<?php $__env->startSection('title', 'Eventos'); ?>
<?php $__env->startSection('breadcrumb', 'Eventos'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Mensajes de éxito/error -->
    <?php if(session('success')): ?>
    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
        <p class="text-green-700"><?php echo e(session('success')); ?></p>
    </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
        <p class="text-red-700"><?php echo e(session('error')); ?></p>
    </div>
    <?php endif; ?>

    <!-- Encabezado -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-900">Gestión de Eventos</h1>
            <p class="text-gray-600 mt-2 text-lg">Administra y supervisa todos los eventos académicos</p>
        </div>
        <button onclick="openCreateModal()" class="px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white font-semibold rounded-xl transition-all duration-300 flex items-center gap-2 shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Crear Evento
        </button>
    </div>

    <!-- Filtros -->
    <form method="GET" action="<?php echo e(route('admin.eventos')); ?>" class="bg-white rounded-2xl shadow-sm p-6 mb-8 border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Buscar</label>
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Nombre del evento..." class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                <select name="status" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
                    <option value="">Todos</option>
                    <option value="Activo" <?php echo e(request('status') == 'Activo' ? 'selected' : ''); ?>>Activo</option>
                    <option value="Próximo" <?php echo e(request('status') == 'Próximo' ? 'selected' : ''); ?>>Próximo</option>
                    <option value="Finalizado" <?php echo e(request('status') == 'Finalizado' ? 'selected' : ''); ?>>Finalizado</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                <select name="category" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
                    <option value="">Todas</option>
                    <option value="Tecnología" <?php echo e(request('category') == 'Tecnología' ? 'selected' : ''); ?>>Tecnología</option>
                    <option value="Ciencias" <?php echo e(request('category') == 'Ciencias' ? 'selected' : ''); ?>>Ciencias</option>
                    <option value="Negocios" <?php echo e(request('category') == 'Negocios' ? 'selected' : ''); ?>>Negocios</option>
                    <option value="Arte" <?php echo e(request('category') == 'Arte' ? 'selected' : ''); ?>>Arte</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2.5 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition-colors text-sm font-medium">
                    Filtrar
                </button>
            </div>
        </div>
    </form>

    <!-- Lista de Eventos -->
    <div class="space-y-6">
        <?php $__empty_1 = true; $__currentLoopData = $eventos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-start gap-4 flex-1">
                        <div class="w-20 h-20 bg-gradient-to-br from-<?php echo e($evento->status === 'in_progress' ? 'green' : ($evento->status === 'open' ? 'blue' : 'gray')); ?>-500 to-<?php echo e($evento->status === 'in_progress' ? 'green' : ($evento->status === 'open' ? 'blue' : 'gray')); ?>-600 rounded-xl flex items-center justify-center text-3xl shadow-md flex-shrink-0">
                            <?php if($evento->category === 'Tecnología'): ?>
                                🏆
                            <?php elseif($evento->category === 'Ciencias'): ?>
                                🔬
                            <?php elseif($evento->category === 'Negocios'): ?>
                                💼
                            <?php else: ?>
                                🤖
                            <?php endif; ?>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <h3 class="text-2xl font-bold text-gray-900"><?php echo e($evento->title); ?></h3>
                                <span class="px-3 py-1 <?php echo e($evento->getStatusBadgeClass()); ?> text-xs font-semibold rounded-full">
                                    <?php echo e($evento->getStatusLabel()); ?>

                                </span>
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full"><?php echo e($evento->category); ?></span>
                            </div>
                            <p class="text-gray-600 mb-4"><?php echo e(Str::limit($evento->description, 150)); ?></p>
                            
                            <div class="grid grid-cols-4 gap-4">
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="font-medium"><?php echo e($evento->event_start_date->format('d M')); ?> - <?php echo e($evento->event_end_date->format('d M')); ?></span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <span class="font-medium"><?php echo e($evento->teams_count); ?> equipos</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    <span class="font-medium"><?php echo e($evento->min_team_size); ?>-<?php echo e($evento->max_team_size); ?> integrantes</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span class="font-medium"><?php echo e($evento->projects_count); ?> proyectos</span>
                                </div>
                            </div>

                            <!-- Jueces y Asesores Asignados -->
                            <div class="mt-4 flex items-center gap-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-medium text-gray-700">Jueces:</span>
                                    <?php if($evento->judges_count > 0): ?>
                                    <span class="text-sm text-gray-600"><?php echo e($evento->judges_count); ?> asignados</span>
                                    <button onclick="openJudgesModal('<?php echo e($evento->id); ?>', <?php echo e(json_encode($evento->judges->pluck('id'))); ?>)" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                                        Gestionar
                                    </button>
                                    <?php else: ?>
                                    <button onclick="openJudgesModal('<?php echo e($evento->id); ?>', [])" class="text-sm text-orange-600 hover:text-orange-700 font-medium">
                                        Asignar Jueces
                                    </button>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-medium text-gray-700">Asesores:</span>
                                    <?php if($evento->advisors_count > 0): ?>
                                    <span class="text-sm text-gray-600"><?php echo e($evento->advisors_count); ?> asignados</span>
                                    <button onclick="openAdvisorsModal('<?php echo e($evento->id); ?>', <?php echo e(json_encode($evento->advisors->pluck('id'))); ?>)" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                                        Gestionar
                                    </button>
                                    <?php else: ?>
                                    <button onclick="openAdvisorsModal('<?php echo e($evento->id); ?>', [])" class="text-sm text-orange-600 hover:text-orange-700 font-medium">
                                        Asignar Asesores
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="<?php echo e(route('admin.eventos.ver', $evento->id)); ?>" class="px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                        Ver Detalles
                    </a>
                    <button onclick="openEditModal(<?php echo e(json_encode($evento)); ?>)" class="px-5 py-2.5 text-sm font-medium text-blue-700 hover:bg-blue-50 rounded-lg transition-colors">
                        Editar
                    </button>
                    <button onclick="confirmDelete('<?php echo e($evento->id); ?>', '<?php echo e($evento->title); ?>')" class="px-5 py-2.5 text-sm font-medium text-red-700 hover:bg-red-50 rounded-lg transition-colors">
                        Eliminar
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="bg-white rounded-2xl shadow-sm p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No hay eventos</h3>
            <p class="text-gray-600 mb-6">Crea tu primer evento para comenzar</p>
            <button onclick="openCreateModal()" class="px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white font-semibold rounded-xl transition-all">
                Crear Evento
            </button>
        </div>
        <?php endif; ?>
    </div>

    <!-- Paginación -->
    <?php if($eventos->hasPages()): ?>
    <div class="mt-8">
        <?php echo e($eventos->links()); ?>

    </div>
    <?php endif; ?>
</div>

<!-- Modal Crear Evento -->
<div id="createModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-900">Crear Nuevo Evento</h2>
                <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <form action="<?php echo e(route('admin.eventos.crear')); ?>" method="POST" class="p-6">
            <?php echo csrf_field(); ?>
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Título del Evento *</label>
                        <input type="text" name="title" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Descripción *</label>
                        <textarea name="description" required rows="4" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Categoría *</label>
                        <select name="category" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                            <option value="">Seleccionar</option>
                            <option value="Tecnología">Tecnología</option>
                            <option value="Ciencias">Ciencias</option>
                            <option value="Negocios">Negocios</option>
                            <option value="Arte">Arte</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ubicación</label>
                        <input type="text" name="location" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha Inicio Registro *</label>
                        <input type="date" name="registration_start_date" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha Fin Registro *</label>
                        <input type="date" name="registration_end_date" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha Inicio Evento *</label>
                        <input type="date" name="event_start_date" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha Fin Evento *</label>
                        <input type="date" name="event_end_date" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tamaño Mínimo Equipo *</label>
                        <input type="number" name="min_team_size" required min="1" value="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tamaño Máximo Equipo *</label>
                        <input type="number" name="max_team_size" required min="1" value="5" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Máximo de Equipos</label>
                        <input type="number" name="max_teams" min="1" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" name="is_online" id="is_online" class="w-4 h-4 text-gray-900 border-gray-300 rounded focus:ring-gray-900">
                        <label for="is_online" class="ml-2 text-sm font-medium text-gray-700">Evento en línea</label>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-200">
                <button type="button" onclick="closeCreateModal()" class="px-6 py-2.5 text-gray-700 hover:bg-gray-100 rounded-xl transition-colors font-medium">
                    Cancelar
                </button>
                <button type="submit" class="px-6 py-2.5 bg-gray-900 hover:bg-gray-800 text-white rounded-xl transition-colors font-medium">
                    Crear Evento
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Editar Evento -->
<div id="editModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-900">Editar Evento</h2>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="editForm" method="POST" class="p-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Título del Evento *</label>
                        <input type="text" name="title" id="edit_title" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Descripción *</label>
                        <textarea name="description" id="edit_description" required rows="4" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Categoría *</label>
                        <select name="category" id="edit_category" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                            <option value="">Seleccionar</option>
                            <option value="Tecnología">Tecnología</option>
                            <option value="Ciencias">Ciencias</option>
                            <option value="Negocios">Negocios</option>
                            <option value="Arte">Arte</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ubicación</label>
                        <input type="text" name="location" id="edit_location" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha Inicio Registro *</label>
                        <input type="date" name="registration_start_date" id="edit_registration_start_date" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha Fin Registro *</label>
                        <input type="date" name="registration_end_date" id="edit_registration_end_date" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha Inicio Evento *</label>
                        <input type="date" name="event_start_date" id="edit_event_start_date" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha Fin Evento *</label>
                        <input type="date" name="event_end_date" id="edit_event_end_date" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tamaño Mínimo Equipo *</label>
                        <input type="number" name="min_team_size" id="edit_min_team_size" required min="1" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tamaño Máximo Equipo *</label>
                        <input type="number" name="max_team_size" id="edit_max_team_size" required min="1" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Máximo de Equipos</label>
                        <input type="number" name="max_teams" id="edit_max_teams" min="1" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" name="is_online" id="edit_is_online" class="w-4 h-4 text-gray-900 border-gray-300 rounded focus:ring-gray-900">
                        <label for="edit_is_online" class="ml-2 text-sm font-medium text-gray-700">Evento en línea</label>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-200">
                <button type="button" onclick="closeEditModal()" class="px-6 py-2.5 text-gray-700 hover:bg-gray-100 rounded-xl transition-colors font-medium">
                    Cancelar
                </button>
                <button type="submit" class="px-6 py-2.5 bg-gray-900 hover:bg-gray-800 text-white rounded-xl transition-colors font-medium">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Asignar Jueces -->
<div id="judgesModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-900">Gestionar Jueces del Evento</h2>
                <button onclick="closeJudgesModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="judgesForm" method="POST" class="p-6">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <p class="text-sm text-gray-600">Selecciona uno o más jueces para asignar a este evento:</p>
            </div>
            <div class="space-y-4 max-h-96 overflow-y-auto">
                <?php $__currentLoopData = $jueces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $juez): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 cursor-pointer transition-colors">
                    <input type="checkbox" name="judges[]" value="<?php echo e($juez->id); ?>" class="judge-checkbox w-4 h-4 text-gray-900 border-gray-300 rounded focus:ring-gray-900">
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900"><?php echo e($juez->name); ?></p>
                        <p class="text-xs text-gray-600"><?php echo e($juez->email); ?></p>
                    </div>
                </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-200">
                <button type="button" onclick="closeJudgesModal()" class="px-6 py-2.5 text-gray-700 hover:bg-gray-100 rounded-xl transition-colors font-medium">
                    Cancelar
                </button>
                <button type="submit" class="px-6 py-2.5 bg-gray-900 hover:bg-gray-800 text-white rounded-xl transition-colors font-medium">
                    Guardar Asignación
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Asignar Asesores -->
<div id="advisorsModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-900">Gestionar Asesores del Evento</h2>
                <button onclick="closeAdvisorsModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="advisorsForm" method="POST" class="p-6">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <p class="text-sm text-gray-600">Selecciona uno o más asesores para asignar a este evento:</p>
            </div>
            <div class="space-y-4 max-h-96 overflow-y-auto">
                <?php $__currentLoopData = $asesores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asesor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 cursor-pointer transition-colors">
                    <input type="checkbox" name="advisors[]" value="<?php echo e($asesor->id); ?>" class="advisor-checkbox w-4 h-4 text-gray-900 border-gray-300 rounded focus:ring-gray-900">
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900"><?php echo e($asesor->name); ?></p>
                        <p class="text-xs text-gray-600"><?php echo e($asesor->email); ?></p>
                    </div>
                </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-200">
                <button type="button" onclick="closeAdvisorsModal()" class="px-6 py-2.5 text-gray-700 hover:bg-gray-100 rounded-xl transition-colors font-medium">
                    Cancelar
                </button>
                <button type="submit" class="px-6 py-2.5 bg-gray-900 hover:bg-gray-800 text-white rounded-xl transition-colors font-medium">
                    Guardar Asignación
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('createModal').classList.remove('hidden');
}

function closeCreateModal() {
    document.getElementById('createModal').classList.add('hidden');
}

function openEditModal(evento) {
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');
    form.action = `/admin/eventos/${evento.id}`;
    
    // Llenar el formulario con los datos del evento
    document.getElementById('edit_title').value = evento.title;
    document.getElementById('edit_description').value = evento.description;
    document.getElementById('edit_category').value = evento.category;
    document.getElementById('edit_location').value = evento.location || '';
    document.getElementById('edit_registration_start_date').value = evento.registration_start_date;
    document.getElementById('edit_registration_end_date').value = evento.registration_end_date;
    document.getElementById('edit_event_start_date').value = evento.event_start_date;
    document.getElementById('edit_event_end_date').value = evento.event_end_date;
    document.getElementById('edit_min_team_size').value = evento.min_team_size;
    document.getElementById('edit_max_team_size').value = evento.max_team_size;
    document.getElementById('edit_max_teams').value = evento.max_teams || '';
    document.getElementById('edit_is_online').checked = evento.is_online;
    
    modal.classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

function openJudgesModal(eventId, selectedJudges) {
    const modal = document.getElementById('judgesModal');
    const form = document.getElementById('judgesForm');
    form.action = `/admin/eventos/${eventId}/asignar-jueces`;
    
    // Marcar jueces previamente asignados
    document.querySelectorAll('.judge-checkbox').forEach(checkbox => {
        checkbox.checked = selectedJudges.includes(checkbox.value);
    });
    
    modal.classList.remove('hidden');
}

function closeJudgesModal() {
    document.getElementById('judgesModal').classList.add('hidden');
}

function openAdvisorsModal(eventId, selectedAdvisors) {
    const modal = document.getElementById('advisorsModal');
    const form = document.getElementById('advisorsForm');
    form.action = `/admin/eventos/${eventId}/asignar-asesores`;
    
    // Marcar asesores previamente asignados
    document.querySelectorAll('.advisor-checkbox').forEach(checkbox => {
        checkbox.checked = selectedAdvisors.includes(checkbox.value);
    });
    
    modal.classList.remove('hidden');
}

function closeAdvisorsModal() {
    document.getElementById('advisorsModal').classList.add('hidden');
}

function confirmDelete(eventId, eventName) {
    if (confirm(`¿Estás seguro de que deseas eliminar el evento "${eventName}"? Esta acción no se puede deshacer.`)) {
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

// Cerrar modales al hacer clic fuera
document.addEventListener('click', function(event) {
    const createModal = document.getElementById('createModal');
    const editModal = document.getElementById('editModal');
    const judgesModal = document.getElementById('judgesModal');
    const advisorsModal = document.getElementById('advisorsModal');
    
    if (event.target === createModal) {
        closeCreateModal();
    }
    if (event.target === editModal) {
        closeEditModal();
    }
    if (event.target === judgesModal) {
        closeJudgesModal();
    }
    if (event.target === advisorsModal) {
        closeAdvisorsModal();
    }
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\em556\Desktop\ProyectoPW\resources\views/admin/eventos.blade.php ENDPATH**/ ?>