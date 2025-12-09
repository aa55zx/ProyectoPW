<?php $__env->startSection('title', 'Proyectos - Asesor'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-2" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1">
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm font-medium text-gray-800">Proyectos</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Proyectos</h1>
        <p class="text-gray-600 mt-1">Gestiona y supervisa los proyectos de tus equipos</p>
    </div>

    <!-- Tabs -->
    <div class="flex gap-4 mb-6 border-b border-gray-200">
        <button onclick="filtrarProyectos('todos')" id="tab-todos" class="px-4 py-3 font-semibold text-gray-900 border-b-2 border-gray-900 tab-button">
            Todos (<?php echo e($todosCount); ?>)
        </button>
        <button onclick="filtrarProyectos('en-progreso')" id="tab-en-progreso" class="px-4 py-3 font-medium text-gray-600 hover:text-gray-900 tab-button">
            En progreso (<?php echo e($enProgresoCount); ?>)
        </button>
        <button onclick="filtrarProyectos('entregados')" id="tab-entregados" class="px-4 py-3 font-medium text-gray-600 hover:text-gray-900 tab-button">
            Entregados (<?php echo e($entregadosCount); ?>)
        </button>
        <button onclick="filtrarProyectos('evaluados')" id="tab-evaluados" class="px-4 py-3 font-medium text-gray-600 hover:text-gray-900 tab-button">
            Evaluados (<?php echo e($evaluadosCount); ?>)
        </button>
    </div>

    <!-- Lista de Proyectos -->
    <?php if($proyectos->count() > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="proyectos-grid">
            <?php $__currentLoopData = $proyectos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proyecto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="proyecto-card bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all overflow-hidden" 
                 data-status="<?php echo e($proyecto->status); ?>">
                <!-- Header con color según estado -->
                <div class="p-6 pb-4">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="text-lg font-bold text-gray-900 line-clamp-2 flex-1"><?php echo e($proyecto->title); ?></h3>
                        <?php if($proyecto->status === 'draft' || $proyecto->status === 'in_progress'): ?>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full ml-2">En progreso</span>
                        <?php elseif($proyecto->status === 'submitted'): ?>
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full ml-2">Entregado</span>
                        <?php elseif($proyecto->status === 'evaluated'): ?>
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full ml-2">Evaluado</span>
                        <?php else: ?>
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full ml-2"><?php echo e(ucfirst($proyecto->status)); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        <?php echo e($proyecto->description ?? 'Sin descripción'); ?>

                    </p>
                    
                    <!-- Información del equipo y evento -->
                    <div class="space-y-2 text-sm text-gray-500 mb-4">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span><?php echo e($proyecto->team->name ?? 'Sin equipo'); ?></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span><?php echo e($proyecto->event->title ?? 'Sin evento'); ?></span>
                        </div>
                        <?php if($proyecto->final_score): ?>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                            <span>Puntuación: <?php echo e($proyecto->final_score); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Botones de acción -->
                    <div class="flex gap-2">
                        <?php if($proyecto->repository_url): ?>
                        <a href="<?php echo e($proyecto->repository_url); ?>" target="_blank" class="flex-1 px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors text-sm font-medium text-center">
                            Ver Repositorio
                        </a>
                        <?php endif; ?>
                        <?php if($proyecto->demo_url): ?>
                        <a href="<?php echo e($proyecto->demo_url); ?>" target="_blank" class="flex-1 px-4 py-2 border border-gray-900 text-gray-900 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium text-center">
                            Ver Demo
                        </a>
                        <?php endif; ?>
                        <?php if(!$proyecto->repository_url && !$proyecto->demo_url): ?>
                        <button disabled class="w-full px-4 py-2 bg-gray-200 text-gray-500 rounded-lg text-sm font-medium cursor-not-allowed">
                            Sin recursos
                        </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
    <!-- Estado vacío -->
    <div class="bg-white rounded-xl p-12 shadow-sm border border-gray-200 text-center">
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">No hay proyectos</h3>
        <p class="text-gray-600">Aún no hay proyectos registrados en tus equipos</p>
    </div>
    <?php endif; ?>
</div>

<script>
function filtrarProyectos(filtro) {
    // Remover clases activas de todos los tabs
    const tabs = document.querySelectorAll('.tab-button');
    tabs.forEach(tab => {
        tab.classList.remove('text-gray-900', 'border-gray-900', 'font-semibold');
        tab.classList.add('text-gray-600', 'font-medium');
        tab.classList.remove('border-b-2');
    });
    
    // Activar tab seleccionado
    const tabActivo = document.getElementById(`tab-${filtro}`);
    tabActivo.classList.add('text-gray-900', 'border-b-2', 'border-gray-900', 'font-semibold');
    tabActivo.classList.remove('text-gray-600', 'font-medium');
    
    // Filtrar proyectos
    const proyectos = document.querySelectorAll('.proyecto-card');
    
    proyectos.forEach(proyecto => {
        const status = proyecto.getAttribute('data-status');
        
        if (filtro === 'todos') {
            proyecto.style.display = 'block';
        } else if (filtro === 'en-progreso') {
            if (status === 'draft' || status === 'in_progress') {
                proyecto.style.display = 'block';
            } else {
                proyecto.style.display = 'none';
            }
        } else if (filtro === 'entregados') {
            if (status === 'submitted') {
                proyecto.style.display = 'block';
            } else {
                proyecto.style.display = 'none';
            }
        } else if (filtro === 'evaluados') {
            if (status === 'evaluated') {
                proyecto.style.display = 'block';
            } else {
                proyecto.style.display = 'none';
            }
        }
    });
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.asesor-dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\em556\Desktop\ProyectoPW\resources\views/asesor/proyectos.blade.php ENDPATH**/ ?>