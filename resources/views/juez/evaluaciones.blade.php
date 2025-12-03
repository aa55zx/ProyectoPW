@extends('layouts.juez')

@section('title', 'Evaluaciones - EvenTec')
@section('breadcrumb', 'Evaluaciones')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Encabezadoaaa -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Mis Evaluaciones</h1>
        <p class="text-gray-600 mt-2 text-lg">Revisa y gestiona todas las evaluaciones realizadas.</p>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-indigo-100 text-sm font-medium mb-1">Pendientes</p>
                    <p class="text-4xl font-bold">1</p>
                </div>
                <div class="bg-white/20 p-3 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium mb-1">Completadas</p>
                    <p class="text-4xl font-bold">18</p>
                </div>
                <div class="bg-white/20 p-3 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium mb-1">Promedio</p>
                    <p class="text-4xl font-bold">85.2%</p>
                </div>
                <div class="bg-white/20 p-3 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-6">
        <div class="border-b border-gray-200">
            <nav class="flex -mb-px">
                <button class="px-8 py-4 text-sm font-semibold text-indigo-600 border-b-2 border-indigo-600">
                    Pendientes
                </button>
                <button class="px-8 py-4 text-sm font-semibold text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300">
                    Completadas
                </button>
                <button class="px-8 py-4 text-sm font-semibold text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300">
                    Todas
                </button>
            </nav>
        </div>
    </div>

    <!-- Lista de Evaluaciones -->
    <div class="space-y-6">
        <!-- Evaluación Pendiente -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-xl font-bold text-gray-900">EcoTrack - Monitoreo Ambiental Inteligente</h3>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">Pendiente</span>
                        </div>
                        <p class="text-sm text-gray-600 mb-1">
                            <span class="font-medium">Equipo:</span> Tech Innovators
                        </p>
                        <p class="text-sm text-gray-600">
                            <span class="font-medium">Evento:</span> Hackathon Innovación 2024
                        </p>
                    </div>
                    <a href="{{ route('juez.evaluar-proyecto', 1) }}" 
                       class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-md hover:shadow-lg">
                        Evaluar ahora
                    </a>
                </div>

                <div class="flex items-center gap-6 text-sm text-gray-600 border-t border-gray-100 pt-4 mt-4">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Fecha límite: <span class="font-semibold text-gray-900">16 Abr 2024</span></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Tiempo estimado: <span class="font-semibold text-gray-900">30 min</span></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Evaluación Completada 1 -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-xl font-bold text-gray-900">SmartFarm - Agricultura Automatizada</h3>
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Completada</span>
                        </div>
                        <p class="text-sm text-gray-600 mb-1">
                            <span class="font-medium">Equipo:</span> AgroTech Solutions
                        </p>
                        <p class="text-sm text-gray-600">
                            <span class="font-medium">Evento:</span> Concurso de Robótica
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 mb-1">Calificación</p>
                        <p class="text-3xl font-bold text-green-600">88/100</p>
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div class="text-center p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs text-gray-600 mb-1">Innovación</p>
                        <p class="text-lg font-bold text-gray-900">85</p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs text-gray-600 mb-1">Viabilidad</p>
                        <p class="text-lg font-bold text-gray-900">90</p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs text-gray-600 mb-1">Presentación</p>
                        <p class="text-lg font-bold text-gray-900">88</p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs text-gray-600 mb-1">Impacto</p>
                        <p class="text-lg font-bold text-gray-900">90</p>
                    </div>
                </div>

                <div class="flex items-center gap-6 text-sm text-gray-600 border-t border-gray-100 pt-4 mt-4">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Evaluada el: <span class="font-semibold text-gray-900">10 Abr 2024</span></span>
                    </div>
                    <button class="ml-auto text-indigo-600 hover:text-indigo-700 font-medium flex items-center gap-2">
                        Ver detalles
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Evaluación Completada 2 -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-xl font-bold text-gray-900">HealthAI - Diagnóstico Inteligente</h3>
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Completada</span>
                        </div>
                        <p class="text-sm text-gray-600 mb-1">
                            <span class="font-medium">Equipo:</span> MedTech Innovators
                        </p>
                        <p class="text-sm text-gray-600">
                            <span class="font-medium">Evento:</span> Hackathon Innovación 2024
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 mb-1">Calificación</p>
                        <p class="text-3xl font-bold text-green-600">92/100</p>
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div class="text-center p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs text-gray-600 mb-1">Innovación</p>
                        <p class="text-lg font-bold text-gray-900">95</p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs text-gray-600 mb-1">Viabilidad</p>
                        <p class="text-lg font-bold text-gray-900">90</p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs text-gray-600 mb-1">Presentación</p>
                        <p class="text-lg font-bold text-gray-900">88</p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs text-gray-600 mb-1">Impacto</p>
                        <p class="text-lg font-bold text-gray-900">95</p>
                    </div>
                </div>

                <div class="flex items-center gap-6 text-sm text-gray-600 border-t border-gray-100 pt-4 mt-4">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Evaluada el: <span class="font-semibold text-gray-900">15 Abr 2024</span></span>
                    </div>
                    <button class="ml-auto text-indigo-600 hover:text-indigo-700 font-medium flex items-center gap-2">
                        Ver detalles
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
