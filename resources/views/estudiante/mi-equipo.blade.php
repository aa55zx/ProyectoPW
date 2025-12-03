@extends('layouts.estudiante')

@section('title', 'Equipos - EventTec')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Equipos</h1>
        <p class="text-gray-600 text-lg">Gestiona tus equipos y colabora con otros participantes</p>
    </div>

    <!-- Barra de búsqueda y filtros -->
    <div class="flex flex-col md:flex-row gap-4 mb-8">
        <!-- Buscador -->
        <div class="flex-1 relative">
            <input type="text" 
                   id="searchTeams"
                   placeholder="Buscar equipos..." 
                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-sm">
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>

        <!-- Filtro por evento -->
        <select id="eventFilter" class="px-6 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-700 font-medium">
            <option value="all">Todos los eventos</option>
            <option value="hackathon">Hackathon de Innovación 2024</option>
            <option value="feria">Feria de Ciencias 2024</option>
            <option value="expo">Expo Emprendedores</option>
        </select>
    </div>

    <!-- Estado vacío cuando no hay equipos -->
    <div id="emptyState" class="bg-white rounded-2xl shadow-sm border border-gray-100 py-20 px-8 text-center">
        <div class="max-w-md mx-auto">
            <!-- Icono de equipos vacío -->
            <div class="mb-6">
                <svg class="w-24 h-24 text-gray-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-900 mb-3">No tienes equipos</h2>
            <p class="text-gray-600 mb-8">Crea un equipo o acepta una invitación para comenzar</p>
            
            <button onclick="openCreateTeamModal()" class="inline-flex items-center gap-2 bg-gray-900 hover:bg-gray-800 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Crear Primer Equipo
            </button>
        </div>
    </div>

    <!-- Grid de equipos (inicialmente oculto) -->
    <div id="teamsGrid" class="hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Las tarjetas de equipos se generarán aquí dinámicamente -->
    </div>

    <!-- Botón flotante para crear equipo (visible cuando hay equipos) -->
    <button id="floatingAddBtn" onclick="openCreateTeamModal()" class="hidden fixed bottom-8 right-8 bg-gray-900 hover:bg-gray-800 text-white p-4 rounded-full shadow-2xl hover:shadow-xl transition-all duration-300 z-10">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
    </button>
</div>

<!-- Modal para Crear Equipo -->
<div id="createTeamModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <!-- Header del Modal -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Crear nuevo equipo</h2>
                    <p class="text-sm text-gray-500 mt-1">Forma tu equipo para participar en eventos</p>
                </div>
                <button onclick="closeCreateTeamModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Formulario -->
            <form id="createTeamForm" class="space-y-5">
                <!-- Nombre del equipo -->
                <div>
                    <label for="team_name" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nombre del equipo
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="team_name" 
                           name="team_name" 
                           placeholder="ej: Tech Innovators" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                </div>

                <!-- Evento -->
                <div>
                    <label for="event_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Evento
                        <span class="text-red-500">*</span>
                    </label>
                    <select id="event_id" 
                            name="event_id" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        <option value="">Selecciona un evento</option>
                        <option value="1">Hackathon de Innovación 2024</option>
                        <option value="2">Feria de Ciencias 2024</option>
                        <option value="3">Expo Emprendedores</option>
                    </select>
                </div>

                <!-- Descripción -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                        Descripción
                        <span class="text-gray-400 text-xs font-normal">(opcional)</span>
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4" 
                              placeholder="Describe tu equipo y tus objetivos..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"></textarea>
                </div>

                <!-- Botones -->
                <div class="flex gap-3 pt-4">
                    <button type="button" 
                            onclick="closeCreateTeamModal()" 
                            class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="flex-1 px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white font-semibold rounded-xl transition-all shadow-md hover:shadow-lg">
                        Crear equipo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de Detalle del Equipo -->
