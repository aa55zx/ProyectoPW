@extends('layouts.dashboard')

@section('title', 'Rankings - Asesor')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Rankings</h1>
            <p class="text-gray-600 mt-1">Clasificaciones y resultados de eventos</p>
        </div>
        <button class="flex items-center gap-2 px-6 py-3 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Exportar Resultados
        </button>
    </div>

    <!-- Selector de evento y búsqueda -->
    <div class="bg-white rounded-2xl p-6 shadow-sm mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <select class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
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
                           class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
        </div>
    </div>

    <!-- Podio de los 3 primeros lugares -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- 2do Lugar -->
        <div class="order-2 md:order-1 bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 shadow-sm border-2 border-gray-200">
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
                <h3 class="text-xl font-bold text-gray-800 mb-1">RoboMasters</h3>
                <p class="text-sm text-gray-600 mb-3">AutoNav - Navegación Autónoma</p>
                <div class="flex items-center justify-center gap-2 text-3xl font-bold text-gray-800 mb-2">
                    88
                    <span class="text-sm text-gray-500 font-normal">puntos</span>
                </div>
                <div class="inline-flex items-center gap-1 px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm font-semibold">
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
                <h3 class="text-2xl font-bold text-gray-800 mb-1">Tech Innovators</h3>
                <p class="text-sm text-gray-700 mb-3">EcoTrack - Monitoreo Ambiental Inteligente</p>
                <div class="flex items-center justify-center gap-2 text-4xl font-bold text-yellow-700 mb-2">
                    92.5
                    <span class="text-sm text-gray-600 font-normal">puntos</span>
                </div>
                <div class="inline-flex items-center gap-1 px-4 py-2 bg-yellow-500 text-white rounded-full text-base font-bold shadow-md">
                    $20,000 MXN
                </div>
            </div>
        </div>

        <!-- 3er Lugar -->
        <div class="order-3 bg-gradient-to-br from-orange-50 to-amber-50 rounded-2xl p-6 shadow-sm border-2 border-orange-200">
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
                <h3 class="text-xl font-bold text-gray-800 mb-1">Circuit Breakers</h3>
                <p class="text-sm text-gray-600 mb-3">SmartBot - Robot Asistente</p>
                <div class="flex items-center justify-center gap-2 text-3xl font-bold text-gray-800 mb-2">
                    85.5
                    <span class="text-sm text-gray-500 font-normal">puntos</span>
                </div>
                <div class="inline-flex items-center gap-1 px-3 py-1 bg-orange-200 text-orange-700 rounded-full text-sm font-semibold">
                    $5,000 MXN
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Clasificación Completa -->
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Tabla de Clasificación Completa</h2>
            <p class="text-sm text-gray-600 mt-1">5 equipos participantes en Concurso de Robótica</p>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Posición</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Equipo</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Proyecto</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Puntuación</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Premio</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- 1er Lugar -->
                    <tr class="hover:bg-yellow-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="flex items-center justify-center w-8 h-8 bg-yellow-100 text-yellow-700 rounded-full font-bold text-sm">1</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-yellow-200 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-bold text-yellow-700">TI</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">Tech Innovators</p>
                                    <p class="text-xs text-gray-500">3 integrantes</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-gray-800">EcoTrack</p>
                            <p class="text-xs text-gray-500">Monitoreo Ambiental</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-lg font-bold text-gray-800">92.5</span>
                            <span class="text-xs text-gray-500">pts</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">
                                $20,000 MXN
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                                Finalizado
                            </span>
                        </td>
                    </tr>

                    <!-- 2do Lugar -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="flex items-center justify-center w-8 h-8 bg-gray-100 text-gray-700 rounded-full font-bold text-sm">2</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-bold text-gray-700">R</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">RoboMasters</p>
                                    <p class="text-xs text-gray-500">4 integrantes</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-gray-800">AutoNav</p>
                            <p class="text-xs text-gray-500">Navegación Autónoma</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-lg font-bold text-gray-800">88</span>
                            <span class="text-xs text-gray-500">pts</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full">
                                $10,000 MXN
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                                Finalizado
                            </span>
                        </td>
                    </tr>

                    <!-- 3er Lugar -->
                    <tr class="hover:bg-orange-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="flex items-center justify-center w-8 h-8 bg-orange-100 text-orange-700 rounded-full font-bold text-sm">3</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-orange-200 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-bold text-orange-700">CB</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">Circuit Breakers</p>
                                    <p class="text-xs text-gray-500">3 integrantes</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-gray-800">SmartBot</p>
                            <p class="text-xs text-gray-500">Robot Asistente</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-lg font-bold text-gray-800">85.5</span>
                            <span class="text-xs text-gray-500">pts</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-orange-100 text-orange-700 text-xs font-semibold rounded-full">
                                $5,000 MXN
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                                Finalizado
                            </span>
                        </td>
                    </tr>

                    <!-- 4to Lugar -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="text-gray-600 font-medium">4</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-blue-200 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-bold text-blue-700">BS</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">Byte Squad</p>
                                    <p class="text-xs text-gray-500">3 integrantes</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-gray-800">LineFollower Pro</p>
                            <p class="text-xs text-gray-500">Seguidor de línea</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-lg font-bold text-gray-800">78</span>
                            <span class="text-xs text-gray-500">pts</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-gray-500 text-sm">-</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                                Finalizado
                            </span>
                        </td>
                    </tr>

                    <!-- 5to Lugar -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="text-gray-600 font-medium">5</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-purple-200 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-bold text-purple-700">NX</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">NexGen</p>
                                    <p class="text-xs text-gray-500">4 integrantes</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-gray-800">RoboExplorer</p>
                            <p class="text-xs text-gray-500">Robot explorador</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-lg font-bold text-gray-800">72</span>
                            <span class="text-xs text-gray-500">pts</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-gray-500 text-sm">-</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                                Finalizado
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
