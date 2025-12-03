@extends('layouts.dashboard')

@section('title', 'Proyectos - Asesor')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Proyectos</h1>
            <p class="text-gray-600 mt-1">Gestiona y supervisa los proyectos de tus equipos</p>
        </div>
        <button onclick="mostrarModalCrearProyecto()" class="flex items-center gap-2 px-6 py-3 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition-colors font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nuevo Proyecto
        </button>
    </div>

    <!-- Filtros y búsqueda -->
    <div class="bg-white rounded-2xl p-6 shadow-sm mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" placeholder="Buscar proyectos..." 
                           class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <select class="px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option>Todos los estados</option>
                <option>En progreso</option>
                <option>Completado</option>
                <option>Pendiente</option>
            </select>
            <select class="px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option>Todos los equipos</option>
                <option>Tech Innovators</option>
                <option>Green Solutions</option>
            </select>
        </div>
    </div>

    <!-- Tabs -->
    <div class="flex gap-4 mb-6 border-b border-gray-200">
        <button class="px-4 py-3 font-semibold text-gray-900 border-b-2 border-gray-900">
            Todos (3)
        </button>
        <button class="px-4 py-3 font-medium text-gray-600 hover:text-gray-900">
            En Progreso (2)
        </button>
        <button class="px-4 py-3 font-medium text-gray-600 hover:text-gray-900">
            Completados (1)
        </button>
    </div>

    <!-- Lista de Proyectos -->
    <div class="grid grid-cols-1 gap-6">
        <!-- Proyecto 1 -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-all overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-xl font-bold text-gray-800">EcoTrack - Monitoreo Ambiental Inteligente</h3>
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">En Progreso</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-3">Sistema IoT para monitorear calidad del aire y agua en tiempo real con análisis predictivo mediante IA.</p>
                        
                        <div class="flex items-center gap-4 text-sm text-gray-500">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Tech Innovators
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Iniciado: 15 Mar 2024
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                Hackathon 2024
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium">
                            Ver detalles
                        </button>
                        <button class="p-2 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Progreso -->
                <div class="mb-4">
                    <div class="flex items-center justify-between text-sm mb-2">
                        <span class="text-gray-600 font-medium">Progreso del proyecto</span>
                        <span class="text-gray-800 font-semibold">75%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
                    </div>
                </div>

                <!-- Tags de tecnologías -->
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-blue-50 text-blue-700 text-xs font-medium rounded-full">IoT</span>
                    <span class="px-3 py-1 bg-purple-50 text-purple-700 text-xs font-medium rounded-full">Machine Learning</span>
                    <span class="px-3 py-1 bg-green-50 text-green-700 text-xs font-medium rounded-full">Sustentabilidad</span>
                    <span class="px-3 py-1 bg-orange-50 text-orange-700 text-xs font-medium rounded-full">Python</span>
                </div>
            </div>
        </div>

        <!-- Proyecto 2 -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-all overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-xl font-bold text-gray-800">SmartBot - Robot Asistente Educativo</h3>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">En Progreso</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-3">Robot educativo con IA que ayuda a estudiantes en tareas de matemáticas y ciencias mediante visión computacional.</p>
                        
                        <div class="flex items-center gap-4 text-sm text-gray-500">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Green Solutions
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Iniciado: 1 Abr 2024
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                Feria de Ciencias 2024
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium">
                            Ver detalles
                        </button>
                        <button class="p-2 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Progreso -->
                <div class="mb-4">
                    <div class="flex items-center justify-between text-sm mb-2">
                        <span class="text-gray-600 font-medium">Progreso del proyecto</span>
                        <span class="text-gray-800 font-semibold">45%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-yellow-500 h-2 rounded-full" style="width: 45%"></div>
                    </div>
                </div>

                <!-- Tags de tecnologías -->
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-purple-50 text-purple-700 text-xs font-medium rounded-full">Robótica</span>
                    <span class="px-3 py-1 bg-blue-50 text-blue-700 text-xs font-medium rounded-full">Computer Vision</span>
                    <span class="px-3 py-1 bg-pink-50 text-pink-700 text-xs font-medium rounded-full">Educación</span>
                    <span class="px-3 py-1 bg-orange-50 text-orange-700 text-xs font-medium rounded-full">Arduino</span>
                </div>
            </div>
        </div>

        <!-- Proyecto 3 - Completado -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-all overflow-hidden opacity-75">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-xl font-bold text-gray-800">AutoNav - Navegación Autónoma</h3>
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full">Completado</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-3">Sistema de navegación autónoma para robot seguidor de línea con detección de obstáculos.</p>
                        
                        <div class="flex items-center gap-4 text-sm text-gray-500">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Tech Innovators
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Completado: 28 Feb 2024
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                Concurso de Robótica
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium">
                            Ver detalles
                        </button>
                        <button class="p-2 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Progreso -->
                <div class="mb-4">
                    <div class="flex items-center justify-between text-sm mb-2">
                        <span class="text-gray-600 font-medium">Progreso del proyecto</span>
                        <span class="text-gray-800 font-semibold">100%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full" style="width: 100%"></div>
                    </div>
                </div>

                <!-- Tags de tecnologías -->
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-purple-50 text-purple-700 text-xs font-medium rounded-full">Robótica</span>
                    <span class="px-3 py-1 bg-blue-50 text-blue-700 text-xs font-medium rounded-full">Sensores</span>
                    <span class="px-3 py-1 bg-green-50 text-green-700 text-xs font-medium rounded-full">C++</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Proyecto -->
<div id="modalCrearProyecto" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-8 max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Crear Nuevo Proyecto</h2>
            <button onclick="cerrarModalCrearProyecto()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <form>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del Proyecto *</label>
                    <input type="text" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ej: Sistema de Monitoreo Inteligente">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Equipo *</label>
                        <select class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option>Selecciona un equipo</option>
                            <option>Tech Innovators</option>
                            <option>Green Solutions</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Evento *</label>
                        <select class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option>Selecciona un evento</option>
                            <option>Hackathon 2024</option>
                            <option>Feria de Ciencias</option>
                        </select>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Descripción *</label>
                    <textarea class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" placeholder="Describe el proyecto..."></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tecnologías (separa con comas)</label>
                    <input type="text" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ej: IoT, Python, Machine Learning">
                </div>
            </div>
            
            <div class="flex gap-3 mt-6">
                <button type="button" onclick="cerrarModalCrearProyecto()" class="flex-1 px-6 py-3 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors font-medium">
                    Cancelar
                </button>
                <button type="submit" class="flex-1 px-6 py-3 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition-colors font-medium">
                    Crear Proyecto
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function mostrarModalCrearProyecto() {
        document.getElementById('modalCrearProyecto').classList.remove('hidden');
        document.getElementById('modalCrearProyecto').classList.add('flex');
    }

    function cerrarModalCrearProyecto() {
        document.getElementById('modalCrearProyecto').classList.add('hidden');
        document.getElementById('modalCrearProyecto').classList.remove('flex');
    }
</script>
@endsection