<div id="teamDetailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-8">
            <!-- Header -->
            <div class="flex items-start justify-between mb-6">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <h2 id="detailTeamName" class="text-3xl font-bold text-gray-900">Tech Innovators</h2>
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Activo</span>
                    </div>
                    <p class="text-gray-600" id="detailEventName">Hackathon de Innovación 2024</p>
                </div>
                <button onclick="closeTeamDetailModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Descripción -->
            <div class="mb-6">
                <p id="detailDescription" class="text-gray-700 leading-relaxed">Equipo dedicado a crear soluciones innovadoras para problemas ambientales.</p>
            </div>

            <!-- Miembros -->
            <div class="mb-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Miembros del equipo</h3>
                <div id="detailMembers" class="space-y-3">
                    <!-- Los miembros se cargarán dinámicamente -->
                </div>
            </div>

            <!-- Acciones -->
            <div class="flex gap-3">
                <button class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-5 rounded-xl transition-all">
                    Editar equipo
                </button>
                <button class="flex-1 bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-5 rounded-xl transition-all">
                    Abandonar equipo
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Datos de ejemplo (simulación)
    let teams = [];

    // Función para renderizar equipos
    function renderTeams() {
        const emptyState = document.getElementById('emptyState');
        const teamsGrid = document.getElementById('teamsGrid');
        const floatingBtn = document.getElementById('floatingAddBtn');
        
        if (teams.length === 0) {
            emptyState.classList.remove('hidden');
            teamsGrid.classList.add('hidden');
            floatingBtn.classList.add('hidden');
        } else {
            emptyState.classList.add('hidden');
            teamsGrid.classList.remove('hidden');
            floatingBtn.classList.remove('hidden');
            
            // Renderizar tarjetas de equipos
            teamsGrid.innerHTML = teams.map(team => `
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition-all duration-300 cursor-pointer" onclick="showTeamDetail(${team.id})">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 mb-1">${team.name}</h3>
                            <p class="text-sm text-gray-500">${team.event}</p>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Activo</span>
                    </div>
                    
                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">${team.description}</p>
                    
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span class="font-medium">${team.members} miembros</span>
                        </div>
                        <button class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                            Ver detalles
                        </button>
                    </div>
                </div>
            `).join('');
        }
    }

    // Modal functions
    function openCreateTeamModal() {
        document.getElementById('createTeamModal').classList.remove('hidden');
        document.getElementById('createTeamModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeCreateTeamModal() {
        document.getElementById('createTeamModal').classList.add('hidden');
        document.getElementById('createTeamModal').classList.remove('flex');
        document.body.style.overflow = 'auto';
        document.getElementById('createTeamForm').reset();
    }

    function showTeamDetail(teamId) {
        const team = teams.find(t => t.id === teamId);
        if (!team) return;
        
        document.getElementById('detailTeamName').textContent = team.name;
        document.getElementById('detailEventName').textContent = team.event;
        document.getElementById('detailDescription').textContent = team.description;
        
        // Renderizar miembros
        const membersHtml = team.membersList.map((member, index) => `
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                    ${member.charAt(0).toUpperCase()}
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-gray-900">${member}</p>
                    <p class="text-xs text-gray-500">${index === 0 ? 'Líder del equipo' : 'Miembro'}</p>
                </div>
            </div>
        `).join('');
        
        document.getElementById('detailMembers').innerHTML = membersHtml;
        
        document.getElementById('teamDetailModal').classList.remove('hidden');
        document.getElementById('teamDetailModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeTeamDetailModal() {
        document.getElementById('teamDetailModal').classList.add('hidden');
        document.getElementById('teamDetailModal').classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    // Submit del formulario
    document.getElementById('createTeamForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const eventSelect = document.getElementById('event_id');
        const eventText = eventSelect.options[eventSelect.selectedIndex].text;
        
        // Agregar nuevo equipo
        const newTeam = {
            id: teams.length + 1,
            name: formData.get('team_name'),
            event: eventText,
            description: formData.get('description') || 'Sin descripción',
            members: 1,
            membersList: ['{{ auth()->user()->name }}']
        };
        
        teams.push(newTeam);
        renderTeams();
        closeCreateTeamModal();
        
        // Mostrar notificación (opcional)
        alert('¡Equipo creado exitosamente!');
    });

    // Búsqueda
    document.getElementById('searchTeams').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const cards = document.querySelectorAll('#teamsGrid > div');
        
        cards.forEach(card => {
            const text = card.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });

    // Filtro por evento
    document.getElementById('eventFilter').addEventListener('change', function(e) {
        const filter = e.target.value;
        const cards = document.querySelectorAll('#teamsGrid > div');
        
        cards.forEach(card => {
            const eventText = card.querySelector('.text-sm.text-gray-500').textContent.toLowerCase();
            if (filter === 'all' || eventText.includes(filter)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });

    // Cerrar modales al hacer clic fuera
    document.getElementById('createTeamModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeCreateTeamModal();
        }
    });

    document.getElementById('teamDetailModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeTeamDetailModal();
        }
    });

    // Inicializar
    renderTeams();
</script>
@endsection
