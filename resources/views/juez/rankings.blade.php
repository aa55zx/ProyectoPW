@extends('layouts.juez')

@section('title', 'Rankings - EvenTec')
@section('breadcrumb', 'Rankings')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Encabezado -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Rankings de Proyectos</h1>
        <p class="text-gray-600 mt-2 text-lg">Visualiza los mejores proyectos basados en las evaluaciones.</p>
    </div>

    <!-- Filtro de Evento -->
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-8 border border-gray-100">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-2">Seleccionar Evento</label>
                <select class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option>Hackathon Innovación 2024</option>
                    <option>Concurso de Robótica</option>
                    <option>Expo Emprendedores</option>
                    <option>Feria de Ciencias 2024</option>
                </select>
            </div>
            <div class="w-full md:w-48">
                <label class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                <select class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option>Todas</option>
                    <option>Tecnología</option>
                    <option>Ciencias</option>
                    <option>Negocios</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Top 3 Podio -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Segundo Lugar -->
        <div class="order-2 md:order-1">
            <div class="bg-gradient-to-br from-gray-400 to-gray-500 rounded-t-2xl p-6 text-white text-center">
                <div class="w-20 h-20 mx-auto mb-3 bg-white rounded-full flex items-center justify-center">
                    <span class="text-4xl">🥈</span>
                </div>
                <p class="text-sm font-medium mb-1">2do Lugar</p>
                <p class="text-3xl font-bold">88.5</p>
            </div>
            <div class="bg-white rounded-b-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-2">SmartFarm AI</h3>
                <p class="text-sm text-gray-600 mb-4">AgroTech Solutions</p>
                <div class="grid grid-cols-2 gap-3 text-xs">
                    <div class="bg-gray-50 p-2 rounded-lg text-center">
                        <p class="text-gray-600">Innovación</p>
                        <p class="font-bold text-gray-900">85</p>
                    </div>
                    <div class="bg-gray-50 p-2 rounded-lg text-center">
                        <p class="text-gray-600">Viabilidad</p>
                        <p class="font-bold text-gray-900">90</p>
                    </div>
                    <div class="bg-gray-50 p-2 rounded-lg text-center">
                        <p class="text-gray-600">Presentación</p>
                        <p class="font-bold text-gray-900">88</p>
                    </div>
                    <div class="bg-gray-50 p-2 rounded-lg text-center">
                        <p class="text-gray-600">Impacto</p>
                        <p class="font-bold text-gray-900">91</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Primer Lugar -->
        <div class="order-1 md:order-2">
            <div class="bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-t-2xl p-6 text-white text-center">
                <div class="w-24 h-24 mx-auto mb-3 bg-white rounded-full flex items-center justify-center">
                    <span class="text-5xl">🥇</span>
                </div>
                <p class="text-sm font-medium mb-1">1er Lugar</p>
                <p class="text-4xl font-bold">92.0</p>
            </div>
            <div class="bg-white rounded-b-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-2">HealthAI Pro</h3>
                <p class="text-sm text-gray-600 mb-4">MedTech Innovators</p>
                <div class="grid grid-cols-2 gap-3 text-xs">
                    <div class="bg-gray-50 p-2 rounded-lg text-center">
                        <p class="text-gray-600">Innovación</p>
                        <p class="font-bold text-gray-900">95</p>
                    </div>
                    <div class="bg-gray-50 p-2 rounded-lg text-center">
                        <p class="text-gray-600">Viabilidad</p>
                        <p class="font-bold text-gray-900">90</p>
                    </div>
                    <div class="bg-gray-50 p-2 rounded-lg text-center">
                        <p class="text-gray-600">Presentación</p>
                        <p class="font-bold text-gray-900">88</p>
                    </div>
                    <div class="bg-gray-50 p-2 rounded-lg text-center">
                        <p class="text-gray-600">Impacto</p>
                        <p class="font-bold text-gray-900">95</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tercer Lugar -->
        <div class="order-3">
            <div class="bg-gradient-to-br from-orange-400 to-orange-500 rounded-t-2xl p-6 text-white text-center">
                <div class="w-20 h-20 mx-auto mb-3 bg-white rounded-full flex items-center justify-center">
                    <span class="text-4xl">🥉</span>
                </div>
                <p class="text-sm font-medium mb-1">3er Lugar</p>
                <p class="text-3xl font-bold">85.2</p>
            </div>
            <div class="bg-white rounded-b-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-2">EcoTrack</h3>
                <p class="text-sm text-gray-600 mb-4">Tech Innovators</p>
                <div class="grid grid-cols-2 gap-3 text-xs">
                    <div class="bg-gray-50 p-2 rounded-lg text-center">
                        <p class="text-gray-600">Innovación</p>
                        <p class="font-bold text-gray-900">85</p>
                    </div>
                    <div class="bg-gray-50 p-2 rounded-lg text-center">
                        <p class="text-gray-600">Viabilidad</p>
                        <p class="font-bold text-gray-900">88</p>
                    </div>
                    <div class="bg-gray-50 p-2 rounded-lg text-center">
                        <p class="text-gray-600">Presentación</p>
                        <p class="font-bold text-gray-900">82</p>
                    </div>
                    <div class="bg-gray-50 p-2 rounded-lg text-center">
                        <p class="text-gray-600">Impacto</p>
                        <p class="font-bold text-gray-900">86</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla Completa de Rankings -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-2xl font-bold text-gray-900">Clasificación Completa</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Posición</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Proyecto</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Equipo</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Innovación</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Viabilidad</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Presentación</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Impacto</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <span class="flex items-center justify-center w-8 h-8 bg-yellow-100 text-yellow-700 rounded-full font-bold text-sm">1</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-900">HealthAI Pro</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-600">MedTech Innovators</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-gray-900">95</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-gray-900">90</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-gray-900">88</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-gray-900">95</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full font-bold text-sm">92.0</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <span class="flex items-center justify-center w-8 h-8 bg-gray-100 text-gray-700 rounded-full font-bold text-sm">2</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-900">SmartFarm AI</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-600">AgroTech Solutions</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-gray-900">85</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-gray-900">90</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-gray-900">88</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-gray-900">91</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full font-bold text-sm">88.5</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <span class="flex items-center justify-center w-8 h-8 bg-orange-100 text-orange-700 rounded-full font-bold text-sm">3</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-900">EcoTrack</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-600">Tech Innovators</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-gray-900">85</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-gray-900">88</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-gray-900">82</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-gray-900">86</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full font-bold text-sm">85.2</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="flex items-center justify-center w-8 h-8 bg-gray-50 text-gray-700 rounded-full font-bold text-sm">4</span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-900">AI Learning Platform</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-600">EduTech Masters</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-gray-900">82</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-gray-900">85</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-gray-900">83</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-gray-900">84</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full font-bold text-sm">83.5</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="flex items-center justify-center w-8 h-8 bg-gray-50 text-gray-700 rounded-full font-bold text-sm">5</span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-900">Smart City Hub</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-600">Urban Innovators</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-gray-900">80</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-gray-900">82</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-gray-900">81</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-gray-900">83</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full font-bold text-sm">81.5</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
