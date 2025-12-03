@extends('layouts.estudiante')

@section('title', 'Detalle del Evento - EventTec')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Botón de regresar -->
    <button onclick="window.history.back()" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 mb-6 font-medium transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        <span>Volver a eventos</span>
    </button>

    <!-- Hero Image con Título -->
    <div class="relative h-96 rounded-3xl overflow-hidden mb-8 shadow-xl">
        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&q=80" 
             alt="Hackathon de Innovación 2024" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        
        <!-- Badges y Título sobre la imagen -->
        <div class="absolute bottom-0 left-0 right-0 p-8">
            <div class="flex gap-3 mb-4">
                <span class="px-4 py-1.5 bg-green-500 text-white text-sm font-bold rounded-full shadow-lg">En curso</span>
                <span class="px-4 py-1.5 bg-blue-600 text-white text-sm font-bold rounded-full shadow-lg">Tecnología</span>
            </div>
            <h1 class="text-5xl font-bold text-white mb-3">Hackathon de Innovación 2024</h1>
            <p class="text-xl text-white/90 max-w-3xl">Desarrolla soluciones tecnológicas innovadoras para problemas reales en 48 horas. Este año el tema central es la sostenibilidad y el medio ambiente.</p>
        </div>
    </div>

    <!-- Tabs de navegación -->
    <div class="mb-8 border-b border-gray-200">
        <div class="flex gap-6">
            <button class="px-4 py-3 font-semibold text-gray-900 border-b-2 border-gray-900 transition-colors tab-link active" data-tab="informacion">
                Información
            </button>
            <button class="px-4 py-3 font-medium text-gray-500 hover:text-gray-900 transition-colors tab-link" data-tab="rubrica">
                Rúbrica
            </button>
            <button class="px-4 py-3 font-medium text-gray-500 hover:text-gray-900 transition-colors tab-link" data-tab="equipos">
                Equipos (2)
            </button>
            <button class="px-4 py-3 font-medium text-gray-500 hover:text-gray-900 transition-colors tab-link" data-tab="premios">
                Premios
            </button>
        </div>
    </div>

    <!-- Contenido Principal con Sidebar -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Contenido Principal (2/3) -->
        <div class="lg:col-span-2">
            <!-- Tab: Información -->
            <div class="tab-content active" id="tab-informacion">
                <!-- Requisitos -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 mb-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-3 bg-blue-50 rounded-xl">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Requisitos</h2>
                    </div>
                    
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <div class="mt-1">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700 leading-relaxed">Equipo de 3-5 integrantes</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="mt-1">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700 leading-relaxed">Estudiantes activos</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="mt-1">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700 leading-relaxed">Laptop personal</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="mt-1">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700 leading-relaxed">Conocimientos de programación</span>
                        </li>
                    </ul>
                </div>

                <!-- Cronograma -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-3 bg-purple-50 rounded-xl">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Cronograma</h2>
                    </div>

                    <div class="space-y-4">
                        <div class="flex gap-4 p-4 bg-gray-50 rounded-xl">
                            <div class="flex-shrink-0 w-24 text-center">
                                <div class="text-2xl font-bold text-gray-900">Día 1</div>
                                <div class="text-sm text-gray-500">14 abr</div>
                            </div>
                            <div class="flex-1 border-l-2 border-blue-500 pl-4">
                                <h4 class="font-semibold text-gray-900 mb-1">Inicio y Formación de Equipos</h4>
                                <p class="text-sm text-gray-600">9:00 AM - Registro y bienvenida</p>
                                <p class="text-sm text-gray-600">10:00 AM - Presentación del reto</p>
                            </div>
                        </div>

                        <div class="flex gap-4 p-4 bg-gray-50 rounded-xl">
                            <div class="flex-shrink-0 w-24 text-center">
                                <div class="text-2xl font-bold text-gray-900">Día 2</div>
                                <div class="text-sm text-gray-500">15 abr</div>
                            </div>
                            <div class="flex-1 border-l-2 border-green-500 pl-4">
                                <h4 class="font-semibold text-gray-900 mb-1">Desarrollo</h4>
                                <p class="text-sm text-gray-600">Todo el día - Trabajo en proyectos</p>
                                <p class="text-sm text-gray-600">Mentorías disponibles</p>
                            </div>
                        </div>

                        <div class="flex gap-4 p-4 bg-gray-50 rounded-xl">
                            <div class="flex-shrink-0 w-24 text-center">
                                <div class="text-2xl font-bold text-gray-900">Día 3</div>
                                <div class="text-sm text-gray-500">16 abr</div>
                            </div>
                            <div class="flex-1 border-l-2 border-purple-500 pl-4">
                                <h4 class="font-semibold text-gray-900 mb-1">Presentaciones y Premiación</h4>
                                <p class="text-sm text-gray-600">2:00 PM - Pitch final</p>
                                <p class="text-sm text-gray-600">5:00 PM - Ceremonia de premiación</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab: Rúbrica (oculto inicialmente) -->
            <div class="tab-content hidden" id="tab-rubrica">
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Criterios de Evaluación</h2>
                    <p class="text-gray-600">Contenido de rúbrica...</p>
                </div>
            </div>

            <!-- Tab: Equipos (oculto inicialmente) -->
            <div class="tab-content hidden" id="tab-equipos">
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Equipos Registrados</h2>
                    <p class="text-gray-600">Lista de equipos...</p>
                </div>
            </div>

            <!-- Tab: Premios (oculto inicialmente) -->
            <div class="tab-content hidden" id="tab-premios">
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Premios</h2>
                    <p class="text-gray-600">Información de premios...</p>
                </div>
            </div>
        </div>

        <!-- Sidebar Derecha (1/3) -->
        <div class="lg:col-span-1">
            <!-- Card de Información Rápida -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-6 sticky top-8">
                <!-- Equipos inscritos -->
                <div class="mb-6">
                    <div class="flex items-center gap-3 mb-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="text-sm text-gray-500 font-medium">Equipos inscritos</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">24</p>
                </div>

                <!-- Tamaño de equipo -->
                <div class="mb-6">
                    <div class="flex items-center gap-3 mb-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span class="text-sm text-gray-500 font-medium">Tamaño de equipo</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">3-5 integrantes</p>
                </div>

                <!-- Premio principal -->
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm text-gray-500 font-medium">Premio principal</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">$50,000 MXN</p>
                </div>

                <!-- Botones de acción -->
                <div class="space-y-3">
                    <button onclick="openRegisterModal()" class="w-full bg-gray-900 hover:bg-gray-800 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl">
                        Registrar Equipo
                    </button>
                    
                    <div class="flex gap-2">
                        <button class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-4 rounded-xl transition-all flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                            </svg>
                            <span>Compartir</span>
                        </button>
                        <button class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-4 rounded-xl transition-all flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                            </svg>
                            <span>Guardar</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Registro de Equipo -->
