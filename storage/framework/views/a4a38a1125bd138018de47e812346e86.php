<?php $__env->startSection('title', $proyecto->title . ' - EventTec'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Botón de regresar -->
    <button onclick="window.history.back()" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 mb-6 font-medium transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        <span>Volver a proyectos</span>
    </button>

    <!-- Header del proyecto -->
    <div class="bg-gradient-to-r from-purple-600 to-blue-600 rounded-3xl p-8 mb-8 shadow-xl text-white">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <h1 class="text-4xl font-bold mb-3"><?php echo e($proyecto->title); ?></h1>
                
                <!-- Estados -->
                <div class="flex items-center gap-3 mb-4">
                    <?php if($proyecto->status === 'draft'): ?>
                        <span class="px-4 py-1.5 bg-white/20 backdrop-blur-sm text-white text-sm font-bold rounded-full">
                            📝 Borrador
                        </span>
                    <?php elseif($proyecto->status === 'in_progress'): ?>
                        <span class="px-4 py-1.5 bg-white/20 backdrop-blur-sm text-white text-sm font-bold rounded-full">
                            🔨 En progreso
                        </span>
                    <?php elseif($proyecto->status === 'submitted'): ?>
                        <span class="px-4 py-1.5 bg-green-500 text-white text-sm font-bold rounded-full">
                            ✓ Entregado
                        </span>
                    <?php elseif($proyecto->status === 'evaluated'): ?>
                        <span class="px-4 py-1.5 bg-yellow-400 text-gray-900 text-sm font-bold rounded-full">
                            ⭐ Evaluado
                        </span>
                    <?php endif; ?>
                </div>
                
                <p class="text-white/90 text-lg max-w-3xl"><?php echo e($proyecto->description); ?></p>
                
                <?php if($proyecto->final_score): ?>
                <div class="mt-4">
                    <p class="text-white/80 text-sm mb-1">Puntuación Final</p>
                    <div class="flex items-center gap-2">
                        <span class="text-5xl font-bold"><?php echo e($proyecto->final_score); ?></span>
                        <span class="text-xl text-white/80">/ 100</span>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Columna Principal -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Información del Proyecto -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">📋 Información del Proyecto</h2>
                    <?php if($esLider && $proyecto->status !== 'evaluated'): ?>
                        <button onclick="mostrarModalEditar()" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold">
                            Editar
                        </button>
                    <?php endif; ?>
                </div>

                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-700 mb-1">Descripción</p>
                        <p class="text-gray-600"><?php echo e($proyecto->description); ?></p>
                    </div>

                    <?php if($proyecto->repository_url): ?>
                    <div>
                        <p class="text-sm font-semibold text-gray-700 mb-1">Repositorio</p>
                        <a href="<?php echo e($proyecto->repository_url); ?>" target="_blank" 
                           class="text-blue-600 hover:text-blue-700 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            Ver repositorio
                        </a>
                    </div>
                    <?php endif; ?>

                    <?php if($proyecto->demo_url): ?>
                    <div>
                        <p class="text-sm font-semibold text-gray-700 mb-1">Demo</p>
                        <a href="<?php echo e($proyecto->demo_url); ?>" target="_blank" 
                           class="text-blue-600 hover:text-blue-700 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            Ver demo
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Entrega del Proyecto -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">📤 Entrega del Proyecto</h2>

                <?php if($proyecto->status === 'evaluated'): ?>
                    <!-- Ya evaluado -->
                    <div class="bg-purple-50 border border-purple-200 rounded-xl p-6">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-purple-900">Proyecto evaluado</p>
                                <p class="text-sm text-purple-700">Este proyecto ya ha sido calificado</p>
                            </div>
                        </div>
                        <?php if($proyecto->submission_file_path): ?>
                        <a href="<?php echo e(route('estudiante.proyectos.download-submission', $proyecto->id)); ?>" 
                           class="inline-flex items-center gap-2 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors text-sm font-semibold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Descargar entrega
                        </a>
                        <?php endif; ?>
                    </div>

                <?php elseif($proyecto->submission_file_path): ?>
                    <!-- Archivo entregado -->
                    <div class="bg-green-50 border border-green-200 rounded-xl p-6">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-green-900">Archivo entregado</p>
                                <p class="text-sm text-green-700"><?php echo e($proyecto->submission_file_name); ?></p>
                                <p class="text-xs text-green-600 mt-1">Entregado el <?php echo e(\Carbon\Carbon::parse($proyecto->submitted_at)->format('d/m/Y H:i')); ?></p>
                            </div>
                        </div>
                        <div class="flex gap-3 mt-4">
                            <a href="<?php echo e(route('estudiante.proyectos.download-submission', $proyecto->id)); ?>" 
                               class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm font-semibold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Descargar
                            </a>
                            <?php if($esLider): ?>
                            <button onclick="eliminarEntrega()" 
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm font-semibold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Eliminar entrega
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php else: ?>
                    <!-- Sin entrega -->
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Sin archivo de entrega</h3>
                        <p class="text-gray-600 mb-6">Sube tu archivo final para que los jueces puedan evaluarlo</p>
                        
                        <?php if($esLider): ?>
                            <button onclick="mostrarModalEntrega()" 
                                    class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors font-semibold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                Entregar archivo
                            </button>
                        <?php else: ?>
                            <p class="text-sm text-gray-500">Solo el líder del equipo puede entregar el archivo</p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Asesor del Proyecto -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">👨‍🏫 Asesor del Proyecto</h2>

                <?php if($proyecto->advisor): ?>
                    <!-- Con asesor -->
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
                            <?php if($esLider): ?>
                            <button onclick="mostrarModalAsesor()" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold">
                                Cambiar
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>
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
                                Seleccionar asesor
                            </button>
                        <?php else: ?>
                            <p class="text-sm text-gray-500">Solo el líder puede asignar un asesor</p>
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
                                <span class="px-3 py-1 bg-yellow-500 text-white text-xs font-semibold rounded-full">
                                    Líder
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 sticky top-8 space-y-6">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Evento</p>
                    <p class="font-bold text-gray-900"><?php echo e($proyecto->event->title); ?></p>
                    <a href="<?php echo e(route('estudiante.evento-detalle', $proyecto->event->id)); ?>" 
                       class="text-sm text-blue-600 hover:text-blue-700 inline-flex items-center gap-1 mt-1">
                        Ver evento
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <p class="text-sm text-gray-600 mb-1">Equipo</p>
                    <p class="font-bold text-gray-900"><?php echo e($proyecto->team->name); ?></p>
                    <a href="<?php echo e(route('estudiante.equipos.show', $proyecto->team->id)); ?>" 
                       class="text-sm text-blue-600 hover:text-blue-700 inline-flex items-center gap-1 mt-1">
                        Ver equipo
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <p class="text-sm text-gray-600 mb-1">Estado</p>
                    <p class="font-bold text-gray-900">
                        <?php if($proyecto->status === 'draft'): ?> Borrador
                        <?php elseif($proyecto->status === 'in_progress'): ?> En progreso
                        <?php elseif($proyecto->status === 'submitted'): ?> Entregado
                        <?php else: ?> Evaluado
                        <?php endif; ?>
                    </p>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <p class="text-sm text-gray-600 mb-1">Creado</p>
                    <p class="font-bold text-gray-900"><?php echo e(\Carbon\Carbon::parse($proyecto->created_at)->format('d M Y')); ?></p>
                </div>

                <?php if($proyecto->final_score): ?>
                <div class="border-t border-gray-200 pt-6">
                    <p class="text-sm text-gray-600 mb-1">Calificación</p>
                    <div class="flex items-end gap-2">
                        <p class="text-4xl font-bold text-gray-900"><?php echo e($proyecto->final_score); ?></p>
                        <p class="text-gray-600 mb-1">/ 100</p>
                    </div>
                </div>
                <?php endif; ?>
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

        <form id="form-entregar-archivo" class="space-y-4" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Archivo del proyecto *</label>
                <input type="file" 
                       name="submission_file" 
                       id="file-input"
                       accept=".pdf,.zip,.rar,.docx,.pptx"
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-xs text-gray-500 mt-2">Formatos: PDF, ZIP, RAR, DOCX, PPTX (máx. 50MB)</p>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                <p class="text-sm text-yellow-800">
                    <strong>⚠️ Importante:</strong> Una vez entregado, el archivo quedará disponible para los jueces. Solo podrás eliminarlo antes de la evaluación.
                </p>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="button" 
                        onclick="cerrarModalEntrega()"
                        class="flex-1 py-3 px-4 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors font-semibold">
                    Cancelar
                </button>
                <button type="submit" 
                        class="flex-1 py-3 px-4 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors font-semibold">
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
            <?php echo method_field('PUT'); ?>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del proyecto *</label>
                <input type="text" 
                       name="title" 
                       value="<?php echo e($proyecto->title); ?>"
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Descripción *</label>
                <textarea name="description" 
                          required
                          rows="4"
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo e($proyecto->description); ?></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">URL del repositorio</label>
                <input type="url" 
                       name="repository_url"
                       value="<?php echo e($proyecto->repository_url); ?>"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">URL del demo</label>
                <input type="url" 
                       name="demo_url"
                       value="<?php echo e($proyecto->demo_url); ?>"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex gap-3 pt-4">
                <button type="button" 
                        onclick="cerrarModalEditar()"
                        class="flex-1 py-3 px-4 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors font-semibold">
                    Cancelar
                </button>
                <button type="submit" 
                        class="flex-1 py-3 px-4 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors font-semibold">
                    Guardar cambios
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Seleccionar Asesor -->
<div id="modal-seleccionar-asesor" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full p-8 relative max-h-[90vh] overflow-y-auto">
        <button onclick="cerrarModalAsesor()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <h3 class="text-2xl font-bold text-gray-900 mb-2">Seleccionar Asesor</h3>
        <p class="text-gray-600 mb-6">Elige un asesor disponible para tu proyecto</p>

        <?php if($asesoresDisponibles->count() > 0): ?>
            <div class="space-y-3">
                <?php $__currentLoopData = $asesoresDisponibles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asesor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button onclick="asignarAsesor('<?php echo e($asesor->id); ?>', '<?php echo e($asesor->name); ?>')"
                            class="w-full p-4 border-2 border-gray-200 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition-all text-left group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                <?php echo e(strtoupper(substr($asesor->name, 0, 2))); ?>

                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900 group-hover:text-blue-600"><?php echo e($asesor->name); ?></p>
                                <p class="text-sm text-gray-600"><?php echo e($asesor->email); ?></p>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="text-center py-8">
                <p class="text-gray-600">No hay asesores disponibles para este evento</p>
            </div>
        <?php endif; ?>
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

async function asignarAsesor(advisorId, advisorName) {
    if (!confirm(`¿Deseas asignar a ${advisorName} como asesor de este proyecto?`)) {
        return;
    }
    
    try {
        const response = await fetch('<?php echo e(route("estudiante.proyectos.assign-advisor", $proyecto->id)); ?>', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ advisor_id: advisorId })
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert('✓ ' + data.message);
            window.location.reload();
        } else {
            alert('✗ ' + data.message);
        }
    } catch (error) {
        alert('✗ Error al asignar el asesor');
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.estudiante', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\em556\Desktop\ProyectoPW\resources\views/estudiante/proyecto-detalle.blade.php ENDPATH**/ ?>