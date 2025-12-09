<?php $__env->startSection('title', 'Equipos'); ?>
<?php $__env->startSection('breadcrumb', 'Equipos'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Encabezado -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-900">Gestión de Equipos</h1>
            <p class="text-gray-600 mt-2 text-lg">Administra y supervisa todos los equipos registrados</p>
        </div>
    </div>

    <!-- Estadísticas Rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-sm p-6 text-white">
            <p class="text-sm opacity-90 mb-2">Total Equipos</p>
            <p class="text-4xl font-bold"><?php echo e($equipos->total()); ?></p>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-sm p-6 text-white">
            <p class="text-sm opacity-90 mb-2">Equipos Activos</p>
            <p class="text-4xl font-bold"><?php echo e($equipos->where('status', 'active')->count()); ?></p>
        </div>
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-sm p-6 text-white">
            <p class="text-sm opacity-90 mb-2">Con Proyectos</p>
            <p class="text-4xl font-bold"><?php echo e($equipos->whereNotNull('project')->count()); ?></p>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl shadow-sm p-6 text-white">
            <p class="text-sm opacity-90 mb-2">Promedio Miembros</p>
            <p class="text-4xl font-bold"><?php echo e(number_format($equipos->avg('members_count'), 1)); ?></p>
        </div>
    </div>

    <!-- Filtros -->
    <form method="GET" action="<?php echo e(route('admin.equipos')); ?>" class="bg-white rounded-2xl shadow-sm p-6 mb-8 border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Buscar</label>
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Nombre del equipo..." class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Evento</label>
                <select name="event_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
                    <option value="">Todos los eventos</option>
                    <?php $__currentLoopData = $eventos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($evento->id); ?>" <?php echo e(request('event_id') == $evento->id ? 'selected' : ''); ?>>
                        <?php echo e($evento->title); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                <select name="status" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
                    <option value="">Todos</option>
                    <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>Activos</option>
                    <option value="inactive" <?php echo e(request('status') == 'inactive' ? 'selected' : ''); ?>>Inactivos</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2.5 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition-colors text-sm font-medium">
                    Filtrar
                </button>
            </div>
        </div>
    </form>

    <!-- Lista de Equipos en Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="p-6">
                <!-- Encabezado del Equipo -->
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-900 mb-1"><?php echo e($equipo->name); ?></h3>
                        <span class="px-2 py-1 bg-<?php echo e($equipo->status === 'active' ? 'green' : 'gray'); ?>-100 text-<?php echo e($equipo->status === 'active' ? 'green' : 'gray'); ?>-700 text-xs font-medium rounded-full">
                            <?php echo e($equipo->status === 'active' ? 'Activo' : 'Inactivo'); ?>

                        </span>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold flex-shrink-0">
                        <?php echo e(substr($equipo->name, 0, 2)); ?>

                    </div>
                </div>

                <!-- Descripción -->
                <?php if($equipo->description): ?>
                <p class="text-sm text-gray-600 mb-4"><?php echo e(Str::limit($equipo->description, 80)); ?></p>
                <?php endif; ?>

                <!-- Información del Evento -->
                <div class="mb-4 pb-4 border-b border-gray-100">
                    <p class="text-xs text-gray-500 mb-1">Evento</p>
                    <p class="text-sm font-medium text-gray-900"><?php echo e($equipo->event->title ?? 'Sin evento'); ?></p>
                </div>

                <!-- Estadísticas -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Líder</p>
                        <p class="text-sm font-medium text-gray-900"><?php echo e($equipo->leader->name ?? 'Sin líder'); ?></p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Miembros</p>
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-900"><?php echo e($equipo->members_count); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Proyecto -->
                <?php if($equipo->project): ?>
                <div class="bg-blue-50 rounded-lg p-3 mb-4">
                    <p class="text-xs text-blue-600 mb-1 font-medium">Proyecto</p>
                    <p class="text-sm font-semibold text-blue-900"><?php echo e($equipo->project->title); ?></p>
                    <span class="inline-block mt-1 px-2 py-0.5 bg-blue-100 text-blue-700 text-xs rounded-full">
                        <?php echo e(ucfirst($equipo->project->status)); ?>

                    </span>
                </div>
                <?php else: ?>
                <div class="bg-gray-50 rounded-lg p-3 mb-4">
                    <p class="text-xs text-gray-500 text-center">Sin proyecto asignado</p>
                </div>
                <?php endif; ?>

                <!-- Botones de Acción -->
                <div class="flex items-center gap-2">
                    <button onclick="viewTeamDetails('<?php echo e($equipo->id); ?>')" class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                        Ver Detalles
                    </button>
                    <button onclick="confirmDeleteTeam('<?php echo e($equipo->id); ?>', '<?php echo e($equipo->name); ?>')" class="px-4 py-2 text-sm font-medium text-red-700 hover:bg-red-50 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-span-full bg-white rounded-2xl shadow-sm p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No hay equipos</h3>
            <p class="text-gray-600">No se encontraron equipos con los filtros aplicados</p>
        </div>
        <?php endif; ?>
    </div>

    <!-- Paginación -->
    <?php if($equipos->hasPages()): ?>
    <div class="mt-8">
        <?php echo e($equipos->links()); ?>

    </div>
    <?php endif; ?>
</div>

<!-- Modal Ver Detalles del Equipo -->
<div id="teamDetailsModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-900">Detalles del Equipo</h2>
                <button onclick="closeTeamDetailsModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <div id="teamDetailsContent" class="p-6">
            <!-- Contenido dinámico -->
        </div>
    </div>
</div>

<script>
function viewTeamDetails(teamId) {
    // En una implementación real, harías una llamada AJAX para obtener los detalles
    const equipo = <?php echo json_encode($equipos, 15, 512) ?>;
    const team = equipo.data.find(t => t.id === teamId);
    
    if (team) {
        const content = `
            <div class="space-y-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">${team.name}</h3>
                    <p class="text-gray-600">${team.description || 'Sin descripción'}</p>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-sm text-gray-500 mb-1">Evento</p>
                        <p class="font-semibold text-gray-900">${team.event?.title || 'Sin evento'}</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-sm text-gray-500 mb-1">Estado</p>
                        <span class="inline-block px-3 py-1 bg-${team.status === 'active' ? 'green' : 'gray'}-100 text-${team.status === 'active' ? 'green' : 'gray'}-700 text-sm font-medium rounded-full">
                            ${team.status === 'active' ? 'Activo' : 'Inactivo'}
                        </span>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-semibold text-gray-900 mb-3">Líder del Equipo</h4>
                    <div class="bg-blue-50 rounded-xl p-4">
                        <p class="font-medium text-blue-900">${team.leader?.name || 'Sin líder'}</p>
                        <p class="text-sm text-blue-700">${team.leader?.email || ''}</p>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-semibold text-gray-900 mb-3">Miembros (${team.members_count})</h4>
                    <div class="space-y-2">
                        ${team.members?.map(member => `
                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                                <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white font-medium">
                                    ${member.name.charAt(0)}
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">${member.name}</p>
                                    <p class="text-sm text-gray-600">${member.email}</p>
                                </div>
                            </div>
                        `).join('') || '<p class="text-gray-500 text-center py-4">No hay miembros</p>'}
                    </div>
                </div>
                
                ${team.project ? `
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-3">Proyecto</h4>
                        <div class="bg-green-50 rounded-xl p-4">
                            <p class="font-medium text-green-900">${team.project.title}</p>
                            <p class="text-sm text-green-700 mt-1">${team.project.description || ''}</p>
                            <span class="inline-block mt-2 px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                                ${team.project.status}
                            </span>
                        </div>
                    </div>
                ` : '<p class="text-gray-500 text-center py-4 bg-gray-50 rounded-xl">Sin proyecto asignado</p>'}
            </div>
        `;
        
        document.getElementById('teamDetailsContent').innerHTML = content;
        document.getElementById('teamDetailsModal').classList.remove('hidden');
    }
}

function closeTeamDetailsModal() {
    document.getElementById('teamDetailsModal').classList.add('hidden');
}

function confirmDeleteTeam(teamId, teamName) {
    if (confirm(`¿Estás seguro de que deseas eliminar el equipo "${teamName}"? Esta acción no se puede deshacer y eliminará todos los miembros asociados.`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/equipos/${teamId}`;
        
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

// Cerrar modal al hacer clic fuera
document.addEventListener('click', function(event) {
    const modal = document.getElementById('teamDetailsModal');
    if (event.target === modal) {
        closeTeamDetailsModal();
    }
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Cheluis\Documentos\7Semestre\Programacion web\ProyectoPW\resources\views/admin/equipos.blade.php ENDPATH**/ ?>