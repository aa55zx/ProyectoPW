@extends('layouts.admin')

@section('title', 'Rankings')
@section('breadcrumb', 'Rankings')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Encabezado -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Rankings y Estadísticas</h1>
        <p class="text-gray-600 mt-2 text-lg">Visualiza el desempeño de equipos y participantes</p>
    </div>

    <!-- Filtros -->
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-8 border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Evento</label>
                <select class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
                    <option>Todos los eventos</option>
                    <option>Hackathon de Innovación 2024</option>
                    <option>Feria de Ciencias 2024</option>
                    <option>Concurso de Robótica</option>
                    <option>Expo Emprendedores</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                <select class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
                    <option>Todas</option>
                    <option>Tecnología</option>
                    <option>Ciencias</option>
                    <option>Negocios</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Período</label>
                <select class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
                    <option>Este mes</option>
                    <option>Últimos 3 meses</option>
                    <option>Este año</option>
                    <option>Todo el tiempo</option>
                </select>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Top 10 Equipos -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900">Top 10 Equipos</h2>
                    <p class="text-sm text-gray-600 mt-1">Basado en puntuación general</p>
                </div>

                <div class="divide-y divide-gray-100">
                    <!-- Posición 1 -->
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                1
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-3 mb-1">
                                    <h3 class="text-lg font-bold text-gray-900">Tech Innovators</h3>
                                    <span class="px-2 py-0.5 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded">🏆 1er Lugar</span>
                                </div>
                                <p class="text-sm text-gray-600">Hackathon de Innovación 2024</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-gray-900">95.5</p>
                                <p class="text-xs text-gray-500">puntos</p>
                            </div>
                        </div>
                    </div>

                    <!-- Posición 2 -->
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                2
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-3 mb-1">
                                    <h3 class="text-lg font-bold text-gray-900">Code Masters</h3>
                                    <span class="px-2 py-0.5 bg-gray-100 text-gray-700 text-xs font-semibold rounded">🥈 2do Lugar</span>
                                </div>
                                <p class="text-sm text-gray-600">Hackathon de Innovación 2024</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-gray-900">92.8</p>
                                <p class="text-xs text-gray-500">puntos</p>
                            </div>
                        </div>
                    </div>

                    <!-- Posición 3 -->
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-orange-400 to-orange-500 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                3
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-3 mb-1">
                                    <h3 class="text-lg font-bold text-gray-900">Science Explorers</h3>
                                    <span class="px-2 py-0.5 bg-orange-100 text-orange-700 text-xs font-semibold rounded">🥉 3er Lugar</span>
                                </div>
                                <p class="text-sm text-gray-600">Feria de Ciencias 2024</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-gray-900">89.2</p>
                                <p class="text-xs text-gray-500">puntos</p>
                            </div>
                        </div>
                    </div>

                    <!-- Posiciones 4-10 -->
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-gray-700 font-bold text-lg">
                                4
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">Robot Warriors</h3>
                                <p class="text-sm text-gray-600">Concurso de Robótica</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-gray-900">87.5</p>
                                <p class="text-xs text-gray-500">puntos</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-gray-700 font-bold text-lg">
                                5
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">Data Analytics Pro</h3>
                                <p class="text-sm text-gray-600">Hackathon de Innovación 2024</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-gray-900">85.3</p>
                                <p class="text-xs text-gray-500">puntos</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-gray-700 font-bold text-lg">
                                6
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">AI Pioneers</h3>
                                <p class="text-sm text-gray-600">Hackathon de Innovación 2024</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-gray-900">83.7</p>
                                <p class="text-xs text-gray-500">puntos</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-gray-700 font-bold text-lg">
                                7
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">Green Energy Team</h3>
                                <p class="text-sm text-gray-600">Feria de Ciencias 2024</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-gray-900">81.9</p>
                                <p class="text-xs text-gray-500">puntos</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-gray-700 font-bold text-lg">
                                8
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">Startup Legends</h3>
                                <p class="text-sm text-gray-600">Expo Emprendedores</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-gray-900">80.4</p>
                                <p class="text-xs text-gray-500">puntos</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-gray-700 font-bold text-lg">
                                9
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">Cyber Security Squad</h3>
                                <p class="text-sm text-gray-600">Hackathon de Innovación 2024</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-gray-900">78.6</p>
                                <p class="text-xs text-gray-500">puntos</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-gray-700 font-bold text-lg">
                                10
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">Cloud Architects</h3>
                                <p class="text-sm text-gray-600">Hackathon de Innovación 2024</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-gray-900">76.2</p>
                                <p class="text-xs text-gray-500">puntos</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 border-t border-gray-100">
                    <button class="w-full py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 rounded-xl transition-colors border border-gray-200">
                        Ver Ranking Completo
                    </button>
                </div>
            </div>
        </div>

        <!-- Panel Lateral -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Estadísticas Generales -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Estadísticas Generales</h2>
                
                <div class="space-y-4">
                    <div class="p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl border border-blue-200">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-sm font-medium text-blue-900">Puntuación Promedio</p>
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-blue-900">73.8</p>
                    </div>

                    <div class="p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-xl border border-green-200">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-sm font-medium text-green-900">Equipos Evaluados</p>
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-green-900">42</p>
                    </div>

                    <div class="p-4 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl border border-purple-200">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-sm font-medium text-purple-900">Proyectos Totales</p>
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-purple-900">93</p>
                    </div>

                    <div class="p-4 bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl border border-orange-200">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-sm font-medium text-orange-900">Mejor Puntuación</p>
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-orange-900">95.5</p>
                    </div>
                </div>
            </div>

            <!-- Rankings por Categoría -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Rankings por Categoría</h2>
                
                <div class="space-y-4">
                    <div class="p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors cursor-pointer">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-sm font-semibold text-gray-900">🏆 Tecnología</p>
                            <span class="text-xs text-gray-500">25 equipos</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors cursor-pointer">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-sm font-semibold text-gray-900">🔬 Ciencias</p>
                            <span class="text-xs text-gray-500">18 equipos</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-500 h-2 rounded-full" style="width: 72%"></div>
                        </div>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors cursor-pointer">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-sm font-semibold text-gray-900">💼 Negocios</p>
                            <span class="text-xs text-gray-500">15 equipos</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 60%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mejora del Mes -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm opacity-90">Mejora del Mes</p>
                        <p class="text-xl font-bold">Data Analytics Pro</p>
                    </div>
                </div>
                <p class="text-purple-100 text-sm">Aumentó su puntuación en 15.3 puntos este mes</p>
            </div>
        </div>
    </div>
</div>
@endsection
