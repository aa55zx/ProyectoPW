<?php $__env->startSection('title', 'Mis Equipos - EventTec'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- BANNER DE SOLICITUDES PENDIENTES - Diseño Minimalista -->
    <?php if($totalSolicitudes > 0): ?>
    <div class="mb-8 bg-white rounded-xl shadow-sm border-2 border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
        <div class="p-6">
            <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-4 flex-1">
                    <!-- SVG Icono -->
                    <div class="flex-shrink-0">
                        <svg class="w-12 h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </div>
                    
                    <!-- Texto -->
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-gray-900 mb-1">
                            <?php echo e($totalSolicitudes); ?> <?php echo e($totalSolicitudes == 1 ? 'solicitud pendiente' : 'solicitudes pendientes'); ?>

                        </h3>
                        <p class="text-sm text-gray-600">
                            <?php echo e($totalSolicitudes == 1 ? 'Una persona quiere' : 'Varias personas quieren'); ?> unirse a <?php echo e($totalSolicitudes == 1 ? 'un equipo' : 'tus equipos'); ?>

                        </p>
                    </div>
                </div>
                
                <!-- Botón Ver Solicitudes -->
                <button onclick="document.getElementById('modal-solicitudes').classList.remove('hidden')" 
                        class="px-5 py-2.5 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors font-medium text-sm flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Ver solicitudes
                </button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Equipos</h1>
            <p class="text-gray-600 text-lg">Gestiona tus equipos y colaboradores</p>
        </div>
        <button id="btn-crear-equipo" class="px-6 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors font-medium flex items-center gap-2 shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Crear Equipo
        </button>
    </div>

    <!-- Filtros -->
    <div class="mb-6 flex gap-3">
        <button onclick="filtrarEquipos('all')" id="filter-all" class="px-4 py-2 bg-gray-900 text-white rounded-lg font-medium text-sm transition-colors">
            Todos
        </button>
        <button onclick="filtrarEquipos('leader')" id="filter-leader" class="px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg font-medium text-sm hover:bg-gray-50 transition-colors">
            Mis equipos (líder)
        </button>
    </div>

    <!-- Lista de equipos -->
    <?php if($equipos->count() > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="equipos-grid">
            <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all border border-gray-200 overflow-hidden group">
                    <div class="p-6">
                        <!-- Badge de solicitudes pendientes - Minimalista -->
                        <?php if($equipo->solicitudes_count > 0): ?>
                        <div class="mb-4 -mt-2 -mx-2">
                            <div class="bg-gray-900 text-white px-4 py-2.5 text-sm font-medium flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                                </svg>
                                <?php echo e($equipo->solicitudes_count); ?> solicitud<?php echo e($equipo->solicitudes_count > 1 ? 'es' : ''); ?> pendiente<?php echo e($equipo->solicitudes_count > 1 ? 's' : ''); ?>

                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-3">
                                    <!-- SVG Avatar del equipo -->
                                    <div class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0 border border-gray-200">
                                        <svg class="w-7 h-7 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-bold text-gray-900 mb-1 truncate"><?php echo e($equipo->name); ?></h3>
                                        <?php if($equipo->leader_id === auth()->id()): ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 bg-gray-100 text-gray-700 text-xs font-medium rounded border border-gray-200">
                                                Líder
                                            </span>
                                        <?php else: ?>
                                            <span class="text-sm text-gray-500">Miembro</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <?php if($equipo->description): ?>
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2"><?php echo e($equipo->description); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Información con iconos SVG minimalistas -->
                        <div class="space-y-2.5 text-sm text-gray-600 mb-5 pb-5 border-b border-gray-100">
                            <div class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <span class="text-gray-700"><?php echo e($equipo->members_count); ?> <?php echo e($equipo->members_count == 1 ? 'miembro' : 'miembros'); ?></span>
                            </div>
                            
                            <div class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-gray-700"><?php echo e($equipo->eventos_count); ?> <?php echo e($equipo->eventos_count == 1 ? 'evento' : 'eventos'); ?></span>
                            </div>

                            <div class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-gray-700 truncate">Líder: <?php echo e($equipo->leader->name); ?></span>
                            </div>
                        </div>

                        <a href="<?php echo e(route('estudiante.equipos.show', $equipo->id)); ?>" 
                           class="block w-full py-2.5 px-4 bg-gray-900 text-white text-center rounded-lg hover:bg-gray-800 transition-colors font-medium text-sm group-hover:shadow-sm">
                            Ver detalles
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <!-- Estado vacío con SVG -->
        <div class="text-center py-20">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">No tienes equipos</h3>
            <p class="text-gray-600 mb-6">Crea tu primer equipo para participar en eventos</p>
            <button onclick="document.getElementById('btn-crear-equipo').click()" 
                    class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors font-medium shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Crear equipo
            </button>
        </div>
    <?php endif; ?>
</div>

<!-- Modal Solicitudes Pendientes - Diseño Minimalista -->
<div id="modal-solicitudes" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-xl max-w-4xl w-full max-h-[90vh] overflow-hidden flex flex-col shadow-2xl">
        <!-- Header del modal -->
        <div class="p-6 border-b border-gray-200 flex items-center justify-between bg-white">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-gray-100 rounded-lg">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Solicitudes Pendientes</h3>
                    <p class="text-sm text-gray-600">Gestiona las solicitudes de unión a tus equipos</p>
                </div>
            </div>
            <button onclick="document.getElementById('modal-solicitudes').classList.add('hidden')" 
                    class="text-gray-400 hover:text-gray-600 transition-colors p-2 hover:bg-gray-100 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Contenido scrolleable -->
        <div class="flex-1 overflow-y-auto p-6 bg-gray-50">
            <?php if($solicitudesPendientes->count() > 0): ?>
                <div class="space-y-4">
                    <?php $__currentLoopData = $solicitudesPendientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $solicitud): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white rounded-lg p-6 border border-gray-200 hover:border-gray-300 transition-all shadow-sm" id="solicitud-modal-<?php echo e($solicitud->id); ?>">
                            <div class="flex items-start gap-4">
                                <!-- Avatar SVG -->
                                <div class="w-14 h-14 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0 border-2 border-gray-200">
                                    <svg class="w-7 h-7 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                
                                <div class="flex-1 min-w-0">
                                    <div class="mb-3">
                                        <h4 class="font-bold text-lg text-gray-900 mb-1"><?php echo e($solicitud->user_name); ?></h4>
                                        <div class="flex items-center gap-2 mb-2">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            <span class="text-sm font-medium text-gray-900">Equipo: <?php echo e($solicitud->team_name); ?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-2 text-sm text-gray-600 mb-4">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            <span><?php echo e($solicitud->email); ?></span>
                                        </div>
                                        <?php if($solicitud->career): ?>
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                </svg>
                                                <span><?php echo e($solicitud->career); ?><?php echo e($solicitud->semester ? ' • Semestre ' . $solicitud->semester : ''); ?></span>
                                            </div>
                                        <?php endif; ?>>
                                        <div class="flex items-center gap-2 text-gray-500">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="text-xs">Hace <?php echo e(\Carbon\Carbon::parse($solicitud->created_at)->diffForHumans()); ?></span>
                                        </div>
                                    </div>

                                    <div class="flex gap-3">
                                        <button onclick="aceptarSolicitudRapida('<?php echo e($solicitud->id); ?>', '<?php echo e($solicitud->user_name); ?>')"
                                                class="flex-1 px-4 py-2.5 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors font-medium flex items-center justify-center gap-2 text-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Aceptar
                                        </button>
                                        <button onclick="rechazarSolicitudRapida('<?php echo e($solicitud->id); ?>', '<?php echo e($solicitud->user_name); ?>')"
                                                class="flex-1 px-4 py-2.5 bg-white border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium flex items-center justify-center gap-2 text-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Rechazar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <!-- Estado vacío con SVG -->
                <div class="text-center py-16">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Todo al día</h3>
                    <p class="text-gray-600">No tienes solicitudes pendientes</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal Crear Equipo -->
<div id="modal-crear-equipo" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-xl max-w-md w-full p-8 relative shadow-2xl">
        <button id="btn-cerrar-modal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 p-2 hover:bg-gray-100 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <div class="mb-6">
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Crear Nuevo Equipo</h3>
            <p class="text-gray-600">Forma tu equipo para participar en eventos</p>
        </div>

        <form id="form-crear-equipo" class="space-y-5">
            <?php echo csrf_field(); ?>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del equipo *</label>
                <input type="text" 
                       name="team_name" 
                       required
                       placeholder="Ej: Tech Innovators"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Descripción (opcional)</label>
                <textarea name="description" 
                          rows="3"
                          placeholder="Describe tu equipo..."
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent resize-none"></textarea>
            </div>

            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                <p class="text-sm text-gray-700">
                    <strong>💡 Nota:</strong> Tu equipo podrá participar en múltiples eventos. Después de crearlo, podrás inscribirlo a los eventos que desees.
                </p>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="button" 
                        id="btn-cancelar"
                        class="flex-1 py-3 px-4 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                    Cancelar
                </button>
                <button type="submit" 
                        class="flex-1 py-3 px-4 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors font-medium">
                    Crear equipo
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modal-crear-equipo');
    const btnCrear = document.getElementById('btn-crear-equipo');
    const btnCerrar = document.getElementById('btn-cerrar-modal');
    const btnCancelar = document.getElementById('btn-cancelar');
    const form = document.getElementById('form-crear-equipo');
    
    if (btnCrear) {
        btnCrear.addEventListener('click', () => modal.classList.remove('hidden'));
    }
    
    function cerrarModal() {
        modal.classList.add('hidden');
        form.reset();
    }
    
    if (btnCerrar) btnCerrar.addEventListener('click', cerrarModal);
    if (btnCancelar) btnCancelar.addEventListener('click', cerrarModal);
    
    modal.addEventListener('click', (e) => {
        if (e.target === modal) cerrarModal();
    });
    
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const btn = form.querySelector('button[type="submit"]');
        
        btn.disabled = true;
        btn.textContent = 'Creando...';
        
        try {
            const response = await fetch('<?php echo e(route("estudiante.equipos.store")); ?>', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Accept': 'application/json',
                },
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                alert('✓ ' + data.message);
                window.location.reload();
            } else {
                alert('✗ ' + data.message);
                btn.disabled = false;
                btn.textContent = 'Crear equipo';
            }
        } catch (error) {
            alert('✗ Error al crear el equipo');
            btn.disabled = false;
            btn.textContent = 'Crear equipo';
        }
    });
});

