<?php $__env->startSection('title', $proyecto->title . ' - EventTec'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="<?php echo e(route('estudiante.dashboard')); ?>" class="text-gray-700 hover:text-blue-600">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="<?php echo e(route('estudiante.proyectos')); ?>" class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2">Proyectos</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-gray-500 md:ml-2"><?php echo e($proyecto->title); ?></span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Columna Principal -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Info del Proyecto -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <div class="flex items-start justify-between mb-6">
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-gray-900 mb-2"><?php echo e($proyecto->title); ?></h1>
                        <p class="text-gray-600"><?php echo e($proyecto->event->title); ?></p>
                    </div>
                    <?php if($esLider): ?>
                    <button onclick="mostrarModalEditar()" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold">
                        Editar Proyecto
                    </button>
                    <?php endif; ?>
                </div>

                <div class="prose max-w-none">
                    <p class="text-gray-700 leading-relaxed"><?php echo e($proyecto->description); ?></p>
                </div>

                <?php if($proyecto->repository_url || $proyecto->demo_url): ?>
                <div class="flex gap-4 mt-6 pt-6 border-t border-gray-200">
                    <?php if($proyecto->repository_url): ?>
                    <a href="<?php echo e($proyecto->repository_url); ?>" target="_blank" 
                       class="flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        Repositorio
                    </a>
                    <?php endif; ?>
                    <?php if($proyecto->demo_url): ?>
                    <a href="<?php echo e($proyecto->demo_url); ?>" target="_blank" 
                       class="flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        Demo
                    </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Estado del Proyecto -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">📦 Estado del Proyecto</h2>
                
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex-1">
                        <?php
                        $statusInfo = [
                            'draft' => ['text' => 'Borrador', 'color' => 'gray', 'icon' => '📝'],
                            'in_progress' => ['text' => 'En Progreso', 'color' => 'blue', 'icon' => '⚙️'],
                            'submitted' => ['text' => 'Entregado', 'color' => 'green', 'icon' => '✅'],
                            'evaluated' => ['text' => 'Evaluado', 'color' => 'purple', 'icon' => '⭐'],
                        ];
                        $status = $statusInfo[$proyecto->status] ?? $statusInfo['draft'];
                        ?>
                        
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-<?php echo e($status['color']); ?>-100 text-<?php echo e($status['color']); ?>-800 rounded-lg font-semibold">
                            <span><?php echo e($status['icon']); ?></span>
                            <span><?php echo e($status['text']); ?></span>
                        </span>
                    </div>
                </div>

                <?php if($proyecto->submission_file_path): ?>
                    <!-- Archivo entregado -->
                    <div class="bg-green-50 border border-green-200 rounded-xl p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-green-900"><?php echo e($proyecto->submission_file_name); ?></p>
                                    <p class="text-sm text-green-700">Entregado el <?php echo e($proyecto->submitted_at->format('d/m/Y H:i')); ?></p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <a href="<?php echo e(route('estudiante.proyectos.download-submission', $proyecto->id)); ?>" 
                                   class="px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm font-semibold">
                                    Descargar
                                </a>
                                <?php if($esLider && $proyecto->status !== 'evaluated'): ?>
                                <button onclick="eliminarEntrega()" 
                                        class="px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm font-semibold">
                                    Eliminar
                                </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Sin archivo -->
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <p class="text-gray-600 mb-4">Sin archivo de entrega</p>
                        <?php if($esLider): ?>
                            <button onclick="mostrarModalEntrega()" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold">
                                Entregar archivo
                            </button>
                        <?php else: ?>
                            <p class="text-sm text-gray-500">Solo el líder puede entregar el archivo</p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Columna Lateral -->
        <div class="space-y-8">
            <!-- Asesor del Proyecto -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">👨‍🏫 Asesor del Proyecto</h2>

                <?php if($proyecto->advisor): ?>
                    <!-- Asesor asignado -->
                    <div class="bg-green-50 border border-green-200 rounded-xl p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                                    <?php echo e(strtoupper(substr($proyecto->advisor->name, 0, 2))); ?>

                                </div>
                                <div>
                                    <p class="font-bold text-green-900 text-lg"><?php echo e($proyecto->advisor->name); ?></p>
                                    <p class="text-sm text-green-700"><?php echo e($proyecto->advisor->email); ?></p>
                                    <span class="inline-block mt-2 px-3 py-1 bg-green-600 text-white text-xs font-semibold rounded-full">
                                        Asesor asignado
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php elseif(isset($solicitudAsesor)): ?>
                    <!-- Estado de solicitud -->
                    <?php if($solicitudAsesor->status === 'pending'): ?>
                        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="flex items-center gap-3 mb-2">
                                <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-semibold text-yellow-900">Solicitud Pendiente</span>
                            </div>
                            <p class="text-sm text-yellow-700 mb-3">
                                Esperando respuesta del asesor...
                            </p>
                            <?php if($esLider): ?>
                                <button onclick="cancelarSolicitud()" 
                                        class="text-sm text-yellow-700 hover:text-yellow-900 font-medium underline">
                                    Cancelar solicitud
                                </button>
                            <?php endif; ?>
                        </div>
                    <?php elseif($solicitudAsesor->status === 'rejected'): ?>
                        <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                            <div class="flex items-center gap-3 mb-2">
                                <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-semibold text-red-900">Solicitud Rechazada</span>
                            </div>
                            <p class="text-sm text-red-700 mb-3">
                                <?php echo e($solicitudAsesor->response_message ?? 'El asesor rechazó tu solicitud'); ?>

                            </p>
                            <?php if($esLider): ?>
                                <button onclick="mostrarModalAsesor()" 
                                        class="text-sm text-red-700 hover:text-red-900 font-medium underline">
                                    Solicitar otro asesor
                                </button>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <!-- Sin asesor -->
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <p class="text-gray-600 mb-4">No hay asesor asignado</p>
                        <?php if($esLider): ?>
                            <button onclick="mostrarModalAsesor()" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold">
                                Solicitar asesor
                            </button>
                        <?php else: ?>
                            <p class="text-sm text-gray-500">Solo el líder puede solicitar un asesor</p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Equipo del Proyecto -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">👥 Equipo del Proyecto</h2>
                <div class="space-y-3">
                    <?php $__currentLoopData = $proyecto->team->members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $miembro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center gap-4 p-4 rounded-xl <?php echo e($miembro->id === $proyecto->team->leader_id ? 'bg-yellow-50 border border-yellow-200' : 'bg-gray-50'); ?>">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                                <?php echo e(strtoupper(substr($miembro->name, 0, 2))); ?>

                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900"><?php echo e($miembro->name); ?></p>
                                <p class="text-sm text-gray-600"><?php echo e($miembro->email); ?></p>
                            </div>
                            <?php if($miembro->id === $proyecto->team->leader_id): ?>
                                <span class="px-2 py-1 bg-yellow-600 text-white text-xs font-semibold rounded-full">
                                    Líder
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Entregar Archivo -->
<div id="modal-entregar-archivo" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-8 relative">
        <button onclick="cerrarModalEntrega()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <h3 class="text-2xl font-bold text-gray-900 mb-2">Entregar Proyecto</h3>
        <p class="text-gray-600 mb-6">Sube el archivo final de tu proyecto</p>

        <form id="form-entregar-archivo" class="space-y-4">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Archivo *
                </label>
                <input type="file" name="submission_file" required accept=".pdf,.zip,.rar,.docx,.pptx"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-xs text-gray-500 mt-1">Formatos: PDF, ZIP, RAR, DOCX, PPTX (Max: 50MB)</p>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="button" onclick="cerrarModalEntrega()" 
                        class="flex-1 py-3 px-4 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                    Cancelar
                </button>
                <button type="submit" class="flex-1 py-3 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    Entregar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Editar Proyecto -->
<div id="modal-editar-proyecto" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full p-8 relative max-h-[90vh] overflow-y-auto">
        <button onclick="cerrarModalEditar()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <h3 class="text-2xl font-bold text-gray-900 mb-6">Editar Proyecto</h3>

        <form id="form-editar-proyecto" class="space-y-4">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Título *</label>
                <input type="text" name="title" value="<?php echo e($proyecto->title); ?>" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Descripción *</label>
                <textarea name="description" rows="5" required
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"><?php echo e($proyecto->description); ?></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">URL del Repositorio</label>
                <input type="url" name="repository_url" value="<?php echo e($proyecto->repository_url); ?>"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">URL de la Demo</label>
                <input type="url" name="demo_url" value="<?php echo e($proyecto->demo_url); ?>"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex gap-3 pt-4">
                <button type="button" onclick="cerrarModalEditar()" 
                        class="flex-1 py-3 px-4 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                    Cancelar
                </button>
                <button type="submit" class="flex-1 py-3 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Solicitar Asesor -->
<div id="modal-seleccionar-asesor" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto relative">
        <button onclick="cerrarModalAsesor()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <div class="p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Solicitar Asesor</h3>
            <p class="text-gray-600 mb-6">Elige un asesor y envía tu solicitud</p>

            <form id="form-solicitar-asesor" class="space-y-6">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="project_id" value="<?php echo e($proyecto->id); ?>">
                
                <!-- Lista de asesores -->
                <div class="space-y-3">
                    <?php $__empty_1 = true; $__currentLoopData = $asesoresDisponibles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asesor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <label class="flex items-center gap-4 p-4 border border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all asesor-option">
                            <input type="radio" name="advisor_id" value="<?php echo e($asesor->id); ?>" 
                                   class="w-5 h-5 text-blue-600" required>
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-700 font-bold text-lg flex-shrink-0">
                                <?php echo e(strtoupper(substr($asesor->name, 0, 2))); ?>

                            </div>
                            <div class="flex-1">
                                <div class="font-semibold text-gray-900"><?php echo e($asesor->name); ?></div>
                                <div class="text-sm text-gray-600"><?php echo e($asesor->email); ?></div>
                            </div>
                            <svg class="w-5 h-5 text-blue-600 hidden check-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="text-center py-8 text-gray-500">
                            No hay asesores disponibles en este momento
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Mensaje opcional -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Mensaje para el asesor (opcional)
                    </label>
                    <textarea name="mensaje" rows="3" 
                              placeholder="Cuéntale al asesor sobre tu proyecto..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
                </div>

                <!-- Botones -->
                <div class="flex gap-3">
                    <button type="button" 
                            onclick="cerrarModalAsesor()"
                            class="flex-1 py-3 px-4 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                        Cancelar
                    </button>
                    <button type="submit" class="flex-1 py-3 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                        Enviar Solicitud
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Modal Entregar Archivo
function mostrarModalEntrega() {
    document.getElementById('modal-entregar-archivo').classList.remove('hidden');
}

function cerrarModalEntrega() {
    document.getElementById('modal-entregar-archivo').classList.add('hidden');
    document.getElementById('form-entregar-archivo').reset();
}

document.getElementById('form-entregar-archivo').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const btn = this.querySelector('button[type="submit"]');
    const btnText = btn.innerHTML;
    
    btn.disabled = true;
    btn.innerHTML = 'Subiendo...';
    
    try {
        const response = await fetch('<?php echo e(route("estudiante.proyectos.submit-file", $proyecto->id)); ?>', {
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
            btn.innerHTML = btnText;
        }
    } catch (error) {
        alert('✗ Error al entregar el archivo');
        btn.disabled = false;
        btn.innerHTML = btnText;
    }
});

