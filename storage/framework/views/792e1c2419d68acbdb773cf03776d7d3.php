<?php $__env->startSection('title', $equipo->name . ' - EventTec'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Botón de regresar -->
    <button onclick="window.history.back()" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 mb-6 font-medium transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        <span>Volver</span>
    </button>

    <!-- Header del Equipo -->
    <div class="relative rounded-3xl overflow-hidden mb-8 shadow-xl">
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-blue-900 to-gray-900"></div>
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&q=80'); background-size: cover; background-position: center;"></div>
        </div>
        
        <div class="relative p-8">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-3">
                        <h1 class="text-4xl font-bold text-white"><?php echo e($equipo->name); ?></h1>
                        <?php if($equipo->leader_id === auth()->id()): ?>
                            <span class="px-4 py-1.5 bg-yellow-400 text-yellow-900 text-sm font-bold rounded-full">Líder</span>
                        <?php endif; ?>
                    </div>
                    <p class="text-white/90 text-lg mb-4"><?php echo e($equipo->description ?? 'Sin descripción'); ?></p>
                </div>
                <div class="flex-shrink-0">
                    <div class="text-center bg-white/10 rounded-2xl p-4 backdrop-blur-sm border border-white/20">
                        <div class="text-5xl font-bold text-white"><?php echo e($equipo->members_count); ?></div>
                        <div class="text-sm text-white/80 mt-1">Miembros</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Información del Equipo -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Solicitudes Pendientes (Solo para Líder) -->
            <?php if($equipo->leader_id === auth()->id() && count($solicitudesPendientes) > 0): ?>
            <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-8 shadow-sm border-2 border-blue-200">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-3 bg-blue-500 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">📬 Solicitudes Pendientes</h2>
                        <p class="text-sm text-gray-600"><?php echo e(count($solicitudesPendientes)); ?> <?php echo e(count($solicitudesPendientes) == 1 ? 'persona quiere' : 'personas quieren'); ?> unirse a tu equipo</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <?php $__currentLoopData = $solicitudesPendientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $solicitud): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200" id="solicitud-<?php echo e($solicitud->id); ?>">
                            <div class="flex items-start gap-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                                    <?php echo e(strtoupper(substr($solicitud->name, 0, 2))); ?>

                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-lg text-gray-900 mb-1"><?php echo e($solicitud->name); ?></h3>
                                    <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-3">
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            <span><?php echo e($solicitud->email); ?></span>
                                        </div>
                                        <?php if($solicitud->career): ?>
                                            <div class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                                </svg>
                                                <span><?php echo e($solicitud->career); ?></span>
                                                <?php if($solicitud->semester): ?>
                                                    <span class="text-gray-400">• Sem. <?php echo e($solicitud->semester); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        Solicitó unirse hace <?php echo e(\Carbon\Carbon::parse($solicitud->created_at)->diffForHumans()); ?>

                                    </div>
                                    <?php if($solicitud->message): ?>
                                        <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                                            <p class="text-sm text-gray-700 italic">"<?php echo e($solicitud->message); ?>"</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex flex-col gap-2 flex-shrink-0">
                                    <button onclick="aceptarSolicitud('<?php echo e($solicitud->id); ?>', '<?php echo e($solicitud->name); ?>')"
                                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm font-semibold whitespace-nowrap">
                                        ✓ Aceptar
                                    </button>
                                    <button onclick="rechazarSolicitud('<?php echo e($solicitud->id); ?>', '<?php echo e($solicitud->name); ?>')"
                                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm font-semibold whitespace-nowrap">
                                        ✗ Rechazar
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Miembros del Equipo -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">👥 Miembros del Equipo</h2>
                </div>

                <div class="space-y-4">
                    <?php $__currentLoopData = $equipo->members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center gap-4 p-4 rounded-xl border border-gray-200 hover:border-gray-300 transition-colors">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold text-xl">
                                    <?php echo e(strtoupper(substr($member->name, 0, 2))); ?>

                                </div>
                            </div>

                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <h3 class="font-bold text-gray-900 text-lg"><?php echo e($member->name); ?></h3>
                                    <?php if($member->id === $equipo->leader_id): ?>
                                        <span class="px-2 py-0.5 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Líder</span>
                                    <?php endif; ?>
                                </div>
                                <div class="flex flex-wrap gap-3 text-sm text-gray-600">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span><?php echo e($member->email); ?></span>
                                    </div>
                                    <?php if($member->career): ?>
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                            </svg>
                                            <span><?php echo e($member->career); ?></span>
                                            <?php if($member->semester): ?>
                                                <span class="text-gray-400">• Sem. <?php echo e($member->semester); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if($member->pivot && $member->pivot->joined_at): ?>
                                    <div class="text-xs text-gray-500 mt-2">
                                        Se unió el <?php echo e(\Carbon\Carbon::parse($member->pivot->joined_at)->format('d/m/Y')); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- Eventos Participados -->
            <?php if(count($eventosParticipados) > 0): ?>
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <div class="flex items-center gap-3 mb-6">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-900">🎯 Eventos Participados</h2>
                </div>

                <div class="space-y-4">
                    <?php $__currentLoopData = $eventosParticipados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="p-5 rounded-xl border-2 border-gray-200 hover:border-blue-300 transition-all bg-gradient-to-r from-gray-50 to-blue-50">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1">
                                    <h3 class="font-bold text-lg text-gray-900 mb-1"><?php echo e($evento->title); ?></h3>
                                    <p class="text-sm text-gray-600 mb-2 line-clamp-2"><?php echo e($evento->description); ?></p>
                                </div>
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full ml-3">
                                    <?php echo e(ucfirst($evento->category)); ?>

                                </span>
                            </div>
                            
                            <div class="flex items-center gap-4 text-sm text-gray-600 mb-3">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span><?php echo e(\Carbon\Carbon::parse($evento->event_start_date)->format('d M Y')); ?></span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span><?php echo e($evento->location ?? 'Online'); ?></span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                                <span class="text-xs text-gray-500">
                                    Inscrito el <?php echo e(\Carbon\Carbon::parse($evento->registered_at)->format('d/m/Y')); ?>

                                </span>
                                <a href="<?php echo e(route('estudiante.evento-detalle', $evento->id)); ?>" 
                                   class="text-sm font-semibold text-blue-600 hover:text-blue-700 flex items-center gap-1">
                                    Ver evento
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php else: ?>
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Sin eventos aún</h3>
                    <p class="text-gray-600 mb-4">Este equipo no ha participado en ningún evento</p>
                    <a href="<?php echo e(route('estudiante.eventos')); ?>" 
                       class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors font-semibold text-sm">
                        Explorar eventos
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 sticky top-8">
                <h3 class="font-bold text-lg text-gray-900 mb-4">Información del Equipo</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-600 mb-1">Líder</p>
                        <p class="font-semibold text-gray-900"><?php echo e($equipo->leader->name); ?></p>
                    </div>
                    <div>
                        <p class="text-gray-600 mb-1">Miembros</p>
                        <p class="font-semibold text-gray-900"><?php echo e($equipo->members_count); ?> <?php echo e($equipo->members_count == 1 ? 'miembro' : 'miembros'); ?></p>
                    </div>
                    <div>
                        <p class="text-gray-600 mb-1">Eventos participados</p>
                        <p class="font-semibold text-gray-900"><?php echo e(count($eventosParticipados)); ?> <?php echo e(count($eventosParticipados) == 1 ? 'evento' : 'eventos'); ?></p>
                    </div>
                    <div>
                        <p class="text-gray-600 mb-1">Creado el</p>
                        <p class="font-semibold text-gray-900"><?php echo e(\Carbon\Carbon::parse($equipo->created_at)->format('d M Y')); ?></p>
                    </div>
                    <div>
                        <p class="text-gray-600 mb-1">Estado del equipo</p>
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                            <span class="w-2 h-2 bg-green-600 rounded-full"></span>
                            <?php echo e(ucfirst($equipo->status)); ?>

                        </span>
                    </div>
                </div>

                <?php if($equipo->leader_id !== auth()->id()): ?>
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <button onclick="confirmarSalirEquipo()" 
                                class="block w-full py-3 px-4 border border-red-300 text-red-600 text-center rounded-lg hover:bg-red-50 transition-colors font-medium">
                            Abandonar equipo
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
async function aceptarSolicitud(requestId, userName) {
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

async function rechazarSolicitud(requestId, userName) {
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

function confirmarSalirEquipo() {
    if (confirm('¿Estás seguro de que quieres abandonar este equipo?')) {
        fetch('<?php echo e(route("estudiante.equipos.leave", $equipo->id)); ?>', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('✓ Has abandonado el equipo');
                window.location.href = '<?php echo e(route("estudiante.equipos")); ?>';
            } else {
                alert('✗ ' + data.message);
            }
        })
        .catch(() => alert('✗ Error al salir del equipo'));
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.estudiante', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\em556\Desktop\ProyectoPW\resources\views/estudiante/equipo-detalle.blade.php ENDPATH**/ ?>