@extends('layouts.dashboard')

@section('title', 'Dashboard - Estudiante')

@section('content')
<div class="p-8">
    <!-- Encabezado de Bienvenida -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Bienvenido, {{ Auth::user()->name }}</h1>
        
        <!-- Tarjetas de Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Notificaciones -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-blue-50 rounded-xl">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-800">3</p>
                        <p class="text-sm text-gray-500">Notificaciones</p>
                        <p class="text-xs text-gray-400">Nuevas actualizaciones</p>
                    </div>
                </div>
            </div>
            
            <!-- Tareas -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-green-50 rounded-xl">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-800">2</p>
                        <p class="text-sm text-gray-500">Tareas</p>
                        <p class="text-xs text-gray-400">Completadas hoy</p>
                    </div>
                </div>
            </div>
            
            <!-- Próxima Entrega -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-orange-50 rounded-xl">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-800">5</p>
                        <p class="text-sm text-gray-500">Días</p>
                        <p class="text-xs text-gray-400">Próxima entrega</p>
                    </div>
                </div>
            </div>
            
            <!-- Calificación Promedio -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-yellow-50 rounded-xl">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-800">8.5</p>
                        <p class="text-sm text-gray-500">Calificación promedio</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Grid de Contenido Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Mi Equipo -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center gap-3 mb-4">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <h2 class="text-xl font-bold text-gray-800">Mi Equipo</h2>
            </div>
            <p class="text-sm text-gray-600 mb-4">Gestiona tu equipo y colabora con tus compañeros</p>
            
            <div class="bg-gray-50 rounded-xl p-4 mb-4">
                <div class="flex items-center justify-between mb-3">
                    <span class="px-3 py-1 bg-blue-900 text-white text-sm rounded-full">🖥️ Programador</span>
                    <span class="px-3 py-1 bg-green-100 text-green-700 text-xs rounded-full">Activo</span>
                </div>
                
                <p class="text-sm font-medium text-gray-700 mb-3">Miembros del equipo:</p>
                <div class="flex -space-x-2 mb-4">
                    <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-xs font-semibold border-2 border-white">JD</div>
                    <div class="w-8 h-8 rounded-full bg-purple-500 flex items-center justify-center text-white text-xs font-semibold border-2 border-white">AM</div>
                    <div class="w-8 h-8 rounded-full bg-pink-500 flex items-center justify-center text-white text-xs font-semibold border-2 border-white">LR</div>
                    <div class="w-8 h-8 rounded-full bg-orange-500 flex items-center justify-center text-white text-xs font-semibold border-2 border-white">+2</div>
                </div>
                
                <button class="w-full bg-black text-white py-3 rounded-lg font-medium hover:bg-gray-800 transition-colors flex items-center justify-center gap-2 mb-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Ver equipo completo
                </button>
                
                <button class="w-full bg-white text-gray-700 py-3 rounded-lg font-medium hover:bg-gray-50 transition-colors border border-gray-200 flex items-center justify-center gap-2 mb-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    Chat del equipo
                </button>
                
                <button class="w-full bg-white text-gray-700 py-3 rounded-lg font-medium hover:bg-gray-50 transition-colors border border-gray-200 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Unirse con código
                </button>
            </div>
        </div>
        
        <!-- Eventos -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center gap-3 mb-4">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <h2 class="text-xl font-bold text-gray-800">Eventos</h2>
            </div>
            <p class="text-sm text-gray-600 mb-4">Próximos eventos y fechas importantes</p>
            
            <!-- Evento 1 -->
            <div class="border-2 border-red-200 rounded-xl p-4 mb-3">
                <div class="flex items-start justify-between mb-2">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                        <h3 class="font-semibold text-gray-800">HackCatec 2025</h3>
                    </div>
                    <span class="px-2 py-1 bg-red-500 text-white text-xs rounded font-medium">Urgente</span>
                </div>
                <p class="text-sm text-gray-600 mb-1">Entrega final - 5 días</p>
            </div>
            
            <!-- Evento 2 -->
            <div class="border-2 border-blue-200 rounded-xl p-4 mb-4">
                <div class="flex items-start justify-between mb-2">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <h3 class="font-semibold text-gray-800">InovaTec</h3>
                    </div>
                    <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded font-medium">Próximo</span>
                </div>
                <p class="text-sm text-gray-600 mb-1">Registro abierto - 15 días</p>
            </div>
            
            <button class="w-full bg-black text-white py-3 rounded-lg font-medium hover:bg-gray-800 transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Ver calendario completo
            </button>
        </div>
        
        <!-- Mi Progreso -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center gap-3 mb-4">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                <h2 class="text-xl font-bold text-gray-800">Mi progreso</h2>
            </div>
            <p class="text-sm text-gray-600 mb-4">Mi rendimiento</p>
            
            <!-- Progreso General -->
            <div class="mb-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-gray-700">Progreso General</span>
                    <span class="text-sm font-bold text-blue-600">75%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-blue-600 h-3 rounded-full" style="width: 75%"></div>
                </div>
            </div>
            
            <!-- Tareas Completadas -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-gray-700">Tareas Completadas</span>
                    <span class="text-sm font-bold text-green-600">12/16</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-green-600 h-3 rounded-full" style="width: 75%"></div>
                </div>
            </div>
            
            <!-- Estadísticas -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="bg-blue-50 rounded-xl p-4 text-center">
                    <p class="text-3xl font-bold text-blue-600">8.5</p>
                    <p class="text-xs text-gray-600 mt-1">Promedio</p>
                </div>
                <div class="bg-green-50 rounded-xl p-4 text-center">
                    <p class="text-3xl font-bold text-green-600">3</p>
                    <p class="text-xs text-gray-600 mt-1">Proyectos</p>
                </div>
            </div>
            
            <button class="w-full bg-white text-gray-700 py-3 rounded-lg font-medium hover:bg-gray-50 transition-colors border border-gray-200 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Análisis Detallado
            </button>
        </div>
    </div>
    
    <!-- Actividad Reciente -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200 mt-6">
        <div class="flex items-center gap-3 mb-6">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
            </svg>
            <h2 class="text-xl font-bold text-gray-800">Actividad reciente</h2>
        </div>
        
        <div class="space-y-4">
            <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl">
                <svg class="w-5 h-5 text-green-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="flex-1">
                    <p class="font-medium text-gray-800">Tarea completada: Diseño de interfaz</p>
                    <p class="text-sm text-gray-500 mt-1">Hace 2 horas</p>
                </div>
            </div>
            
            <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl">
                <svg class="w-5 h-5 text-blue-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <div class="flex-1">
                    <p class="font-medium text-gray-800">Nuevo mensaje del profesor</p>
                    <p class="text-sm text-gray-500 mt-1">Hace 4 horas</p>
                </div>
            </div>
            
            <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl">
                <svg class="w-5 h-5 text-yellow-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
                <div class="flex-1">
                    <p class="font-medium text-gray-800">Calificación recibida: 90</p>
                    <p class="text-sm text-gray-500 mt-1">Hace 1 día</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection