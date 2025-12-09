<?php $__env->startSection('title', $evento->title . ' - EventTec'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Botón de regresar -->
    <button onclick="window.history.back()" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 mb-6 font-medium transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        <span>Volver a eventos</span>
    </button>

    <!-- Hero del evento -->
    <div class="relative h-96 rounded-3xl overflow-hidden mb-8 shadow-xl">
        <?php if($evento->cover_image_url): ?>
            <img src="<?php echo e($evento->cover_image_url); ?>" alt="<?php echo e($evento->title); ?>" class="w-full h-full object-cover">
        <?php else: ?>
            <div class="w-full h-full bg-gradient-to-r from-blue-500 to-purple-600"></div>
        <?php endif; ?>
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 right-0 p-8">
            <div class="flex gap-3 mb-4">
                <?php if($evento->status === 'open'): ?>
                    <span class="px-4 py-1.5 bg-green-500 text-white text-sm font-bold rounded-full">En curso</span>
                <?php elseif($evento->status === 'finished'): ?>
                    <span class="px-4 py-1.5 bg-gray-500 text-white text-sm font-bold rounded-full">Finalizado</span>
                <?php else: ?>
                    <span class="px-4 py-1.5 bg-blue-500 text-white text-sm font-bold rounded-full">Próximamente</span>
                <?php endif; ?>
                <span class="px-4 py-1.5 bg-white/90 text-gray-800 text-sm font-bold rounded-full"><?php echo e($evento->category); ?></span>
            </div>
            <h1 class="text-5xl font-bold text-white mb-3"><?php echo e($evento->title); ?></h1>
            <p class="text-xl text-white/90 max-w-3xl"><?php echo e($evento->short_description ?? $evento->description); ?></p>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Información Principal -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Descripción -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">📝 Descripción</h2>
                <p class="text-gray-700 leading-relaxed"><?php echo e($evento->description); ?></p>
            </div>

            <!-- Requisitos -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <span>📋</span> Requisitos
                </h2>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Equipo de <?php echo e($evento->min_team_size); ?>-<?php echo e($evento->max_team_size); ?> integrantes</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Estudiantes activos del TecNM</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Laptop personal</span>
                    </li>
                </ul>
            </div>

            <!-- Equipos Inscritos -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                        <span>👥</span> Equipos Inscritos
                    </h2>
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                        <?php echo e($equiposInscritos->count()); ?> equipos
                    </span>
                </div>

                <?php if($equiposInscritos->count() > 0): ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $equiposInscritos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="border border-gray-200 rounded-xl p-6 hover:border-blue-300 hover:shadow-sm transition-all">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-2">
                                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                                <?php echo e(strtoupper(substr($equipo->name, 0, 2))); ?>

                                            </div>
                                            <div>
                                                <h3 class="text-lg font-bold text-gray-900"><?php echo e($equipo->name); ?></h3>
                                                <p class="text-sm text-gray-600">Líder: <?php echo e($equipo->leader->name); ?></p>
                                            </div>
                                        </div>
                                        
                                        <?php if($equipo->description): ?>
                                            <p class="text-gray-600 text-sm mb-3 line-clamp-2"><?php echo e($equipo->description); ?></p>
                                        <?php endif; ?>
                                        
                                        <div class="flex items-center gap-4 text-sm text-gray-500">
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                </svg>
                                                <?php echo e($equipo->members_count); ?>/<?php echo e($evento->max_team_size); ?> miembros
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="ml-4">
                                        <?php if($miEquipo && $miEquipo->id === $equipo->id): ?>
                                            <!-- Es mi equipo -->
                                            <span class="px-4 py-2 bg-green-100 text-green-800 rounded-lg text-sm font-semibold">
                                                Tu equipo
                                            </span>
                                        <?php elseif($miEquipo): ?>
                                            <!-- Ya tiene otro equipo -->
                                            <span class="px-4 py-2 bg-gray-100 text-gray-500 rounded-lg text-sm">
                                                -
                                            </span>
                                        <?php elseif(in_array($equipo->id, $solicitudesPendientes)): ?>
                                            <!-- Solicitud enviada -->
                                            <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg text-sm font-semibold">
                                                Solicitud enviada
                                            </span>
                                        <?php elseif($equipo->members_count >= $evento->max_team_size): ?>
                                            <!-- Equipo lleno -->
                                            <span class="px-4 py-2 bg-gray-100 text-gray-500 rounded-lg text-sm">
                                                Equipo lleno
                                            </span>
                                        <?php else: ?>
                                            <!-- Puede solicitar unirse -->
                                            <button onclick="solicitarUnirse('<?php echo e($equipo->id); ?>', '<?php echo e($equipo->name); ?>')"
                                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold">
                                                Solicitar unirme
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <p class="text-gray-600 font-medium">No hay equipos inscritos aún</p>
                        <p class="text-sm text-gray-500 mt-1">Sé el primero en inscribir tu equipo</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Cronograma -->
            <?php if($evento->schedule && $evento->schedule->count() > 0): ?>
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <span>📅</span> Cronograma
                </h2>
                <div class="space-y-4">
                    <?php $__currentLoopData = $evento->schedule->groupBy('day'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day => $activities): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <h3 class="font-bold text-lg text-gray-900 mb-3">Día <?php echo e($day); ?></h3>
                            <div class="space-y-3">
                                <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0">
                                        <span class="text-sm font-medium text-blue-600"><?php echo e($activity->start_time); ?></span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-900"><?php echo e($activity->title); ?></p>
                                        <p class="text-sm text-gray-600"><?php echo e($activity->description); ?></p>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 sticky top-8 space-y-6">
                <!-- Estadísticas -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-blue-50 rounded-xl">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Equipos inscritos</p>
                            <p class="text-2xl font-bold text-gray-900"><?php echo e($equiposInscritos->count()); ?></p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-green-50 rounded-xl">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Tamaño de equipo</p>
                            <p class="text-2xl font-bold text-gray-900"><?php echo e($evento->min_team_size); ?>-<?php echo e($evento->max_team_size); ?></p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-purple-50 rounded-xl">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Fecha del evento</p>
                            <p class="text-lg font-bold text-gray-900"><?php echo e(\Carbon\Carbon::parse($evento->event_start_date)->format('d M Y')); ?></p>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <?php if($miEquipo): ?>
                        <!-- Ya tiene equipo inscrito -->
                        <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-4">
                            <p class="text-sm font-semibold text-green-800 mb-1">✓ Ya estás inscrito</p>
                            <p class="text-xs text-green-700">Equipo: <?php echo e($miEquipo->name); ?></p>
                        </div>
                        <a href="<?php echo e(route('estudiante.equipos.show', $miEquipo->id)); ?>" 
                           class="block w-full py-3 px-4 bg-gray-900 text-white text-center rounded-xl hover:bg-gray-800 transition-colors font-semibold">
                            Ver mi equipo
                        </a>
                    <?php elseif($misEquipos->count() > 0): ?>
                        <!-- Tiene equipos sin inscribir - Botón inscribir equipo existente -->
                        <button onclick="mostrarModalInscripcion()" 
                                class="w-full mb-3 py-3 px-4 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors font-semibold flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Inscribir mi equipo
                        </button>
                        <button onclick="mostrarModalCrearEquipo()" 
                                class="w-full py-3 px-4 border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors font-semibold">
                            Crear nuevo equipo
                        </button>
                    <?php else: ?>
                        <!-- No tiene equipos - Solo crear nuevo -->
                        <button onclick="mostrarModalCrearEquipo()" 
                                class="w-full py-3 px-4 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors font-semibold flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Crear equipo
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Inscribir Equipo Existente -->
<div id="modal-inscribir-equipo" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-8 relative max-h-[90vh] overflow-y-auto">
        <button onclick="cerrarModalInscripcion()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <h3 class="text-2xl font-bold text-gray-900 mb-2">Inscribir equipo</h3>
        <p class="text-gray-600 mb-6">Selecciona tu equipo para <?php echo e($evento->title); ?></p>

        <form id="form-inscribir-equipo" class="space-y-4">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="event_id" value="<?php echo e($evento->id); ?>">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Selecciona tu equipo *</label>
                <select name="team_id" id="select-team-inscripcion" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Selecciona un equipo</option>
                    <?php $__currentLoopData = $misEquipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($equipo->id); ?>"><?php echo e($equipo->name); ?> (<?php echo e($equipo->members_count); ?> miembros)</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del proyecto *</label>
                <input type="text" 
                       name="project_title" 
                       required
                       placeholder="Ej: Sistema de Gestión IoT"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Descripción del proyecto *</label>
                <textarea name="project_description" 
                          required
                          rows="4"
                          placeholder="Describe tu proyecto para el evento..."
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                <p class="text-sm text-blue-800">
                    <strong>💡 Nota:</strong> Al inscribir tu equipo, se creará automáticamente un proyecto para este evento.
                </p>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="button" 
                        onclick="cerrarModalInscripcion()"
                        class="flex-1 py-3 px-4 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors font-semibold">
                    Cancelar
                </button>
                <button type="submit" 
                        class="flex-1 py-3 px-4 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors font-semibold">
                    Inscribir equipo
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Crear Nuevo Equipo -->
<div id="modal-crear-equipo" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-8 relative">
        <button onclick="cerrarModalCrearEquipo()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <h3 class="text-2xl font-bold text-gray-900 mb-2">Crear nuevo equipo</h3>
        <p class="text-gray-600 mb-6">Crea tu equipo y luego podrás inscribirlo</p>

        <form id="form-crear-equipo" class="space-y-4">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="event_id" value="<?php echo e($evento->id); ?>">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del equipo *</label>
                <input type="text" 
                       name="team_name" 
                       required
                       placeholder="Ej: Tech Innovators"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Descripción (opcional)</label>
                <textarea name="team_description" 
                          rows="3"
                          placeholder="Describe tu equipo..."
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                <p class="text-sm text-yellow-800">
                    <strong>⚠️ Nota:</strong> Después de crear el equipo, deberás inscribirlo al evento con un proyecto.
                </p>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="button" 
                        onclick="cerrarModalCrearEquipo()"
                        class="flex-1 py-3 px-4 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors font-semibold">
                    Cancelar
                </button>
                <button type="submit" 
                        class="flex-1 py-3 px-4 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors font-semibold">
                    Crear equipo
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Modal Inscribir Equipo
function mostrarModalInscripcion() {
    document.getElementById('modal-inscribir-equipo').classList.remove('hidden');
}

function cerrarModalInscripcion() {
    document.getElementById('modal-inscribir-equipo').classList.add('hidden');
    document.getElementById('form-inscribir-equipo').reset();
}

document.getElementById('form-inscribir-equipo').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const btn = this.querySelector('button[type="submit"]');
    const btnText = btn.innerHTML;
    
    btn.disabled = true;
    btn.innerHTML = 'Inscribiendo...';
    
    try {
        const response = await fetch('<?php echo e(route("estudiante.eventos.inscribir-equipo")); ?>', {
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
        alert('✗ Error al inscribir el equipo');
        btn.disabled = false;
        btn.innerHTML = btnText;
    }
});

// Modal Crear Equipo
function mostrarModalCrearEquipo() {
    document.getElementById('modal-crear-equipo').classList.remove('hidden');
}

function cerrarModalCrearEquipo() {
    document.getElementById('modal-crear-equipo').classList.add('hidden');
    document.getElementById('form-crear-equipo').reset();
}

document.getElementById('form-crear-equipo').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const btn = this.querySelector('button[type="submit"]');
    const btnText = btn.innerHTML;
    
    btn.disabled = true;
    btn.innerHTML = 'Creando...';
    
    try {
        const response = await fetch('<?php echo e(route("estudiante.registrar-equipo")); ?>', {
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
            cerrarModalCrearEquipo();
            // Actualizar para mostrar el modal de inscripción con el nuevo equipo
            window.location.reload();
        } else {
            alert('✗ ' + data.message);
            btn.disabled = false;
            btn.innerHTML = btnText;
        }
    } catch (error) {
        alert('✗ Error al crear el equipo');
        btn.disabled = false;
        btn.innerHTML = btnText;
    }
});

// Solicitar unirse a equipo
async function solicitarUnirse(teamId, teamName) {
    if (!confirm(`¿Deseas enviar una solicitud para unirte al equipo "${teamName}"?`)) {
        return;
    }
    
    try {
        const response = await fetch('<?php echo e(route("estudiante.eventos.solicitar-unirse")); ?>', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ team_id: teamId })
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert('✓ ' + data.message);
            window.location.reload();
        } else {
            alert('✗ ' + data.message);
        }
    } catch (error) {
        alert('✗ Error al enviar la solicitud');
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.estudiante', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\em556\Desktop\ProyectoPW\resources\views/estudiante/evento-detalle.blade.php ENDPATH**/ ?>