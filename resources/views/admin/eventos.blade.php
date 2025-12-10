@extends('layouts.admin')

@section('title', 'Eventos')
@section('breadcrumb', 'Eventos')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Mensajes de éxito/error -->
    @if(session('success'))
    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
        <p class="text-green-700">{{ session('success') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
        <p class="text-red-700">{{ session('error') }}</p>
    </div>
    @endif

    <!-- Encabezado -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-900">Gestión de Eventos</h1>
            <p class="text-gray-600 mt-2 text-lg">Administra y supervisa todos los eventos académicos</p>
        </div>
        <button onclick="openCreateModal()" class="px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white font-semibold rounded-xl transition-all duration-300 flex items-center gap-2 shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Crear Evento
        </button>
    </div>

    <!-- Filtros -->
    <form method="GET" action="{{ route('admin.eventos') }}" class="bg-white rounded-2xl shadow-sm p-6 mb-8 border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Buscar</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Nombre del evento..." class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                <select name="status" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
                    <option value="">Todos</option>
                    <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Proximamente</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>En Curso</option>
                    <option value="finished" {{ request('status') == 'finished' ? 'selected' : '' }}>Finalizado</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                <select name="category" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
                    <option value="">Todas</option>
                    <option value="Tecnología" {{ request('category') == 'Tecnología' ? 'selected' : '' }}>Tecnología</option>
                    <option value="Ciencias" {{ request('category') == 'Ciencias' ? 'selected' : '' }}>Ciencias</option>
                    <option value="Negocios" {{ request('category') == 'Negocios' ? 'selected' : '' }}>Negocios</option>
                    <option value="Arte" {{ request('category') == 'Arte' ? 'selected' : '' }}>Arte</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2.5 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition-colors text-sm font-medium">
                    Filtrar
                </button>
            </div>
        </div>
    </form>

    <!-- Lista de Eventos -->
    <div class="space-y-6">
        @forelse($eventos as $evento)
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-start gap-4 flex-1">
                        <div class="w-20 h-20 rounded-xl flex items-center justify-center text-3xl shadow-md flex-shrink-0
                            @if($evento->status === 'in_progress')
                                bg-gradient-to-br from-green-500 to-green-600
                            @elseif($evento->status === 'upcoming')
                                bg-gradient-to-br from-blue-500 to-blue-600
                            @elseif($evento->status === 'finished')
                                bg-gradient-to-br from-gray-500 to-gray-600
                            @else
                                bg-gradient-to-br from-purple-500 to-purple-600
                            @endif
                        ">
                            @if($evento->category === 'Tecnología')
                                🏆
                            @elseif($evento->category === 'Ciencias')
                                🔬
                            @elseif($evento->category === 'Negocios')
                                💼
                            @elseif($evento->category === 'Arte')
                                🎨
                            @else
                                📅
                            @endif
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <h3 class="text-2xl font-bold text-gray-900">{{ $evento->title }}</h3>
                                <span class="px-3 py-1 {{ $evento->getStatusBadgeClass() }} text-xs font-semibold rounded-full">
                                    {{ $evento->getStatusLabel() }}
                                </span>
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">{{ $evento->category }}</span>
                            </div>
                            <p class="text-gray-600 mb-4">{{ Str::limit($evento->description, 150) }}</p>
                            
                            <div class="grid grid-cols-4 gap-4">
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="font-medium">{{ $evento->event_start_date->format('d M') }} - {{ $evento->event_end_date->format('d M') }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <span class="font-medium">{{ $evento->teams_count }} equipos</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    <span class="font-medium">{{ $evento->min_team_size }}-{{ $evento->max_team_size }} integrantes</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span class="font-medium">{{ $evento->projects_count }} proyectos</span>
                                </div>
                            </div>

                            <!-- Solo Jueces - Solo para eventos Proximamente -->
                            @if($evento->status === 'upcoming')
                            <div class="mt-4 flex items-center gap-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-medium text-gray-700">Jueces:</span>
                                    @if($evento->judges_count > 0)
                                    <span class="text-sm text-gray-600">{{ $evento->judges_count }} asignados</span>
                                    <button onclick="openJudgesModal('{{ $evento->id }}', {{ json_encode($evento->judges->pluck('id')) }})" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                                        Gestionar
                                    </button>
                                    @else
                                    <button onclick="openJudgesModal('{{ $evento->id }}', [])" class="text-sm text-orange-600 hover:text-orange-700 font-medium">
                                        Asignar Jueces
                                    </button>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.eventos.ver', $evento->id) }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                        Ver Detalles
                    </a>
                    <button onclick="openEditModal({{ json_encode($evento) }})" class="px-5 py-2.5 text-sm font-medium text-blue-700 hover:bg-blue-50 rounded-lg transition-colors">
                        Editar
                    </button>
                    <button onclick="confirmDelete('{{ $evento->id }}', '{{ $evento->title }}')" class="px-5 py-2.5 text-sm font-medium text-red-700 hover:bg-red-50 rounded-lg transition-colors">
                        Eliminar
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-2xl shadow-sm p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No hay eventos</h3>
            <p class="text-gray-600 mb-6">Crea tu primer evento para comenzar</p>
            <button onclick="openCreateModal()" class="px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white font-semibold rounded-xl transition-all">
                Crear Evento
            </button>
        </div>
        @endforelse
    </div>

    <!-- Paginación -->
    @if($eventos->hasPages())
    <div class="mt-8">
        {{ $eventos->links() }}
    </div>
    @endif
</div>

<!-- Modal Crear Evento -->
<div id="createModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">
        <!-- Header -->
        <div class="sticky top-0 bg-gradient-to-r from-gray-900 to-gray-800 p-6 rounded-t-2xl z-10">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white">Crear Nuevo Evento</h2>
                </div>
                <button onclick="closeCreateModal()" class="text-white/70 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <form action="{{ route('admin.eventos.crear') }}" method="POST" id="createEventForm" class="p-8">
            @csrf
            
            <!-- Sección: Información Básica -->
            <div class="mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 bg-gray-900 rounded-lg flex items-center justify-center">
                        <span class="text-white text-sm font-bold">1</span>
                    </div>
                    Información Básica
                </h3>
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            Título del Evento <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="title" 
                            required 
                            minlength="5"
                            maxlength="200"
                            placeholder="Ej: Hackathon de Innovación Tecnológica 2025"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors"
                        >
                        <p class="text-xs text-gray-500 mt-1">Mínimo 5 caracteres, máximo 200</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            Descripción <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            name="description" 
                            required 
                            minlength="20"
                            maxlength="1000"
                            rows="4" 
                            placeholder="Describe el evento, objetivos y qué pueden esperar los participantes..."
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors resize-none"
                        ></textarea>
                        <p class="text-xs text-gray-500 mt-1">Mínimo 20 caracteres, máximo 1000</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                Categoría <span class="text-red-500">*</span>
                            </label>
                            <select 
                                name="category" 
                                required 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors"
                            >
                                <option value="">Seleccionar categoría</option>
                                <option value="Tecnología">🖥️ Tecnología</option>
                                <option value="Ciencias">🔬 Ciencias</option>
                                <option value="Negocios">💼 Negocios</option>
                                <option value="Arte">🎨 Arte</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                Ubicación
                            </label>
                            <input 
                                type="text" 
                                name="location" 
                                maxlength="200"
                                placeholder="Ej: Centro de Convenciones, Sala 3"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors"
                            >
                            <p class="text-xs text-gray-500 mt-1">Opcional</p>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            URL de Imagen de Portada
                        </label>
                        <input 
                            type="url" 
                            name="cover_image_url" 
                            placeholder="https://drive.google.com/... o https://..."
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors"
                        >
                        <p class="text-xs text-gray-500 mt-1">📷 Opcional - Pega el link de Google Drive o cualquier URL de imagen</p>
                    </div>
                </div>
            </div>

            <!-- Sección: Fechas -->
            <div class="mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 bg-gray-900 rounded-lg flex items-center justify-center">
                        <span class="text-white text-sm font-bold">2</span>
                    </div>
                    Fechas Importantes
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="bg-blue-50 p-4 rounded-xl border-2 border-blue-100">
                        <p class="text-xs font-bold text-blue-900 mb-3 uppercase">Periodo de Registro</p>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">
                                    Inicio <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="date" 
                                    name="registration_start_date" 
                                    id="registration_start_date"
                                    required 
                                    min="{{ date('Y-m-d') }}"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors"
                                >
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">
                                    Fin <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="date" 
                                    name="registration_end_date" 
                                    id="registration_end_date"
                                    required 
                                    min="{{ date('Y-m-d') }}"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors"
                                >
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-green-50 p-4 rounded-xl border-2 border-green-100">
                        <p class="text-xs font-bold text-green-900 mb-3 uppercase">Periodo del Evento</p>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">
                                    Inicio <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="date" 
                                    name="event_start_date" 
                                    id="event_start_date"
                                    required 
                                    min="{{ date('Y-m-d') }}"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors"
                                >
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">
                                    Fin <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="date" 
                                    name="event_end_date" 
                                    id="event_end_date"
                                    required 
                                    min="{{ date('Y-m-d') }}"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors"
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">⚠️ El registro debe finalizar antes del inicio del evento</p>
            </div>

            <!-- Sección: Configuración de Equipos -->
            <div class="mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 bg-gray-900 rounded-lg flex items-center justify-center">
                        <span class="text-white text-sm font-bold">3</span>
                    </div>
                    Configuración de Equipos
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            Tamaño Mínimo <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="number" 
                            name="min_team_size" 
                            id="min_team_size"
                            required 
                            min="1" 
                            max="10"
                            value="3" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors"
                        >
                        <p class="text-xs text-gray-500 mt-1">Integrantes mínimos</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            Tamaño Máximo <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="number" 
                            name="max_team_size" 
                            id="max_team_size"
                            required 
                            min="1" 
                            max="20"
                            value="5" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors"
                        >
                        <p class="text-xs text-gray-500 mt-1">Integrantes máximos</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            Máximo de Equipos
                        </label>
                        <input 
                            type="number" 
                            name="max_teams" 
                            min="1"
                            max="1000"
                            placeholder="Ilimitado"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors"
                        >
                        <p class="text-xs text-gray-500 mt-1">Dejar vacío = ilimitado</p>
                    </div>
                </div>
            </div>
            
            <!-- Botones -->
            <div class="flex items-center justify-end gap-4 pt-6 border-t-2 border-gray-100">
                <button 
                    type="button" 
                    onclick="closeCreateModal()" 
                    class="px-6 py-3 text-gray-700 hover:bg-gray-100 rounded-xl transition-colors font-semibold"
                >
                    Cancelar
                </button>
                <button 
                    type="submit" 
                    class="px-8 py-3 bg-gray-900 hover:bg-gray-800 text-white rounded-xl transition-all font-semibold shadow-lg hover:shadow-xl flex items-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Crear Evento
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Editar Evento -->
<div id="editModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">
        <!-- Header -->
        <div class="sticky top-0 bg-gradient-to-r from-gray-900 to-gray-800 p-6 rounded-t-2xl z-10">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white">Editar Evento</h2>
                </div>
                <button onclick="closeEditModal()" class="text-white/70 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="editForm" method="POST" class="p-8">
            @csrf
            @method('PUT')
            
            <!-- Sección: Información Básica -->
            <div class="mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 bg-gray-900 rounded-lg flex items-center justify-center">
                        <span class="text-white text-sm font-bold">1</span>
                    </div>
                    Información Básica
                </h3>
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            Título del Evento <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="title" 
                            id="edit_title" 
                            required 
                            minlength="5"
                            maxlength="200"
                            placeholder="Ej: Hackathon de Innovación Tecnológica 2025"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors"
                        >
                        <p class="text-xs text-gray-500 mt-1">Mínimo 5 caracteres, máximo 200</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            Descripción <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            name="description" 
                            id="edit_description" 
                            required 
                            minlength="20"
                            maxlength="1000"
                            rows="4" 
                            placeholder="Describe el evento, objetivos y qué pueden esperar los participantes..."
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors resize-none"
                        ></textarea>
                        <p class="text-xs text-gray-500 mt-1">Mínimo 20 caracteres, máximo 1000</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                Categoría <span class="text-red-500">*</span>
                            </label>
                            <select 
                                name="category" 
                                id="edit_category" 
                                required 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors"
                            >
                                <option value="">Seleccionar categoría</option>
                                <option value="Tecnología">🖥️ Tecnología</option>
                                <option value="Ciencias">🔬 Ciencias</option>
                                <option value="Negocios">💼 Negocios</option>
                                <option value="Arte">🎨 Arte</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                Ubicación
                            </label>
                            <input 
                                type="text" 
                                name="location" 
                                id="edit_location" 
                                maxlength="200"
                                placeholder="Ej: Centro de Convenciones, Sala 3"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors"
                            >
                            <p class="text-xs text-gray-500 mt-1">Opcional</p>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            URL de Imagen de Portada
                        </label>
                        <input 
                            type="url" 
                            name="cover_image_url" 
                            id="edit_cover_image_url"
                            placeholder="https://drive.google.com/... o https://..."
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors"
                        >
                        <p class="text-xs text-gray-500 mt-1">📷 Opcional - Pega el link de Google Drive o cualquier URL de imagen</p>
                    </div>
                </div>
            </div>

            <!-- Sección: Fechas -->
            <div class="mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 bg-gray-900 rounded-lg flex items-center justify-center">
                        <span class="text-white text-sm font-bold">2</span>
                    </div>
                    Fechas Importantes
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="bg-blue-50 p-4 rounded-xl border-2 border-blue-100">
                        <p class="text-xs font-bold text-blue-900 mb-3 uppercase">Periodo de Registro</p>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">
                                    Inicio <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="date" 
                                    name="registration_start_date" 
                                    id="edit_registration_start_date"
                                    required 
                                    min="{{ date('Y-m-d') }}"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors"
                                >
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">
                                    Fin <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="date" 
                                    name="registration_end_date" 
                                    id="edit_registration_end_date"
                                    required 
                                    min="{{ date('Y-m-d') }}"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors"
                                >
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-green-50 p-4 rounded-xl border-2 border-green-100">
                        <p class="text-xs font-bold text-green-900 mb-3 uppercase">Periodo del Evento</p>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">
                                    Inicio <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="date" 
                                    name="event_start_date" 
                                    id="edit_event_start_date"
                                    required 
                                    min="{{ date('Y-m-d') }}"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors"
                                >
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">
                                    Fin <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="date" 
                                    name="event_end_date" 
                                    id="edit_event_end_date"
                                    required 
                                    min="{{ date('Y-m-d') }}"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors"
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">⚠️ El registro debe finalizar antes del inicio del evento</p>
            </div>

            <!-- Sección: Configuración de Equipos -->
            <div class="mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 bg-gray-900 rounded-lg flex items-center justify-center">
                        <span class="text-white text-sm font-bold">3</span>
                    </div>
                    Configuración de Equipos
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            Tamaño Mínimo <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="number" 
                            name="min_team_size" 
                            id="edit_min_team_size"
                            required 
                            min="1" 
                            max="10"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors"
                        >
                        <p class="text-xs text-gray-500 mt-1">Integrantes mínimos</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            Tamaño Máximo <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="number" 
                            name="max_team_size" 
                            id="edit_max_team_size"
                            required 
                            min="1" 
                            max="20"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors"
                        >
                        <p class="text-xs text-gray-500 mt-1">Integrantes máximos</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            Máximo de Equipos
                        </label>
                        <input 
                            type="number" 
                            name="max_teams" 
                            id="edit_max_teams"
                            min="1"
                            max="1000"
                            placeholder="Ilimitado"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-900 transition-colors"
                        >
                        <p class="text-xs text-gray-500 mt-1">Dejar vacío = ilimitado</p>
                    </div>
                </div>
            </div>
            
            <!-- Botones -->
            <div class="flex items-center justify-end gap-4 pt-6 border-t-2 border-gray-100">
                <button 
                    type="button" 
                    onclick="closeEditModal()" 
                    class="px-6 py-3 text-gray-700 hover:bg-gray-100 rounded-xl transition-colors font-semibold"
                >
                    Cancelar
                </button>
                <button 
                    type="submit" 
                    class="px-8 py-3 bg-gray-900 hover:bg-gray-800 text-white rounded-xl transition-all font-semibold shadow-lg hover:shadow-xl flex items-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Asignar Jueces -->
<div id="judgesModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-900">Gestionar Jueces del Evento</h2>
                <button onclick="closeJudgesModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="judgesForm" method="POST" class="p-6">
            @csrf
            <div class="mb-4">
                <p class="text-sm text-gray-600">Selecciona uno o más jueces para asignar a este evento:</p>
            </div>
            <div class="space-y-4 max-h-96 overflow-y-auto">
                @foreach($jueces as $juez)
                <label class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 cursor-pointer transition-colors">
                    <input type="checkbox" name="judges[]" value="{{ $juez->id }}" class="judge-checkbox w-4 h-4 text-gray-900 border-gray-300 rounded focus:ring-gray-900">
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">{{ $juez->name }}</p>
                        <p class="text-xs text-gray-600">{{ $juez->email }}</p>
                    </div>
                </label>
                @endforeach
            </div>
            
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-200">
                <button type="button" onclick="closeJudgesModal()" class="px-6 py-2.5 text-gray-700 hover:bg-gray-100 rounded-xl transition-colors font-medium">
                    Cancelar
                </button>
                <button type="submit" class="px-6 py-2.5 bg-gray-900 hover:bg-gray-800 text-white rounded-xl transition-colors font-medium">
                    Guardar Asignación
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('createModal').classList.remove('hidden');
}

function closeCreateModal() {
    document.getElementById('createModal').classList.add('hidden');
}

function openEditModal(evento) {
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');
    form.action = `/admin/eventos/${evento.id}`;
    
    // Llenar el formulario con los datos del evento
    document.getElementById('edit_title').value = evento.title;
    document.getElementById('edit_description').value = evento.description;
    document.getElementById('edit_category').value = evento.category;
    document.getElementById('edit_location').value = evento.location || '';
    document.getElementById('edit_cover_image_url').value = evento.cover_image_url || '';
    
    // Función para formatear fechas
    function formatDate(dateValue) {
        if (!dateValue) return '';
        
        // Si es un objeto con date property (Carbon serializado)
        if (typeof dateValue === 'object' && dateValue.date) {
            return dateValue.date.split(' ')[0];
        }
        
        // Si es una string, extraer solo la fecha
        if (typeof dateValue === 'string') {
            return dateValue.split(' ')[0];
        }
        
        return '';
    }
    
    document.getElementById('edit_registration_start_date').value = formatDate(evento.registration_start_date);
    document.getElementById('edit_registration_end_date').value = formatDate(evento.registration_end_date);
    document.getElementById('edit_event_start_date').value = formatDate(evento.event_start_date);
    document.getElementById('edit_event_end_date').value = formatDate(evento.event_end_date);
    
    document.getElementById('edit_min_team_size').value = evento.min_team_size;
    document.getElementById('edit_max_team_size').value = evento.max_team_size;
    document.getElementById('edit_max_teams').value = evento.max_teams || '';
    
    modal.classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

function openJudgesModal(eventId, selectedJudges) {
    const modal = document.getElementById('judgesModal');
    const form = document.getElementById('judgesForm');
    form.action = `/admin/eventos/${eventId}/asignar-jueces`;
    
    // Marcar jueces previamente asignados
    document.querySelectorAll('.judge-checkbox').forEach(checkbox => {
        checkbox.checked = selectedJudges.includes(checkbox.value);
    });
    
    modal.classList.remove('hidden');
}

function closeJudgesModal() {
    document.getElementById('judgesModal').classList.add('hidden');
}

function confirmDelete(eventId, eventName) {
    if (confirm(`¿Estás seguro de que deseas eliminar el evento "${eventName}"? Esta acción no se puede deshacer.`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/eventos/${eventId}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}

// Cerrar modales al hacer clic fuera
document.addEventListener('click', function(event) {
    const createModal = document.getElementById('createModal');
    const editModal = document.getElementById('editModal');
    const judgesModal = document.getElementById('judgesModal');
    
    if (event.target === createModal) {
        closeCreateModal();
    }
    if (event.target === editModal) {
        closeEditModal();
    }
    if (event.target === judgesModal) {
        closeJudgesModal();
    }
});

// Validaciones del formulario de crear evento
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('createEventForm');
    
    if (form) {
        // Validación de fechas
        const regStart = document.getElementById('registration_start_date');
        const regEnd = document.getElementById('registration_end_date');
        const eventStart = document.getElementById('event_start_date');
        const eventEnd = document.getElementById('event_end_date');
        
        // Validar que fecha fin registro sea posterior a inicio
        regEnd?.addEventListener('change', function() {
            if (regStart.value && regEnd.value < regStart.value) {
                regEnd.setCustomValidity('La fecha fin de registro debe ser posterior a la fecha de inicio');
                regEnd.reportValidity();
            } else {
                regEnd.setCustomValidity('');
            }
        });
        
        // Validar que fecha de evento sea posterior a registro
        eventStart?.addEventListener('change', function() {
            if (regEnd.value && eventStart.value < regEnd.value) {
                eventStart.setCustomValidity('El evento debe iniciar después del cierre de registro');
                eventStart.reportValidity();
            } else {
                eventStart.setCustomValidity('');
            }
        });
        
        // Validar que fecha fin evento sea posterior a inicio
        eventEnd?.addEventListener('change', function() {
            if (eventStart.value && eventEnd.value < eventStart.value) {
                eventEnd.setCustomValidity('La fecha fin del evento debe ser posterior a la fecha de inicio');
                eventEnd.reportValidity();
            } else {
                eventEnd.setCustomValidity('');
            }
        });
        
        // Validación de tamaños de equipo
        const minSize = document.getElementById('min_team_size');
        const maxSize = document.getElementById('max_team_size');
        
        maxSize?.addEventListener('change', function() {
            if (minSize.value && parseInt(maxSize.value) < parseInt(minSize.value)) {
                maxSize.setCustomValidity('El tamaño máximo debe ser mayor o igual al mínimo');
                maxSize.reportValidity();
            } else {
                maxSize.setCustomValidity('');
            }
        });
        
        minSize?.addEventListener('change', function() {
            if (maxSize.value && parseInt(minSize.value) > parseInt(maxSize.value)) {
                minSize.setCustomValidity('El tamaño mínimo debe ser menor o igual al máximo');
                minSize.reportValidity();
            } else {
                minSize.setCustomValidity('');
            }
        });
    }
});
</script>

@endsection
