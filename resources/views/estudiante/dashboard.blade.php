@extends('layouts.estudiante')

@section('title', 'Dashboard - EventTec')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Encabezado de Bienvenida -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">¡Hola, {{ explode(' ', auth()->user()->name)[0] }}!</h1>
        <p class="text-gray-600 mt-2 text-lg">Explora eventos, únete a equipos y compite por los primeros lugares.</p>
    </div>

    <!-- Tarjetas de Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Eventos Participados -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 mb-2">Eventos Participados</p>
                    <p class="text-4xl font-bold text-gray-900 mb-1">8</p>
                    <p class="text-sm text-green-600 font-medium">+12% vs mes anterior</p>
                </div>
                <div class="bg-blue-50 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Proyectos Enviados -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 mb-2">Proyectos Enviados</p>
                    <p class="text-4xl font-bold text-gray-900 mb-1">6</p>
                </div>
                <div class="bg-purple-50 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Promedio General -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 mb-2">Promedio General</p>
                    <p class="text-4xl font-bold text-gray-900 mb-1">87.5%</p>
                </div>
                <div class="bg-green-50 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Equipos -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 mb-2">Equipos</p>
                    <p class="text-4xl font-bold text-gray-900 mb-1">4</p>
                </div>
                <div class="bg-orange-50 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido Principal: Eventos Activos y Panel Lateral -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Eventos Activos (2/3 del ancho) -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Eventos Activos -->
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Eventos Activos</h2>
                
                <!-- Card del Evento Principal -->
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 border border-gray-100">
                    <div class="relative h-72">
                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&q=80" 
                             alt="Hackathon de Innovación 2024" 
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                        <div class="absolute top-5 left-5 flex gap-2">
                            <span class="px-4 py-1.5 bg-green-500 text-white text-xs font-semibold rounded-full shadow-lg">En curso</span>
                            <span class="px-4 py-1.5 bg-blue-600 text-white text-xs font-semibold rounded-full shadow-lg">Tecnología</span>
                        </div>
                    </div>
                    <div class="p-7">
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Hackathon de Innovación 2024</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">Desarrolla soluciones tecnológicas innovadoras para problemas reales en 48 horas. Este año el tema central es la sostenibilidad y el medio...</p>
                        
                        <div class="flex items-center gap-6 mb-6 text-sm text-gray-600">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="font-medium">14 abr</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span class="font-medium">24 equipos</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <span class="font-medium">3-5 integrantes</span>
                            </div>
                        </div>
                        
                        <button class="w-full bg-gray-900 hover:bg-gray-800 text-white font-semibold py-3.5 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 shadow-md hover:shadow-lg">
                            Ver detalles
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Próximos Eventos -->
            <div>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Próximos Eventos</h2>
                    <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold text-sm flex items-center gap-1 transition-colors">
                        Ver todos
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Evento 1: Feria de Ciencias -->
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 border border-gray-100">
                        <div class="relative h-52">
                            <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&q=80" 
                                 alt="Feria de Ciencias 2024" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                            <div class="absolute top-4 left-4 flex gap-2">
                                <span class="px-3 py-1 bg-blue-600 text-white text-xs font-semibold rounded-full shadow-md">Próximamente</span>
                                <span class="px-3 py-1 bg-purple-600 text-white text-xs font-semibold rounded-full shadow-md">Ciencias</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Feria de Ciencias 2024</h3>
                            <p class="text-sm text-gray-600 mb-5 leading-relaxed">Presenta tu proyecto de investigación científica ante expertos del área. Categorías: Biología, Química, Física y Matemáticas.</p>
                            
                            <div class="flex items-center gap-4 mb-5 text-xs text-gray-500">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="font-medium">19 may</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <span class="font-medium">18 equipos</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    <span class="font-medium">2-4 integrantes</span>
                                </div>
                            </div>
                            
                            <button class="w-full bg-gray-900 hover:bg-gray-800 text-white font-semibold py-3 px-5 rounded-xl transition-all duration-300 text-sm flex items-center justify-center gap-2 shadow-md hover:shadow-lg">
                                Ver detalles
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Evento 2: Expo Emprendedores -->
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 border border-gray-100">
                        <div class="relative h-52">
                            <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=600&q=80" 
                                 alt="Expo Emprendedores" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                            <div class="absolute top-4 left-4 flex gap-2">
                                <span class="px-3 py-1 bg-blue-600 text-white text-xs font-semibold rounded-full shadow-md">Próximamente</span>
                                <span class="px-3 py-1 bg-green-600 text-white text-xs font-semibold rounded-full shadow-md">Negocios</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Expo Emprendedores</h3>
                            <p class="text-sm text-gray-600 mb-5 leading-relaxed">Presenta tu idea de negocio ante inversionistas y mentores. Pitch de 5 minutos + Q&A.</p>
                            
                            <div class="flex items-center gap-4 mb-5 text-xs text-gray-500">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="font-medium">9 jun</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <span class="font-medium">45 equipos</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    <span class="font-medium">2-5 integrantes</span>
                                </div>
                            </div>
                            
                            <button class="w-full bg-gray-900 hover:bg-gray-800 text-white font-semibold py-3 px-5 rounded-xl transition-all duration-300 text-sm flex items-center justify-center gap-2 shadow-md hover:shadow-lg">
                                Ver detalles
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel Lateral Derecho: Notificaciones y Logros -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Notificaciones -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Notificaciones</h2>
                    <span class="bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">2</span>
                </div>

                <div class="space-y-3">
                    <!-- Notificación 1 - Nueva -->
                    <div class="flex gap-3 p-4 hover:bg-gray-50 rounded-xl transition-colors cursor-pointer border-l-4 border-blue-500 bg-blue-50/50">
                        <div class="flex-shrink-0 mt-0.5">
                            <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 mb-1">Nuevo evento disponible</p>
                            <p class="text-xs text-gray-600 mb-1.5 leading-relaxed">Se ha publicado el Hackathon de Innovación 2024</p>
                            <p class="text-xs text-gray-400">Hace 2 horas</p>
                        </div>
                    </div>

                    <!-- Notificación 2 -->
                    <div class="flex gap-3 p-4 hover:bg-gray-50 rounded-xl transition-colors cursor-pointer">
                        <div class="flex-shrink-0 mt-1">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 mb-1">Invitación a equipo</p>
                            <p class="text-xs text-gray-600 mb-1.5 leading-relaxed">Has sido invitado a unirte al equipo Tech Innovators</p>
                            <p class="text-xs text-gray-400">Hace 5 horas</p>
                        </div>
                    </div>

                    <!-- Notificación 3 - Nueva -->
                    <div class="flex gap-3 p-4 hover:bg-gray-50 rounded-xl transition-colors cursor-pointer border-l-4 border-green-500 bg-green-50/50">
                        <div class="flex-shrink-0 mt-0.5">
                            <div class="w-2 h-2 bg-green-600 rounded-full"></div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 mb-1">Evaluación completada</p>
                            <p class="text-xs text-gray-600 mb-1.5 leading-relaxed">Tu proyecto ha sido evaluado. Score: 87.5/100</p>
                            <p class="text-xs text-gray-400">Hace 1 día</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mis Logros -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Mis Logros</h2>
                
                <!-- Logros Principales -->
                <div class="grid grid-cols-2 gap-3 mb-6">
                    <div class="text-center p-4 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl border-2 border-yellow-300 hover:shadow-md transition-all">
                        <div class="w-12 h-12 mx-auto mb-2 bg-yellow-400 rounded-full flex items-center justify-center">
                            <svg class="w-7 h-7 text-yellow-900" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </div>
                        <p class="text-xs font-bold text-yellow-900">Primer Lugar</p>
                    </div>
                    <div class="text-center p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl border-2 border-blue-300 hover:shadow-md transition-all">
                        <div class="w-12 h-12 mx-auto mb-2 bg-blue-400 rounded-full flex items-center justify-center">
                            <svg class="w-7 h-7 text-blue-900" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </div>
                        <p class="text-xs font-bold text-blue-900">Participante Activo</p>
                    </div>
                </div>

                <!-- Lista de Progreso -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Eventos completados</p>
                                <p class="text-xs text-gray-500">6/10 para siguiente nivel</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-orange-100 rounded-lg">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Racha activa</p>
                                <p class="text-xs text-gray-500">15 días consecutivos</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-purple-100 rounded-lg">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Trabajo en equipo</p>
                                <p class="text-xs text-gray-500">4 equipos formados</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
