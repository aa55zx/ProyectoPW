@extends('layouts.asesor-dashboard')

@section('title', 'Rankings - Asesor')

@section('content')
<div class="p-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-2" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1">
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm font-medium text-gray-800">Rankings</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Rankings</h1>
            <p class="text-gray-600 mt-1">Clasificaciones y resultados de eventos</p>
        </div>
        <button class="flex items-center gap-2 px-6 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Exportar Resultados
        </button>
    </div>

    <!-- Selector de evento y búsqueda -->
    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200 mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <select class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black bg-white">
                    <option>Concurso de Robótica</option>
                    <option>Hackathon de Innovación 2024</option>
                    <option>Feria de Ciencias 2024</option>
                    <option>Startup Challenge</option>
                </select>
            </div>
            <div class="flex-1">
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" placeholder="Buscar equipo o proyecto..." 
                           class="w-full pl-12 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black">
                </div>
            </div>
        </div>
    </div>

    <!-- Podio de los 3 primeros lugares -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- 2do Lugar -->
        <div class="order-2 md:order-1 bg-white rounded-2xl p-6 shadow-sm border-2 border-gray-300">
            <div class="flex justify-center mb-4">
                <div class="relative">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center">
                        <span class="text-3xl font-bold text-gray-600">R</span>
                    </div>
                    <div class="absolute -top-2 -right-2 w-10 h-10 bg-gray-400 rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                        <span class="text-white font-bold text-sm">2</span>
                    </div>
                </div>
            </div>
            <div class="text-center mb-4">
                <div class="flex items-center justify-center gap-2 mb-2">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-1">RoboMasters</h3>
                <p class="text-sm text-gray-600 mb-3">AutoNav - Navegación Autónoma</p>
                <div class="flex items-center justify-center gap-2 text-3xl font-bold text-gray-900 mb-2">
                    88
                    <span class="text-sm text-gray-500 font-normal">puntos</span>
                </div>
                <div class="inline-flex items-center gap-1 px-3 py-1 bg-gray-200 text-gray-700 rounded text-sm font-semibold">
                    $10,000 MXN
                </div>
            </div>
        </div>

        <!-- 1er Lugar -->
        <div class="order-1 md:order-2 bg-gradient-to-br from-yellow-50 to-amber-100 rounded-2xl p-6 shadow-lg border-2 border-yellow-400 transform md:scale-105">
            <div class="flex justify-center mb-4">
                <div class="relative">
                    <div class="w-28 h-28 bg-yellow-200 rounded-full flex items-center justify-center">
                        <span class="text-4xl font-bold text-yellow-700">TI</span>
                    </div>
                    <div class="absolute -top-2 -right-2 w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="text-center mb-4">
                <div class="flex items-center justify-center gap-2 mb-2">
                    <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">Tech Innovators</h3>
                <p class="text-sm text-gray-700 mb-3">EcoTrack - Monitoreo Ambiental Inteligente</p>
                <div class="flex items-center justify-center gap-2 text-4xl font-bold text-yellow-700 mb-2">
                    92.5
                    <span class="text-sm text-gray-600 font-normal">puntos</span>
                </div>
                <div class="inline-flex items-center gap-1 px-4 py-2 bg-yellow-500 text-white rounded text-base font-bold shadow-md">
                    $20,000 MXN
                </div>
            </div>
        </div>

        <!-- 3er Lugar -->
        <div class="order-3 bg-white rounded-2xl p-6 shadow-sm border-2 border-orange-300">
            <div class="flex justify-center mb-4">
                <div class="relative">
                    <div class="w-24 h-24 bg-orange-200 rounded-full flex items-center justify-center">
                        <span class="text-3xl font-bold text-orange-600">CB</span>
                    </div>
                    <div class="absolute -top-2 -right-2 w-10 h-10 bg-orange-400 rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                        <span class="text-white font-bold text-sm">3</span>
                    </div>
                </div>
            </div>
            <div class="text-center mb-4">
                <div class="flex items-center justify-center gap-2 mb-2">
                    <svg class="w-6 h-6 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-1">Circuit Breakers</h3>
                <p class="text-sm text-gray-600 mb-3">SmartBot - Robot Asistente</p>
                <div class="flex items-center justify-center gap-2 text-3xl font-bold text-gray-900 mb-2">
                    85.5
                    <span class="text-sm text-gray-500 font-normal">puntos</span>
                </div>
                <div class="inline-flex items-center gap-1 px-3 py-1 bg-orange-200 text-orange-700 rounded text-sm font-semibold">
                    $5,000 MXN
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Clasificación Completa -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-8">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">Tabla de Clasificación Completa</h2>
            <p class="text-sm text-gray-600 mt-1">5 equipos participantes en Concurso de Robótica</p>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Posición</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Equipo</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Proyecto</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Puntuación</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Premio</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- 1er Lugar -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-yellow-100 text-yellow-700 rounded-full font-bold text-sm flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-900">TI</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-900">Tech Innovators</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-gray-900">EcoTrack - Monitoreo Ambiental Inteligente</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-lg font-bold text-yellow-600">92.5</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-semibold text-gray-900">$20,000 MXN</span>
                        </td>
                        <td class="px-6 py-4">
                            <button class="text-sm text-gray-900 hover:underline font-medium">Ver Detalles</button>
                        </td>
                    </tr>

                    <!-- Más filas... -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="text-gray-600 font-medium">#4</span>
                                <span class="text-sm font-medium text-gray-900">M</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-900">Mechatronics</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-600">CleanBot - Limpieza Automatizada</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-lg font-bold text-gray-900">82</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-500">-</span>
                        </td>
                        <td class="px-6 py-4">
                            <button class="text-sm text-gray-900 hover:underline font-medium">Ver Detalles</button>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="text-gray-600 font-medium">#5</span>
                                <span class="text-sm font-medium text-gray-900">FE</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-900">Future Engineers</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-600">AgroBot - Agricultura Inteligente</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-lg font-bold text-gray-900">79.5</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-500">-</span>
                        </td>
                        <td class="px-6 py-4">
                            <button class="text-sm text-gray-900 hover:underline font-medium">Ver Detalles</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Estadísticas del Evento -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-3xl font-bold text-gray-900">5</p>
                    <p class="text-sm text-gray-600">Equipos</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
                <div>
                    <p class="text-3xl font-bold text-gray-900">85.5</p>
                    <p class="text-sm text-gray-600">Promedio</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-3xl font-bold text-gray-900">92.5</p>
                    <p class="text-sm text-gray-600">Máximo</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-3xl font-bold text-gray-900">4</p>
                    <p class="text-sm text-gray-600">Criterios</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