// Eliminar Entrega
async function eliminarEntrega() {
    if (!confirm('¿Estás seguro de que deseas eliminar la entrega? Esta acción no se puede deshacer.')) {
        return;
    }
    
    try {
        const response = await fetch('<?php echo e(route("estudiante.proyectos.delete-submission", $proyecto->id)); ?>', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Accept': 'application/json',
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert('✓ ' + data.message);
            window.location.reload();
        } else {
            alert('✗ ' + data.message);
        }
    } catch (error) {
        alert('✗ Error al eliminar la entrega');
    }
}

// Modal Editar Proyecto
function mostrarModalEditar() {
    document.getElementById('modal-editar-proyecto').classList.remove('hidden');
}

function cerrarModalEditar() {
    document.getElementById('modal-editar-proyecto').classList.add('hidden');
}

document.getElementById('form-editar-proyecto').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const btn = this.querySelector('button[type="submit"]');
    const btnText = btn.innerHTML;
    
    btn.disabled = true;
    btn.innerHTML = 'Guardando...';
    
    try {
        const response = await fetch('<?php echo e(route("estudiante.proyectos.update", $proyecto->id)); ?>', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Accept': 'application/json',
                'X-HTTP-Method-Override': 'PUT'
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
            btn.innerHTML = btnText;
        }
    } catch (error) {
        alert('✗ Error al actualizar el proyecto');
        btn.disabled = false;
        btn.innerHTML = btnText;
    }
});

