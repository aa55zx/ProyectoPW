@extends('layouts.estudiante')

@section('title', 'Eventos - EventTec')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Eventos</h1>
        <p class="text-gray-600 text-lg">Explora y participa en concursos académicos</p>
    </div>

    <!-- Barra de búsqueda y filtros -->
    <div class="flex flex-col md:flex-row gap-4 mb-6">
        <!-- Buscador -->
        <div class="flex-1 relative">
            <input type="text" 
                   id="searchInput"
                   placeholder="Buscar eventos..." 
                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-sm">
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>

        <!-- Botón de filtro -->
        <button class="px-6 py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition-all flex items-center gap-2 justify-center">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
            </svg>
            <span class="text-gray-700 font-medium">Filtros</span>
        </button>

        <!-- Selector de categoría -->
        <select class="px-6 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-700 font-medium">
            <option>Todos</option>
            <option>Tecnología</option>
            <option>Ciencias</option>
            <option>Negocios</option>
            <option>Robótica</option>
        </select>

        <!-- Selector de período -->
        <select class="px-6 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-gray-700 font-medium">
            <option>Todas</option>
            <option>Enero - Abril</option>
            <option>Mayo - Agosto</option>
            <option>Septiembre - Diciembre</option>
        </select>

        <!-- Toggle de vista -->
        <div class="flex gap-2 border border-gray-300 rounded-xl p-1">
            <button class="p-2 rounded-lg bg-gray-100 text-gray-900 transition-all" id="gridView">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
            </button>
            <button class="p-2 rounded-lg hover:bg-gray-100 text-gray-500 transition-all" id="listView">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Tabs de filtrado -->
    <div class="flex gap-4 mb-8 border-b border-gray-200">
        <button class="px-4 py-3 font-semibold text-gray-900 border-b-2 border-gray-900 tab-btn active" data-filter="todos">
            Todos (4)
        </button>
        <button class="px-4 py-3 font-medium text-gray-500 hover:text-gray-900 transition-colors tab-btn" data-filter="activos">
            Activos (1)
        </button>
        <button class="px-4 py-3 font-medium text-gray-500 hover:text-gray-900 transition-colors tab-btn" data-filter="proximos">
            Próximos (2)
        </button>
        <button class="px-4 py-3 font-medium text-gray-500 hover:text-gray-900 transition-colors tab-btn" data-filter="finalizados">
            Finalizados (1)
        </button>
    </div>

    <!-- Grid de Eventos -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="eventsGrid">
        
        <!-- Evento 1: Hackathon de Innovación 2024 (Activo) -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 border border-gray-100 event-card cursor-pointer" 
             data-status="activos" 
             data-event-id="1"
             onclick="window.location.href='{{ route('estudiante.evento-detalle', 1) }}'">
            <div class="relative h-56">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600&q=80" 
                     alt="Hackathon de Innovación 2024" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                <div class="absolute top-4 left-4 flex gap-2">
                    <span class="px-3 py-1.5 bg-green-500 text-white text-xs font-bold rounded-full shadow-lg">En curso</span>
                    <span class="px-3 py-1.5 bg-blue-600 text-white text-xs font-bold rounded-full shadow-lg">Tecnología</span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-1">Hackathon de Innovación 2024</h3>
                <p class="text-sm text-gray-600 mb-4 line-clamp-2 leading-relaxed">
                    Desarrolla soluciones tecnológicas innovadoras para problemas reales en 48 horas. Este año el tema central es la sostenibilidad y el medio...
                </p>

                <div class="space-y-2 mb-5">
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-medium">14 abr</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="font-medium">24 equipos</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span class="font-medium">3-5 integrantes</span>
                    </div>
                </div>

                <button class="w-full bg-gray-900 hover:bg-gray-800 text-white font-semibold py-3 px-5 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 shadow-md hover:shadow-lg"
                        onclick="event.stopPropagation(); window.location.href='{{ route('estudiante.evento-detalle', 1) }}'">
                    Ver detalles
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Evento 2: Feria de Ciencias 2024 (Próximo) -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 border border-gray-100 event-card cursor-pointer" 
             data-status="proximos"
             data-event-id="2">
            <div class="relative h-56">
                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&q=80" 
                     alt="Feria de Ciencias 2024" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                <div class="absolute top-4 left-4 flex gap-2">
                    <span class="px-3 py-1.5 bg-blue-600 text-white text-xs font-bold rounded-full shadow-lg">Próximamente</span>
                    <span class="px-3 py-1.5 bg-purple-600 text-white text-xs font-bold rounded-full shadow-lg">Ciencias</span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-1">Feria de Ciencias 2024</h3>
                <p class="text-sm text-gray-600 mb-4 line-clamp-2 leading-relaxed">
                    Presenta tu proyecto de investigación científica ante expertos del área. Categorías: Biología, Química, Física y Matemáticas.
                </p>

                <div class="space-y-2 mb-5">
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-medium">19 may</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="font-medium">18 equipos</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span class="font-medium">2-4 integrantes</span>
                    </div>
                </div>

                <button class="w-full bg-gray-900 hover:bg-gray-800 text-white font-semibold py-3 px-5 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 shadow-md hover:shadow-lg">
                    Ver detalles
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Evento 3: Concurso de Robótica (Finalizado) -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 border border-gray-100 event-card cursor-pointer" 
             data-status="finalizados"
             data-event-id="3">
            <div class="relative h-56">
                <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=600&q=80" 
                     alt="Concurso de Robótica" 
                     class="w-full h-full object-cover grayscale opacity-75">
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                <div class="absolute top-4 left-4 flex gap-2">
                    <span class="px-3 py-1.5 bg-gray-600 text-white text-xs font-bold rounded-full shadow-lg">Finalizado</span>
                    <span class="px-3 py-1.5 bg-red-600 text-white text-xs font-bold rounded-full shadow-lg">Robótica</span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-1">Concurso de Robótica</h3>
                <p class="text-sm text-gray-600 mb-4 line-clamp-2 leading-relaxed">
                    Diseña y programa robots autónomos para superar diversos retos. Modalidades: Seguidor de línea, Sumo y Laberinto.
                </p>

                <div class="space-y-2 mb-5">
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-medium">29 feb</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="font-medium">32 equipos</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span class="font-medium">3-5 integrantes</span>
                    </div>
                </div>

                <button class="w-full bg-gray-300 text-gray-500 font-semibold py-3 px-5 rounded-xl cursor-not-allowed">
                    Evento finalizado
                </button>
            </div>
        </div>

        <!-- Evento 4: Expo Emprendedores (Próximo) -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 border border-gray-100 event-card cursor-pointer" 
             data-status="proximos"
             data-event-id="4">
            <div class="relative h-56">
                <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=600&q=80" 
                     alt="Expo Emprendedores" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                <div class="absolute top-4 left-4 flex gap-2">
                    <span class="px-3 py-1.5 bg-blue-600 text-white text-xs font-bold rounded-full shadow-lg">Próximamente</span>
                    <span class="px-3 py-1.5 bg-green-600 text-white text-xs font-bold rounded-full shadow-lg">Negocios</span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-1">Expo Emprendedores</h3>
                <p class="text-sm text-gray-600 mb-4 line-clamp-2 leading-relaxed">
                    Presenta tu idea de negocio ante inversionistas y mentores. Pitch de 5 minutos + Q&A con expertos del sector empresarial.
                </p>

                <div class="space-y-2 mb-5">
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-medium">9 jun</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="font-medium">45 equipos</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span class="font-medium">2-5 integrantes</span>
                    </div>
                </div>

                <button class="w-full bg-gray-900 hover:bg-gray-800 text-white font-semibold py-3 px-5 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 shadow-md hover:shadow-lg">
                    Ver detalles
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </button>
            </div>
        </div>

    </div>
</div>

<script>
    // Filtrado por tabs
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Remover clase active de todos los tabs
            document.querySelectorAll('.tab-btn').forEach(b => {
                b.classList.remove('border-b-2', 'border-gray-900', 'text-gray-900');
                b.classList.add('text-gray-500');
            });
            
            // Agregar clase active al tab clickeado
            this.classList.remove('text-gray-500');
            this.classList.add('border-b-2', 'border-gray-900', 'text-gray-900');
            
            const filter = this.dataset.filter;
            const cards = document.querySelectorAll('.event-card');
            
            cards.forEach(card => {
                if (filter === 'todos') {
                    card.style.display = 'block';
                } else {
                    if (card.dataset.status === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        });
    });

    // Búsqueda de eventos
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const cards = document.querySelectorAll('.event-card');
        
        cards.forEach(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            const description = card.querySelector('p').textContent.toLowerCase();
            
            if (title.includes(searchTerm) || description.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>
@endsection
