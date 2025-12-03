@extends('layouts.juez')

@section('title', 'Eventos - EvenTec')
@section('breadcrumb', 'Eventos')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Encabezado -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Eventos Asignados</h1>
        <p class="text-gray-600 mt-2 text-lg">Gestiona los eventos donde participas como juez evaluador.</p>
    </div>

    <!-- Filtros -->
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-8 border border-gray-100">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-2">Buscar evento</label>
                <input type="text" 
                       placeholder="Nombre del evento..." 
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>
            <div class="w-full md:w-48">
                <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                <select class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option>Todos</option>
                    <option>En curso</option>
                    <option>Próximamente</option>
                    <option>Finalizado</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Grid de Eventos -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Evento 1 -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="relative h-48">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&q=80" 
                     alt="Hackathon Innovación 2024" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1.5 bg-green-500 text-white text-xs font-semibold rounded-full shadow-lg">En curso</span>
                </div>
                <div class="absolute bottom-4 left-4 right-4">
                    <h3 class="text-xl font-bold text-white">Hackathon Innovación 2024</h3>
                </div>
            </div>
            <div class="p-6">
                <div class="flex items-center gap-4 mb-4 text-sm text-gray-600">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-medium">14-16 Abr</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="font-medium">24 equipos</span>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600 font-medium">Proyectos evaluados</span>
                        <span class="text-indigo-600 font-bold">8/24</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-indigo-600 h-2 rounded-full" style="width: 33%"></div>
                    </div>
                </div>
                
                <button class="w-full bg-gray-900 hover:bg-gray-800 text-white font-semibold py-3 px-5 rounded-xl transition-all duration-300 flex items-center justify-center gap-2">
                    Ver proyectos
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Evento 2 -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="relative h-48">
                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80" 
                     alt="Feria de Ciencias 2024" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1.5 bg-blue-600 text-white text-xs font-semibold rounded-full shadow-lg">Próximamente</span>
                </div>
                <div class="absolute bottom-4 left-4 right-4">
                    <h3 class="text-xl font-bold text-white">Feria de Ciencias 2024</h3>
                </div>
            </div>
            <div class="p-6">
                <div class="flex items-center gap-4 mb-4 text-sm text-gray-600">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-medium">19-20 May</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="font-medium">18 equipos</span>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600 font-medium">Proyectos evaluados</span>
                        <span class="text-gray-400 font-bold">0/18</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-gray-400 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                </div>
                
                <button class="w-full bg-gray-300 text-gray-500 font-semibold py-3 px-5 rounded-xl cursor-not-allowed flex items-center justify-center gap-2">
                    Próximamente
                </button>
            </div>
        </div>

        <!-- Evento 3 -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="relative h-48">
                <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=800&q=80" 
                     alt="Expo Emprendedores" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1.5 bg-gray-600 text-white text-xs font-semibold rounded-full shadow-lg">Finalizado</span>
                </div>
                <div class="absolute bottom-4 left-4 right-4">
                    <h3 class="text-xl font-bold text-white">Expo Emprendedores</h3>
                </div>
            </div>
            <div class="p-6">
                <div class="flex items-center gap-4 mb-4 text-sm text-gray-600">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-medium">15 Mar</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="font-medium">12 equipos</span>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600 font-medium">Proyectos evaluados</span>
                        <span class="text-green-600 font-bold">12/12</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full" style="width: 100%"></div>
                    </div>
                </div>
                
                <button class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 px-5 rounded-xl transition-all duration-300 flex items-center justify-center gap-2">
                    Ver resultados
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Evento 4 -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="relative h-48">
                <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=800&q=80" 
                     alt="Concurso Robótica" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1.5 bg-green-500 text-white text-xs font-semibold rounded-full shadow-lg">En curso</span>
                </div>
                <div class="absolute bottom-4 left-4 right-4">
                    <h3 class="text-xl font-bold text-white">Concurso de Robótica</h3>
                </div>
            </div>
            <div class="p-6">
                <div class="flex items-center gap-4 mb-4 text-sm text-gray-600">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-medium">10-11 Abr</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="font-medium">15 equipos</span>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600 font-medium">Proyectos evaluados</span>
                        <span class="text-indigo-600 font-bold">10/15</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-indigo-600 h-2 rounded-full" style="width: 66%"></div>
                    </div>
                </div>
                
                <button class="w-full bg-gray-900 hover:bg-gray-800 text-white font-semibold py-3 px-5 rounded-xl transition-all duration-300 flex items-center justify-center gap-2">
                    Ver proyectos
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
