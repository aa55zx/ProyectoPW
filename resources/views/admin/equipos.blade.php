@extends('layouts.admin')

@section('title', 'Equipos')
@section('breadcrumb', 'Equipos')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Encabezado -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-900">Gestión de Equipos</h1>
            <p class="text-gray-600 mt-2 text-lg">Administra y supervisa todos los equipos registrados</p>
        </div>
        <button class="px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white font-semibold rounded-xl transition-all duration-300 flex items-center gap-2 shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Crear Equipo
        </button>
    </div>

    <!-- Estadísticas Rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-sm p-6 text-white">
            <p class="text-sm opacity-90 mb-2">Total Equipos</p>
            <p class="text-4xl font-bold">50</p>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-sm p-6 text-white">
            <p class="text-sm opacity-90 mb-2">Equipos Activos</p>
            <p class="text-4xl font-bold">42</p>
        </div>
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-sm p-6 text-white">
            <p class="text-sm opacity-90 mb-2">Total Participantes</p>
            <p class="text-4xl font-bold">187</p>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl shadow-sm p-6 text-white">
            <p class="text-sm opacity-90 mb-2">Promedio por Equipo</p>
            <p class="text-4xl font-bold">3.7</p>
        </div>
    </div>

    <!-- Filtros -->
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-8 border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Buscar</label>
                <input type="text" placeholder="Nombre del equipo..." class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Evento</label>
                <select class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
                    <option>Todos los eventos</option>
                    <option>Hackathon de Innovación 2024</option>
                    <option>Feria de Ciencias 2024</option>
                    <option>Concurso de Robótica</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                <select class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
                    <option>Todos</option>
                    <option>Activo</option>
                    <option>Inactivo</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Integrantes</label>
                <select class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
                    <option>Todos</option>
                    <option>2-3 integrantes</option>
                    <option>4-5 integrantes</option>
                    <option>6+ integrantes</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Lista de Equipos -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Equipo 1 -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="flex items-start justify-between mb-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <h3 class="text-xl font-bold text-gray-900">Tech Innovators</h3>
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Activo</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Hackathon de Innovación 2024</p>
                    
                    <div class="flex items-center gap-4 mb-4">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span class="font-medium">5 integrantes</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="font-medium">2 proyectos</span>
                        </div>
                    </div>

                    <!-- Miembros -->
                    <div class="flex -space-x-2 mb-4">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm border-2 border-white shadow">
                            JD
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-teal-600 flex items-center justify-center text-white font-bold text-sm border-2 border-white shadow">
                            MR
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center text-white font-bold text-sm border-2 border-white shadow">
                            LG
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center text-white font-bold text-sm border-2 border-white shadow">
                            SP
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold text-xs border-2 border-white shadow">
                            +1
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    Ver Detalles
                </button>
                <button class="flex-1 px-4 py-2.5 text-sm font-medium text-blue-700 hover:bg-blue-50 rounded-lg transition-colors">
                    Editar
                </button>
            </div>
        </div>

        <!-- Equipo 2 -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="flex items-start justify-between mb-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <h3 class="text-xl font-bold text-gray-900">Code Masters</h3>
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Activo</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Hackathon de Innovación 2024</p>
                    
                    <div class="flex items-center gap-4 mb-4">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span class="font-medium">4 integrantes</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="font-medium">1 proyecto</span>
                        </div>
                    </div>

                    <!-- Miembros -->
                    <div class="flex -space-x-2 mb-4">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-white font-bold text-sm border-2 border-white shadow">
                            AF
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-pink-500 to-rose-600 flex items-center justify-center text-white font-bold text-sm border-2 border-white shadow">
                            KL
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-white font-bold text-sm border-2 border-white shadow">
                            RH
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-lime-500 to-green-600 flex items-center justify-center text-white font-bold text-sm border-2 border-white shadow">
                            EM
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    Ver Detalles
                </button>
                <button class="flex-1 px-4 py-2.5 text-sm font-medium text-blue-700 hover:bg-blue-50 rounded-lg transition-colors">
                    Editar
                </button>
            </div>
        </div>

        <!-- Equipo 3 -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="flex items-start justify-between mb-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <h3 class="text-xl font-bold text-gray-900">Science Explorers</h3>
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Activo</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Feria de Ciencias 2024</p>
                    
                    <div class="flex items-center gap-4 mb-4">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span class="font-medium">3 integrantes</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="font-medium">1 proyecto</span>
                        </div>
                    </div>

                    <!-- Miembros -->
                    <div class="flex -space-x-2 mb-4">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm border-2 border-white shadow">
                            NP
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-red-500 to-pink-600 flex items-center justify-center text-white font-bold text-sm border-2 border-white shadow">
                            VT
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-teal-500 to-cyan-600 flex items-center justify-center text-white font-bold text-sm border-2 border-white shadow">
                            HC
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    Ver Detalles
                </button>
                <button class="flex-1 px-4 py-2.5 text-sm font-medium text-blue-700 hover:bg-blue-50 rounded-lg transition-colors">
                    Editar
                </button>
            </div>
        </div>

        <!-- Equipo 4 -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="flex items-start justify-between mb-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <h3 class="text-xl font-bold text-gray-900">Robot Warriors</h3>
                        <span class="px-3 py-1 bg-gray-200 text-gray-700 text-xs font-semibold rounded-full">Inactivo</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Concurso de Robótica</p>
                    
                    <div class="flex items-center gap-4 mb-4">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span class="font-medium">4 integrantes</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="font-medium">1 proyecto</span>
                        </div>
                    </div>

                    <!-- Miembros -->
                    <div class="flex -space-x-2 mb-4">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm border-2 border-white shadow">
                            DM
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white font-bold text-sm border-2 border-white shadow">
                            SC
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-yellow-500 to-orange-600 flex items-center justify-center text-white font-bold text-sm border-2 border-white shadow">
                            TB
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-fuchsia-500 to-pink-600 flex items-center justify-center text-white font-bold text-sm border-2 border-white shadow">
                            GW
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    Ver Detalles
                </button>
                <button class="flex-1 px-4 py-2.5 text-sm font-medium text-blue-700 hover:bg-blue-50 rounded-lg transition-colors">
                    Editar
                </button>
            </div>
        </div>
    </div>

    <!-- Paginación -->
    <div class="flex items-center justify-between mt-8">
        <p class="text-sm text-gray-600">Mostrando 1-4 de 50 equipos</p>
        <div class="flex items-center gap-2">
            <button class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                Anterior
            </button>
            <button class="px-4 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg">
                1
            </button>
            <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                2
            </button>
            <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                3
            </button>
            <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                Siguiente
            </button>
        </div>
    </div>
</div>
@endsection