function filtrarEquipos(tipo) {
    const filterAll = document.getElementById('filter-all');
    const filterLeader = document.getElementById('filter-leader');
    
    if (tipo === 'all') {
        filterAll.className = 'px-4 py-2 bg-gray-900 text-white rounded-lg font-medium text-sm transition-colors';
        filterLeader.className = 'px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg font-medium text-sm hover:bg-gray-50 transition-colors';
        window.location.href = '<?php echo e(route("estudiante.equipos")); ?>';
    } else {
        filterAll.className = 'px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg font-medium text-sm hover:bg-gray-50 transition-colors';
        filterLeader.className = 'px-4 py-2 bg-gray-900 text-white rounded-lg font-medium text-sm transition-colors';
        window.location.href = '<?php echo e(route("estudiante.equipos")); ?>?role=leader';
    }
}

async function aceptarSolicitudRapida(requestId, userName) {
    if (!confirm(`¿Aceptar la solicitud de ${userName}?`)) {
        return;
    }

    try {
        const response = await fetch('<?php echo e(route("estudiante.equipos.aceptar-solicitud")); ?>', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ request_id: requestId })
        });

        const data = await response.json();

        if (data.success) {
            alert('✓ ' + data.message);
            window.location.reload();
        } else {
            alert('✗ ' + data.message);
        }
    } catch (error) {
        alert('✗ Error al aceptar la solicitud');
    }
}

async function rechazarSolicitudRapida(requestId, userName) {
    if (!confirm(`¿Rechazar la solicitud de ${userName}?`)) {
        return;
    }

    try {
        const response = await fetch('<?php echo e(route("estudiante.equipos.rechazar-solicitud")); ?>', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ request_id: requestId })
        });

        const data = await response.json();

        if (data.success) {
            alert('✓ ' + data.message);
            window.location.reload();
        } else {
            alert('✗ ' + data.message);
        }
    } catch (error) {
        alert('✗ Error al rechazar la solicitud');
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.estudiante', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\em556\Desktop\ProyectoPW\resources\views/estudiante/equipos.blade.php ENDPATH**/ ?>