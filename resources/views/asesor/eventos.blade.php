@extends('layouts.dashboard')

@section('title', 'Eventos - Asesor')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Eventos</h1>
        <p class="text-gray-600 mt-1">Explora y participa en concursos académicos</p>
    </div>

    <!-- Barra de búsqueda y filtros -->
    <div class="bg-white rounded-2xl p-6 shadow-sm mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Buscador -->
            <div class="flex-1">
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" id="buscarEventos" placeholder="Buscar eventos..." 
                           class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Filtros -->
            <div class="flex gap-3">
                <button class="flex items-center gap-2 px-4 py-3 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    <select class="outline-none bg-transparent">
                        <option>Todos</option>
                        <option>Activos</option>
                        <option>Próximos</option>
                        <option>Finalizados</option>
                    </select>
                </button>

                <button class="flex items-center gap-2 px-4 py-3 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                    <select class="outline-none bg-transparent">
                        <option>Todas las categorías</option>
                        <option>Tecnología</option>
                        <option>Ciencias</option>
                        <option>Robótica</option>
                    </select>
                </button>

                <!-- Vista Grid/Lista -->
                <div class="flex gap-2 border border-gray-200 rounded-xl p-1">
                    <button class="p-2 rounded-lg bg-gray-900 text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 3H3v7h7V3zM21 3h-7v7h7V3zM21 14h-7v7h7v-7zM10 14H3v7h7v-7z"/>
                        </svg>
                    </button>
                    <button class="p-2 rounded-lg hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 6h18v2H3V6zm0 5h18v2H3v-2zm0 5h18v2H3v-2z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs de filtros -->
    <div class="flex gap-4 mb-6 border-b border-gray-200">
        <button class="px-4 py-3 font-semibold text-gray-900 border-b-2 border-gray-900">
            Todos (4)
        </button>
        <button class="px-4 py-3 font-medium text-gray-600 hover:text-gray-900">
            Activos (1)
        </button>
        <button class="px-4 py-3 font-medium text-gray-600 hover:text-gray-900">
            Próximos (2)
        </button>
        <button class="px-4 py-3 font-medium text-gray-600 hover:text-gray-900">
            Finalizados (1)
        </button>
    </div>

    <!-- Grid de Eventos -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Evento 1 - En curso -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all overflow-hidden group">
            <div class="relative h-48 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=500" 
                     alt="Hackathon" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1 bg-yellow-500 text-white text-xs font-semibold rounded-full">En curso</span>
                </div>
                <div class="absolute top-4 right-4">
                    <span class="px-3 py-1 bg-blue-900 text-white text-xs font-semibold rounded-full">Tecnología</span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-2">Hackathon de Innovación 2024</h3>
                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                    Desarrolla soluciones tecnológicas innovadoras para problemas reales en 48 horas. Este año el tema...
                </p>
                <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        14 abr
                    </div>
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        24 equipos
                    </div>
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        3-5 integrantes
                    </div>
                </div>
                <a href="{{ route('asesor.evento-detalle', 1) }}" 
                   class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition-colors font-medium">
                    Ver detalles
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Evento 2 - Próximamente -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all overflow-hidden group">
            <div class="relative h-48 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?w=500" 
                     alt="Feria de Ciencias" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1 bg-blue-500 text-white text-xs font-semibold rounded-full">Próximamente</span>
                </div>
                <div class="absolute top-4 right-4">
                    <span class="px-3 py-1 bg-green-600 text-white text-xs font-semibold rounded-full">Ciencias</span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-2">Feria de Ciencias 2024</h3>
                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                    Presenta tu proyecto de investigación científica ante expertos del área. Categorías: Biología, Química...
                </p>
                <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        19 may
                    </div>
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        18 equipos
                    </div>
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        2-4 integrantes
                    </div>
                </div>
                <a href="{{ route('asesor.evento-detalle', 2) }}" 
                   class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition-colors font-medium">
                    Ver detalles
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Evento 3 - Finalizado -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all overflow-hidden group">
            <div class="relative h-48 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=500" 
                     alt="Robótica" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1 bg-gray-500 text-white text-xs font-semibold rounded-full">Finalizado</span>
                </div>
                <div class="absolute top-4 right-4">
                    <span class="px-3 py-1 bg-purple-600 text-white text-xs font-semibold rounded-full">Robótica</span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-2">Concurso de Robótica</h3>
                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                    Diseña y programa robots autónomos para superar diversos retos. Modalidades: Seguidor de línea...
                </p>
                <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        29 feb
                    </div>
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        32 equipos
                    </div>
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        3-5 integrantes
                    </div>
                </div>
                <a href="{{ route('asesor.evento-detalle', 3) }}" 
                   class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition-colors font-medium">
                    Ver detalles
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Evento 4 - Próximamente -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all overflow-hidden group">
            <div class="relative h-48 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=500" 
                     alt="Startup Challenge" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1 bg-blue-500 text-white text-xs font-semibold rounded-full">Próximamente</span>
                </div>
                <div class="absolute top-4 right-4">
                    <span class="px-3 py-1 bg-orange-600 text-white text-xs font-semibold rounded-full">Negocios</span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-2">Startup Challenge</h3>
                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                    Presenta tu idea de negocio ante inversionistas y expertos. Categorías: Tecnología, Sustentabilidad...
                </p>
                <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        15 jun
                    </div>
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        20 equipos
                    </div>
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        2-5 integrantes
                    </div>
                </div>
                <a href="{{ route('asesor.evento-detalle', 4) }}" 
                   class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition-colors font-medium">
                    Ver detalles
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // Funcionalidad de búsqueda
    document.getElementById('buscarEventos').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        // Aquí implementar la lógica de búsqueda
        console.log('Buscando:', searchTerm);
    });
</script>
@endsection