<div id="registerModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <!-- Header del Modal -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Registrar nuevo equipo</h2>
                    <p class="text-sm text-gray-500 mt-1">Crea un equipo para participar en Hackathon de Innovación 2024</p>
                </div>
                <button onclick="closeRegisterModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Formulario -->
            <form id="teamRegisterForm" action="{{ route('estudiante.registrar-equipo') }}" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="evento_id" value="1">

                <!-- Nombre del equipo -->
                <div>
                    <label for="team_name" class="block text-sm font-semibold text-gray-700 mb-2">Nombre del equipo</label>
                    <input type="text" 
                           id="team_name" 
                           name="team_name" 
                           placeholder="ej: Tech Innovators" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                </div>

                <!-- Descripción -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Descripción (opcional)</label>
                    <textarea id="description" 
                              name="description" 
                              rows="4" 
                              placeholder="Breve descripción de tu equipo..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"></textarea>
                </div>

                <!-- Botones -->
                <div class="flex gap-3 pt-4">
                    <button type="button" 
                            onclick="closeRegisterModal()" 
                            class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="flex-1 px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white font-semibold rounded-xl transition-all shadow-md hover:shadow-lg">
                        Crear equipo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Manejo de tabs
    document.querySelectorAll('.tab-link').forEach(tab => {
        tab.addEventListener('click', function() {
            // Remover active de todos los tabs
            document.querySelectorAll('.tab-link').forEach(t => {
                t.classList.remove('border-b-2', 'border-gray-900', 'text-gray-900');
                t.classList.add('text-gray-500');
            });
            
            // Agregar active al tab clickeado
            this.classList.remove('text-gray-500');
            this.classList.add('border-b-2', 'border-gray-900', 'text-gray-900');
            
            // Ocultar todos los contenidos
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('active');
            });
            
            // Mostrar el contenido correspondiente
            const tabId = 'tab-' + this.dataset.tab;
            document.getElementById(tabId).classList.remove('hidden');
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Modal functions
    function openRegisterModal() {
        document.getElementById('registerModal').classList.remove('hidden');
        document.getElementById('registerModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeRegisterModal() {
        document.getElementById('registerModal').classList.add('hidden');
        document.getElementById('registerModal').classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    // Cerrar modal al hacer clic fuera
    document.getElementById('registerModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeRegisterModal();
        }
    });

    // Manejo del formulario
    document.getElementById('teamRegisterForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Aquí iría la lógica de envío AJAX
        const formData = new FormData(this);
        
        // Simulación de éxito
        alert('¡Equipo registrado exitosamente!');
        closeRegisterModal();
        this.reset();
    });
</script>
@endsection
