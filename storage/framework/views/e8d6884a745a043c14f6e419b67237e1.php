<?php $__env->startSection('title', 'Eventos - EventTec'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Eventos Disponibles</h1>
        <p class="text-gray-600 text-lg">Explora y participa en concursos académicos próximos</p>
    </div>

    <!-- Info sobre filtrado automático -->
    <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4 flex items-start gap-3">
        <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <div>
            <p class="text-sm font-medium text-blue-900">Solo se muestran eventos próximos</p>
            <p class="text-sm text-blue-700">Puedes inscribirte únicamente a eventos que aún no han iniciado</p>
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

    <!-- Contador de eventos -->
    <div class="mb-6">
        <p class="text-sm text-gray-600">
            <span class="font-semibold text-gray-900" id="event-count"><?php echo e($eventos->count()); ?></span> 
            <?php echo e($eventos->count() == 1 ? 'evento disponible' : 'eventos disponibles'); ?>

        </p>
    </div>

    <!-- Grid de eventos -->
    <div id="eventos-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $eventos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="evento-card bg-white rounded-lg shadow-sm hover:shadow-md transition-all overflow-hidden border border-gray-200" 
                 data-category="<?php echo e($evento->category); ?>">
                
                <!-- Imagen del evento -->
                <div class="relative h-48">
                    <?php if($evento->cover_image_url): ?>
                        <img src="<?php echo e($evento->cover_image_url); ?>" alt="<?php echo e($evento->title); ?>" class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Badge de categoría -->
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 bg-white text-gray-900 text-xs font-medium rounded border border-gray-200 shadow-sm">
                            <?php echo e($evento->category); ?>

                        </span>
                    </div>

                    <!-- Badge de próximamente -->
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-gray-900 text-white text-xs font-medium rounded shadow-sm">
                            Próximamente
                        </span>
                    </div>
                </div>
                
                <!-- Contenido -->
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2"><?php echo e($evento->title); ?></h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2"><?php echo e($evento->short_description ?? Str::limit($evento->description, 100)); ?></p>
                    
                    <!-- Info del evento -->
                    <div class="space-y-2.5 mb-5 text-sm text-gray-600">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-gray-700"><?php echo e(\Carbon\Carbon::parse($evento->event_start_date)->format('d M Y')); ?></span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span class="text-gray-700"><?php echo e($evento->registered_teams_count ?? 0); ?> equipos inscritos</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span class="text-gray-700"><?php echo e($evento->min_team_size); ?>-<?php echo e($evento->max_team_size); ?> integrantes</span>
                        </div>
                    </div>
                    
                    <!-- Botón -->
                    <a href="<?php echo e(route('estudiante.evento-detalle', $evento->id)); ?>" 
                       class="block w-full py-2.5 px-4 bg-gray-900 text-white text-center rounded-lg hover:bg-gray-800 transition-colors font-medium text-sm">
                        Ver detalles
                    </a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full text-center py-20">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">No hay eventos disponibles</h3>
                <p class="text-gray-600">No se encontraron eventos próximos en este momento</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const allCards = document.querySelectorAll('.evento-card');
    const eventCount = document.getElementById('event-count');
    
    let currentCategory = 'all';
    let currentSearch = '';
    
    function filtrarEventos() {
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

        // Actualizar contador
        eventCount.textContent = visibleCount;
        const countText = visibleCount == 1 ? 'evento disponible' : 'eventos disponibles';
        eventCount.parentElement.innerHTML = `<span class="font-semibold text-gray-900" id="event-count">${visibleCount}</span> ${countText}`;
    }
    
    searchInput.addEventListener('input', function() {
        currentSearch = this.value.toLowerCase();
        filtrarEventos();
    });
    
    categoryFilter.addEventListener('change', function() {
        currentCategory = this.value;
        filtrarEventos();
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.estudiante', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\em556\Desktop\ProyectoPW\resources\views/estudiante/eventos.blade.php ENDPATH**/ ?>