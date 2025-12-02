@extends('layouts.dashboard')

@section('title', 'Equipos - Asesor')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Equipos</h1>
        <p class="text-gray-600 mt-1">Gestiona tus equipos y colabora con otros participantes</p>
    </div>

    <!-- Barra de búsqueda y filtros -->
    <div class="bg-white rounded-2xl p-6 shadow-sm mb-6">
        <div class="flex flex-col md:flex-row gap-4 items-center">
            <!-- Buscador -->
            <div class="flex-1 w-full">
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" id="buscarEquipos" placeholder="Buscar equipos..." 
                           class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Filtro por evento -->
            <select class="px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option>Todos los eventos</option>
                <option>Hackathon 2024</option>
                <option>Feria de Ciencias</option>
                <option>Robótica</option>
            </select>

            <!-- Botón crear equipo -->
            <button onclick="mostrarModalCrearEquipo()" class="flex items-center gap-2 px-6 py-3 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition-colors font-medium whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Crear Primer Equipo
            </button>
        </div>
    </div>

    <!-- Estado vacío -->
    <div class="bg-white rounded-2xl p-12 text-center shadow-sm">
        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-800 mb-2">No tienes equipos</h2>
        <p class="text-gray-600 mb-6 max-w-md mx-auto">
            Crea un equipo o acepta una invitación para comenzar
        </p>
        <button onclick="mostrarModalCrearEquipo()" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition-colors font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Crear Primer Equipo
        </button>
    </div>

    <!-- Este contenido aparecería cuando haya equipos -->
    <div id="listaEquipos" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 hidden">
        <!-- Tarjeta de Equipo 1 -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Activo</span>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Tech Innovators</h3>
            <p class="text-sm text-gray-600 mb-4">Hackathon de Innovación 2024</p>
            
            <div class="flex items-center gap-2 mb-4">
                <div class="flex -space-x-2">
                    <div class="w-8 h-8 rounded-full bg-blue-500 border-2 border-white flex items-center justify-center text-white text-xs font-semibold">
                        JD
                    </div>
                    <div class="w-8 h-8 rounded-full bg-green-500 border-2 border-white flex items-center justify-center text-white text-xs font-semibold">
                        ML
                    </div>
                    <div class="w-8 h-8 rounded-full bg-purple-500 border-2 border-white flex items-center justify-center text-white text-xs font-semibold">
                        CP
                    </div>
                </div>
                <span class="text-sm text-gray-600">3 integrantes</span>
            </div>

            <div class="flex gap-2">
                <button class="flex-1 px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors text-sm font-medium">
                    Ver equipo
                </button>
                <button class="px-4 py-2 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Tarjeta de Equipo 2 -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Activo</span>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Green Solutions</h3>
            <p class="text-sm text-gray-600 mb-4">Feria de Ciencias 2024</p>
            
            <div class="flex items-center gap-2 mb-4">
                <div class="flex -space-x-2">
                    <div class="w-8 h-8 rounded-full bg-orange-500 border-2 border-white flex items-center justify-center text-white text-xs font-semibold">
                        AR
                    </div>
                    <div class="w-8 h-8 rounded-full bg-pink-500 border-2 border-white flex items-center justify-center text-white text-xs font-semibold">
                        SM
                    </div>
                </div>
                <span class="text-sm text-gray-600">2 integrantes</span>
            </div>

            <div class="flex gap-2">
                <button class="flex-1 px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors text-sm font-medium">
                    Ver equipo
                </button>
                <button class="px-4 py-2 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Equipo -->
<div id="modalCrearEquipo" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Crear Nuevo Equipo</h2>
            <button onclick="cerrarModalCrearEquipo()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <form>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del Equipo</label>
                    <input type="text" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ej: Los Innovadores">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Evento</label>
                    <select class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>Selecciona un evento</option>
                        <option>Hackathon de Innovación 2024</option>
                        <option>Feria de Ciencias 2024</option>
                        <option>Concurso de Robótica</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Descripción (opcional)</label>
                    <textarea class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3" placeholder="Describe tu equipo..."></textarea>
                </div>
            </div>
            
            <div class="flex gap-3 mt-6">
                <button type="button" onclick="cerrarModalCrearEquipo()" class="flex-1 px-6 py-3 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors font-medium">
                    Cancelar
                </button>
                <button type="submit" class="flex-1 px-6 py-3 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition-colors font-medium">
                    Crear Equipo
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function mostrarModalCrearEquipo() {
        document.getElementById('modalCrearEquipo').classList.remove('hidden');
        document.getElementById('modalCrearEquipo').classList.add('flex');
    }

    function cerrarModalCrearEquipo() {
        document.getElementById('modalCrearEquipo').classList.add('hidden');
        document.getElementById('modalCrearEquipo').classList.remove('flex');
    }
</script>
@endsection
