@extends('layouts.estudiante')

@section('title', 'Mis Equipos - EventTec')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Equipos</h1>
        <p class="text-gray-600 text-lg">Gestiona tus equipos y colabora con otros participantes</p>
    </div>

    <!-- Barra de búsqueda y filtros -->
    <div class="flex flex-col md:flex-row gap-4 mb-6">
        <!-- Buscador -->
        <div class="flex-1 relative">
            <input type="text" 
                   id="searchEquipos"
                   placeholder="Buscar equipos..." 
                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-sm">
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>

        <!-- Filtro por evento -->
        <select name="event_filter" class="px-6 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-700 font-medium">
            <option value="all">Todos los eventos</option>
            @foreach($eventos as $evento)
                <option value="{{ $evento->id }}">{{ $evento->title }}</option>
            @endforeach
        </select>
    </div>

    <!-- Lista de equipos o mensaje vacío -->
    @if($equipos->count() > 0)
        <div id="equipos-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($equipos as $equipo)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border border-gray-100">
                    <!-- Header del equipo -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $equipo->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $equipo->event->title }}</p>
                        </div>
                        @if($equipo->leader_id === auth()->id())
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Líder</span>
                        @else
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">Miembro</span>
                        @endif
                    </div>

                    <!-- Descripción -->
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ $equipo->description ?? 'Sin descripción' }}
                    </p>

                    <!-- Info del equipo -->
                    <div class="space-y-2 mb-4 text-sm text-gray-600">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span>{{ $equipo->members_count }} miembros</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                            <span class="font-mono">{{ $equipo->invitation_code }}</span>
                        </div>
                        @if($equipo->leader)
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Líder: {{ $equipo->leader->name }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Botón ver detalles -->
                    <a href="{{ route('estudiante.equipos.show', $equipo->id) }}" 
                       class="block w-full py-2 px-4 bg-gray-900 text-white text-center rounded-lg hover:bg-gray-800 transition-colors font-medium">
                        Ver detalles
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <!-- Mensaje cuando no hay equipos -->
        <div class="text-center py-16">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">No tienes equipos</h3>
            <p class="text-gray-600 mb-6">Crea un equipo o acepta una invitación para comenzar</p>
            <a href="{{ route('estudiante.eventos') }}" 
               class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Ver eventos disponibles
            </a>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchEquipos');
    const eventFilter = document.querySelector('select[name="event_filter"]');
    const equiposContainer = document.getElementById('equipos-container');
    
    if (searchInput && equiposContainer) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const equipos = equiposContainer.querySelectorAll('.bg-white');
            
            equipos.forEach(equipo => {
                const text = equipo.textContent.toLowerCase();
                equipo.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
    }
    
    if (eventFilter) {
        eventFilter.addEventListener('change', function() {
            const selectedEvent = this.value;
            if (selectedEvent === 'all') {
                window.location.href = '{{ route("estudiante.equipos") }}';
            } else {
                window.location.href = `{{ route("estudiante.equipos") }}?event_id=${selectedEvent}`;
            }
        });
    }
});
</script>
@endsection
