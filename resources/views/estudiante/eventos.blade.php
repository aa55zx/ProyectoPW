@extends('layouts.estudiante')

@section('title', 'Eventos - EventTec')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Eventos</h1>
        <p class="text-gray-600 text-lg">Explora y participa en concursos académicos</p>
    </div>

    <!-- Barra de búsqueda y filtros -->
    <div class="flex flex-col md:flex-row gap-4 mb-6">
        <!-- Buscador -->
        <div class="flex-1 relative">
            <input type="text" 
                   id="searchInput"
                   placeholder="Buscar eventos..." 
                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-sm">
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>

        <!-- Selector de categoría -->
        <select id="categoryFilter" class="px-6 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-700 font-medium">
            <option value="all">Todas las categorías</option>
            <option value="Tecnología">Tecnología</option>
            <option value="Ciencias">Ciencias</option>
            <option value="Negocios">Negocios</option>
            <option value="Robótica">Robótica</option>
        </select>
    </div>

    <!-- Tabs de filtro por estado -->
    <div class="flex gap-4 mb-6 border-b border-gray-200">
        <button data-status="all" class="tab-button active px-4 py-2 font-medium text-gray-900 border-b-2 border-blue-600">
            Todos ({{ $eventos->count() }})
        </button>
        <button data-status="open" class="tab-button px-4 py-2 font-medium text-gray-600 hover:text-gray-900 border-b-2 border-transparent">
            Activos ({{ $eventos->where('status', 'open')->count() }})
        </button>
        <button data-status="upcoming" class="tab-button px-4 py-2 font-medium text-gray-600 hover:text-gray-900 border-b-2 border-transparent">
            Próximamente ({{ $eventos->where('status', 'upcoming')->count() }})
        </button>
        <button data-status="finished" class="tab-button px-4 py-2 font-medium text-gray-600 hover:text-gray-900 border-b-2 border-transparent">
            Finalizados ({{ $eventos->where('status', 'finished')->count() }})
        </button>
    </div>

    <!-- Grid de eventos -->
    <div id="eventos-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($eventos as $evento)
            <div class="evento-card bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow overflow-hidden" 
                 data-category="{{ $evento->category }}" 
                 data-status="{{ $evento->status }}">
                
                <!-- Imagen del evento -->
                <div class="relative h-48">
                    @if($evento->cover_image_url)
                        <img src="{{ $evento->cover_image_url }}" alt="{{ $evento->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white text-4xl">
                            📅
                        </div>
                    @endif
                    
                    <!-- Badges -->
                    <div class="absolute top-4 left-4 flex gap-2">
                        @if($evento->status === 'open')
                            <span class="px-3 py-1 bg-green-500 text-white text-xs font-semibold rounded-full">En curso</span>
                        @elseif($evento->status === 'finished')
                            <span class="px-3 py-1 bg-gray-500 text-white text-xs font-semibold rounded-full">Finalizado</span>
                        @else
                            <span class="px-3 py-1 bg-blue-500 text-white text-xs font-semibold rounded-full">Próximamente</span>
                        @endif
                        <span class="px-3 py-1 bg-white/90 text-gray-800 text-xs font-semibold rounded-full">{{ $evento->category }}</span>
                    </div>
                </div>
                
                <!-- Contenido -->
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $evento->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $evento->short_description ?? Str::limit($evento->description, 100) }}</p>
                    
                    <!-- Info del evento -->
                    <div class="space-y-2 mb-4 text-sm text-gray-600">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($evento->event_start_date)->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span>{{ $evento->registered_teams_count ?? 0 }} equipos</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span>{{ $evento->min_team_size }}-{{ $evento->max_team_size }} integrantes</span>
                        </div>
                    </div>
                    
                    <!-- Botón -->
                    <a href="{{ route('estudiante.evento-detalle', $evento->id) }}" 
                       class="block w-full py-3 px-4 rounded-lg font-medium transition-colors text-center {{ $evento->status === 'finished' ? 'bg-gray-300 text-gray-500 cursor-not-allowed pointer-events-none' : 'bg-gray-900 text-white hover:bg-gray-800' }}">
                        {{ $evento->status === 'finished' ? 'Evento finalizado' : 'Ver detalles →' }}
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">No se encontraron eventos</p>
            </div>
        @endforelse
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const tabButtons = document.querySelectorAll('.tab-button');
    const allCards = document.querySelectorAll('.evento-card');
    
    let currentStatus = 'all';
    let currentCategory = 'all';
    let currentSearch = '';
    
    function filtrarEventos() {
        let visibleCount = 0;
        
        allCards.forEach(card => {
            const cardCategory = card.dataset.category;
            const cardStatus = card.dataset.status;
            const cardText = card.textContent.toLowerCase();
            
            const matchCategory = currentCategory === 'all' || cardCategory === currentCategory;
            const matchStatus = currentStatus === 'all' || cardStatus === currentStatus;
            const matchSearch = currentSearch === '' || cardText.includes(currentSearch);
            
            if (matchCategory && matchStatus && matchSearch) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
    }
    
    searchInput.addEventListener('input', function() {
        currentSearch = this.value.toLowerCase();
        filtrarEventos();
    });
    
    categoryFilter.addEventListener('change', function() {
        currentCategory = this.value;
        filtrarEventos();
    });
    
    tabButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            tabButtons.forEach(b => {
                b.classList.remove('active', 'text-gray-900', 'border-blue-600');
                b.classList.add('text-gray-600', 'border-transparent');
            });
            this.classList.add('active', 'text-gray-900', 'border-blue-600');
            this.classList.remove('text-gray-600', 'border-transparent');
            
            currentStatus = this.dataset.status;
            filtrarEventos();
        });
    });
});
</script>
@endsection
