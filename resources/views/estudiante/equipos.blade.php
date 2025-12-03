@extends('layouts.estudiante')

@section('title', 'Mis Equipos - EventTec')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header con botones de acción -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Equipos</h1>
            <p class="text-gray-600 text-lg">Gestiona tus equipos y colabora con otros participantes</p>
        </div>
        <div class="flex gap-3">
            <button id="btn-unirse-equipo" class="px-6 py-3 bg-white border-2 border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition-colors font-medium flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                </svg>
                Unirse con código
            </button>
            <button id="btn-crear-equipo" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Crear equipo
            </button>
        </div>
    </div>

    <!-- Barra de búsqueda y filtros -->
    <div class="flex flex-col md:flex-row gap-4 mb-6">
        <div class="flex-1 relative">
            <input type="text" 
                   id="searchEquipos"
                   placeholder="Buscar equipos..." 
                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <select id="eventFilter" class="px-6 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 font-medium">
            <option value="all">Todos los eventos</option>
            @foreach($eventos as $evento)
                <option value="{{ $evento->id }}">{{ $evento->title }}</option>
            @endforeach
        </select>
    </div>

    <!-- Lista de equipos -->
    @if($equipos->count() > 0)
        <div id="equipos-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($equipos as $equipo)
                <div class="equipo-card bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border border-gray-100" data-event-id="{{ $equipo->event_id }}">
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

                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ $equipo->description ?? 'Sin descripción' }}
                    </p>

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
                    </div>

                    <a href="{{ route('estudiante.equipos.show', $equipo->id) }}" 
                       class="block w-full py-2 px-4 bg-gray-900 text-white text-center rounded-lg hover:bg-gray-800 transition-colors font-medium">
                        Ver detalles
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">No tienes equipos</h3>
            <p class="text-gray-600 mb-6">Crea un equipo o únete con un código de invitación</p>
            <div class="flex gap-3 justify-center">
                <button onclick="document.getElementById('btn-unirse-equipo').click()" 
                        class="inline-flex items-center gap-2 px-6 py-3 bg-white border-2 border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition-colors font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                    Unirse con código
                </button>
                <button onclick="document.getElementById('btn-crear-equipo').click()" 
                        class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Crear equipo
                </button>
            </div>
        </div>
    @endif
</div>

<!-- Modal: Crear Equipo -->
<div id="modal-crear-equipo" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-8 relative">
        <button class="cerrar-modal absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <h3 class="text-2xl font-bold text-gray-900 mb-2">Crear Equipo</h3>
        <p class="text-gray-600 mb-6">Registra tu equipo para un evento</p>

        <form id="form-crear-equipo" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Evento *</label>
                <select name="event_id" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Selecciona un evento</option>
                    @foreach($eventos as $evento)
                        <option value="{{ $evento->id }}">{{ $evento->title }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del equipo *</label>
                <input type="text" name="team_name" required placeholder="Ej: Tech Innovators"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                <textarea name="description" rows="3" placeholder="Describe tu equipo..."
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="button" class="cerrar-modal flex-1 py-3 px-4 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                    Cancelar
                </button>
                <button type="submit" class="flex-1 py-3 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    Crear equipo
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Unirse con Código -->
<div id="modal-unirse-equipo" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-8 relative">
        <button class="cerrar-modal absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Unirse a Equipo</h3>
            <p class="text-gray-600">Ingresa el código de invitación</p>
        </div>

        <form id="form-unirse-equipo" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2 text-center">Código de invitación</label>
                <input type="text" 
                       name="invitation_code" 
                       required 
                       placeholder="Ej: ABC123"
                       maxlength="6"
                       class="w-full px-4 py-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-center text-2xl font-mono uppercase tracking-widest">
                <p class="text-xs text-gray-500 text-center mt-2">Código de 6 caracteres</p>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="button" class="cerrar-modal flex-1 py-3 px-4 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                    Cancelar
                </button>
                <button type="submit" class="flex-1 py-3 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    Unirse
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modales
    const modalCrear = document.getElementById('modal-crear-equipo');
    const modalUnirse = document.getElementById('modal-unirse-equipo');
    const btnCrear = document.getElementById('btn-crear-equipo');
    const btnUnirse = document.getElementById('btn-unirse-equipo');
    const cerrarBtns = document.querySelectorAll('.cerrar-modal');

    btnCrear.addEventListener('click', () => modalCrear.classList.remove('hidden'));
    btnUnirse.addEventListener('click', () => modalUnirse.classList.remove('hidden'));

    cerrarBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            modalCrear.classList.add('hidden');
            modalUnirse.classList.add('hidden');
        });
    });

    // Crear equipo
    document.getElementById('form-crear-equipo').addEventListener('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const btn = this.querySelector('button[type="submit"]');
        btn.disabled = true;
        btn.textContent = 'Creando...';

        try {
            const response = await fetch('{{ route("estudiante.equipos.store") }}', {
                method: 'POST',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json'},
                body: formData
            });
            const data = await response.json();
            if (data.success) {
                alert('✓ Equipo creado exitosamente');
                window.location.reload();
            } else {
                alert('✗ ' + data.message);
                btn.disabled = false;
                btn.textContent = 'Crear equipo';
            }
        } catch (error) {
            alert('✗ Error al crear equipo');
            btn.disabled = false;
            btn.textContent = 'Crear equipo';
        }
    });

    // Unirse a equipo
    document.getElementById('form-unirse-equipo').addEventListener('submit', async function(e) {
        e.preventDefault();
        const code = this.querySelector('input[name="invitation_code"]').value.toUpperCase();
        const btn = this.querySelector('button[type="submit"]');
        btn.disabled = true;
        btn.textContent = 'Uniéndose...';

        try {
            const response = await fetch('{{ route("estudiante.equipos.join") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({invitation_code: code})
            });
            const data = await response.json();
            if (data.success) {
                alert('✓ Te has unido al equipo exitosamente');
                window.location.reload();
            } else {
                alert('✗ ' + data.message);
                btn.disabled = false;
                btn.textContent = 'Unirse';
            }
        } catch (error) {
            alert('✗ Error al unirse al equipo');
            btn.disabled = false;
            btn.textContent = 'Unirse';
        }
    });

    // FILTROS
    const searchInput = document.getElementById('searchEquipos');
    const eventFilter = document.getElementById('eventFilter');
    const equipoCards = document.querySelectorAll('.equipo-card');

    // Filtro por búsqueda
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            filtrarEquipos();
        });
    }

    // Filtro por evento
    if (eventFilter) {
        eventFilter.addEventListener('change', function() {
            filtrarEquipos();
        });
    }

    function filtrarEquipos() {
        const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
        const selectedEvent = eventFilter ? eventFilter.value : 'all';

        equipoCards.forEach(card => {
            const cardText = card.textContent.toLowerCase();
            const cardEventId = card.dataset.eventId;

            const matchSearch = searchTerm === '' || cardText.includes(searchTerm);
            const matchEvent = selectedEvent === 'all' || cardEventId === selectedEvent;

            if (matchSearch && matchEvent) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }
});
</script>
@endsection
