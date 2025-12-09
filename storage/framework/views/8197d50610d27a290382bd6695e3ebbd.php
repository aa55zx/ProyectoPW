<?php $__env->startSection('title', 'Eventos - EventTec'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Eventos Disponibles</h1>
        <p class="text-gray-600 text-lg">Explora y participa en concursos académicos</p>
    </div>

    <!-- Tabs de navegación -->
    <div class="mb-8">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button onclick="cambiarTab('proximos')" id="tab-proximos" 
                    class="tab-button border-b-2 py-4 px-1 text-sm font-medium whitespace-nowrap border-gray-900 text-gray-900">
                    Próximos
                    <span class="ml-2 py-0.5 px-2.5 rounded-full text-xs font-medium bg-gray-900 text-white" id="count-proximos">
                        <?php echo e($eventosProximos->count()); ?>

                    </span>
                </button>
                
                <button onclick="cambiarTab('activos')" id="tab-activos"
                    class="tab-button border-b-2 py-4 px-1 text-sm font-medium whitespace-nowrap border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    Activos
                    <span class="ml-2 py-0.5 px-2.5 rounded-full text-xs font-medium bg-gray-200 text-gray-700" id="count-activos">
                        <?php echo e($eventosActivos->count()); ?>

                    </span>
                </button>
                
                <button onclick="cambiarTab('terminados')" id="tab-terminados"
                    class="tab-button border-b-2 py-4 px-1 text-sm font-medium whitespace-nowrap border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    Terminados
                    <span class="ml-2 py-0.5 px-2.5 rounded-full text-xs font-medium bg-gray-200 text-gray-700" id="count-terminados">
                        <?php echo e($eventosTerminados->count()); ?>

                    </span>
                </button>
            </nav>
        </div>
    </div>

    <!-- Barra de búsqueda y filtros -->
    <div class="flex flex-col md:flex-row gap-4 mb-8">
        <!-- Buscador -->
        <div class="flex-1 relative">
            <input type="text" 
                   id="searchInput"
                   placeholder="Buscar eventos..." 
                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>

        <!-- Selector de categoría -->
        <select id="categoryFilter" class="px-6 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 transition-all text-gray-700 font-medium">
            <option value="all">Todas las categorías</option>
            <option value="Tecnología">Tecnología</option>
            <option value="Ciencias">Ciencias</option>
            <option value="Negocios">Negocios</option>
            <option value="Robótica">Robótica</option>
        </select>
    </div>

    <!-- PRÓXIMOS -->
    <div id="content-proximos" class="tab-content">
        <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4 flex items-start gap-3">
            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <p class="text-sm font-medium text-blue-900">Eventos próximos</p>
                <p class="text-sm text-blue-700">Puedes inscribirte a estos eventos que aún no han iniciado</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="grid-proximos">
            <?php $__empty_1 = true; $__currentLoopData = $eventosProximos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php echo $__env->make('estudiante.partials.evento-card', ['evento' => $evento, 'tipo' => 'proximo'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full text-center py-20">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">No hay eventos próximos</h3>
                    <p class="text-gray-600">No se encontraron eventos próximos en este momento</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ACTIVOS -->
    <div id="content-activos" class="tab-content hidden">
        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4 flex items-start gap-3">
            <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <div>
                <p class="text-sm font-medium text-green-900">Eventos en curso</p>
                <p class="text-sm text-green-700">Estos eventos ya iniciaron y están activos actualmente</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="grid-activos">
            <?php $__empty_1 = true; $__currentLoopData = $eventosActivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php echo $__env->make('estudiante.partials.evento-card', ['evento' => $evento, 'tipo' => 'activo'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full text-center py-20">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">No hay eventos activos</h3>
                    <p class="text-gray-600">No hay eventos en curso en este momento</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- TERMINADOS -->
    <div id="content-terminados" class="tab-content hidden">
        <div class="mb-6 bg-gray-50 border border-gray-200 rounded-lg p-4 flex items-start gap-3">
            <svg class="w-5 h-5 text-gray-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <p class="text-sm font-medium text-gray-900">Eventos finalizados</p>
                <p class="text-sm text-gray-700">Estos eventos ya concluyeron, puedes ver los resultados</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="grid-terminados">
            <?php $__empty_1 = true; $__currentLoopData = $eventosTerminados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php echo $__env->make('estudiante.partials.evento-card', ['evento' => $evento, 'tipo' => 'terminado'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full text-center py-20">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">No hay eventos terminados</h3>
                    <p class="text-gray-600">No se encontraron eventos finalizados</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
let tabActual = 'proximos';

function cambiarTab(tab) {
    // Ocultar todos los contenidos
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Mostrar el contenido seleccionado
    document.getElementById('content-' + tab).classList.remove('hidden');
    
    // Actualizar estilos de los botones
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('border-gray-900', 'text-gray-900');
        button.classList.add('border-transparent', 'text-gray-500');
        
        // Actualizar badge
        const badge = button.querySelector('span');
        badge.classList.remove('bg-gray-900', 'text-white');
        badge.classList.add('bg-gray-200', 'text-gray-700');
    });
    
    // Activar el botón seleccionado
    const activeButton = document.getElementById('tab-' + tab);
    activeButton.classList.remove('border-transparent', 'text-gray-500');
    activeButton.classList.add('border-gray-900', 'text-gray-900');
    
    // Actualizar badge activo
    const activeBadge = activeButton.querySelector('span');
    activeBadge.classList.remove('bg-gray-200', 'text-gray-700');
    activeBadge.classList.add('bg-gray-900', 'text-white');
    
    tabActual = tab;
    
    // Aplicar filtros al nuevo tab
    filtrarEventos();
}

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    
    let currentCategory = 'all';
    let currentSearch = '';
    
    function filtrarEventos() {
        const grid = document.getElementById('grid-' + tabActual);
        const allCards = grid.querySelectorAll('.evento-card');
        let visibleCount = 0;
        
        allCards.forEach(card => {
            const cardCategory = card.dataset.category;
            const cardText = card.textContent.toLowerCase();
            
            const matchCategory = currentCategory === 'all' || cardCategory === currentCategory;
            const matchSearch = currentSearch === '' || cardText.includes(currentSearch);
            
            if (matchCategory && matchSearch) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Actualizar contador del tab actual
        const countBadge = document.getElementById('count-' + tabActual);
        countBadge.textContent = visibleCount;
    }
    
    searchInput.addEventListener('input', function() {
        currentSearch = this.value.toLowerCase();
        filtrarEventos();
    });
    
    categoryFilter.addEventListener('change', function() {
        currentCategory = this.value;
        filtrarEventos();
    });
    
    // Exponer la función globalmente
    window.filtrarEventos = filtrarEventos;
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.estudiante', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Cheluis\Documentos\7Semestre\Programacion web\ProyectoPW\resources\views/estudiante/eventos.blade.php ENDPATH**/ ?>