// Modal Asesor
function mostrarModalAsesor() {
    document.getElementById('modal-seleccionar-asesor').classList.remove('hidden');
}

function cerrarModalAsesor() {
    document.getElementById('modal-seleccionar-asesor').classList.add('hidden');
}

// Manejar selección visual de asesor
document.querySelectorAll('.asesor-option').forEach(option => {
    const radio = option.querySelector('input[type="radio"]');
    const checkIcon = option.querySelector('.check-icon');
    
    radio.addEventListener('change', function() {
        document.querySelectorAll('.asesor-option').forEach(opt => {
            opt.classList.remove('border-blue-500', 'bg-blue-50');
            opt.querySelector('.check-icon').classList.add('hidden');
        });
        if (this.checked) {
            option.classList.add('border-blue-500', 'bg-blue-50');
            checkIcon.classList.remove('hidden');
        }
    });
});

// Enviar solicitud de asesor
document.getElementById('form-solicitar-asesor').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const btn = this.querySelector('button[type="submit"]');
    btn.disabled = true;
    btn.textContent = 'Enviando...';
    
    try {
        const response = await fetch('<?php echo e(route("estudiante.proyectos.solicitar-asesor", $proyecto->id)); ?>', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Accept': 'application/json'
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
            btn.textContent = 'Enviar Solicitud';
        }
    } catch (error) {
        alert('✗ Error al enviar solicitud');
        btn.disabled = false;
        btn.textContent = 'Enviar Solicitud';
    }
});

// Cancelar solicitud
async function cancelarSolicitud() {
    if (!confirm('¿Cancelar la solicitud de asesoría?')) return;
    
    try {
        const response = await fetch('<?php echo e(route("estudiante.proyectos.cancelar-solicitud-asesor", $proyecto->id)); ?>', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Accept': 'application/json'
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert('✓ ' + data.message);
            window.location.reload();
        } else {
            alert('✗ ' + data.message);
        }
    } catch (error) {
        alert('✗ Error al cancelar solicitud');
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.estudiante', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Cheluis\Documentos\7Semestre\Programacion web\ProyectoPW\resources\views/estudiante/proyecto-detalle.blade.php ENDPATH**/ ?>