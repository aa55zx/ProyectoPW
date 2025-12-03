@extends('layouts.estudiante')

@section('title', $evento->title . ' - EventTec')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Botón de regresar -->
    <button onclick="window.history.back()" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 mb-6 font-medium transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        <span>Volver a eventos</span>
    </button>

    <!-- Hero del evento -->
    <div class="relative h-96 rounded-3xl overflow-hidden mb-8 shadow-xl">
        @if($evento->cover_image_url)
            <img src="{{ $evento->cover_image_url }}" alt="{{ $evento->title }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-gradient-to-r from-blue-500 to-purple-600"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 right-0 p-8">
            <div class="flex gap-3 mb-4">
                @if($evento->status === 'open')
                    <span class="px-4 py-1.5 bg-green-500 text-white text-sm font-bold rounded-full">En curso</span>
                @elseif($evento->status === 'finished')
                    <span class="px-4 py-1.5 bg-gray-500 text-white text-sm font-bold rounded-full">Finalizado</span>
                @else
                    <span class="px-4 py-1.5 bg-blue-500 text-white text-sm font-bold rounded-full">Próximamente</span>
                @endif
                <span class="px-4 py-1.5 bg-white/90 text-gray-800 text-sm font-bold rounded-full">{{ $evento->category }}</span>
            </div>
            <h1 class="text-5xl font-bold text-white mb-3">{{ $evento->title }}</h1>
            <p class="text-xl text-white/90 max-w-3xl">{{ $evento->description }}</p>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Información Principal -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Requisitos -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">📋 Requisitos</h2>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Equipo de {{ $evento->min_team_size }}-{{ $evento->max_team_size }} integrantes</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Estudiantes activos del TecNM</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Laptop personal</span>
                    </li>
                </ul>
            </div>

            <!-- Cronograma -->
            @if($evento->schedule && $evento->schedule->count() > 0)
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">📅 Cronograma</h2>
                <div class="space-y-4">
                    @foreach($evento->schedule->groupBy('day') as $day => $activities)
                        <div>
                            <h3 class="font-bold text-lg text-gray-900 mb-3">Día {{ $day }}</h3>
                            <div class="space-y-3">
                                @foreach($activities as $activity)
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0">
                                        <span class="text-sm font-medium text-blue-600">{{ $activity->start_time }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-900">{{ $activity->title }}</p>
                                        <p class="text-sm text-gray-600">{{ $activity->description }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 sticky top-8 space-y-6">
                <!-- Estadísticas -->
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-blue-50 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Equipos inscritos</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $evento->registered_teams_count ?? 0 }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-green-50 rounded-lg">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Tamaño de equipo</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $evento->min_team_size }}-{{ $evento->max_team_size }} integrantes</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-purple-50 rounded-lg">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Premio principal</p>
                            <p class="text-2xl font-bold text-gray-900">$50,000 MXN</p>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    @if($miEquipo)
                        <!-- Ya tiene equipo -->
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                            <p class="text-sm font-medium text-green-800 mb-1">✓ Ya estás registrado</p>
                            <p class="text-xs text-green-700">Equipo: {{ $miEquipo->name }}</p>
                        </div>
                        <a href="{{ route('estudiante.equipos.show', $miEquipo->id) }}" 
                           class="block w-full py-3 px-4 bg-gray-900 text-white text-center rounded-lg hover:bg-gray-800 transition-colors font-medium">
                            Ver mi equipo
                        </a>
                    @else
                        <!-- Botón para registrar equipo -->
                        <button id="btn-registrar-equipo" 
                                class="w-full py-3 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                            + Registrar Equipo
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Registro de Equipo -->
<div id="modal-registrar-equipo" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-8 relative">
        <button id="btn-cerrar-modal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <h3 class="text-2xl font-bold text-gray-900 mb-2">Registrar nuevo equipo</h3>
        <p class="text-gray-600 mb-6">Crea un equipo para participar en {{ $evento->title }}</p>

        <form id="form-registrar-equipo" class="space-y-4">
            @csrf
            <input type="hidden" name="event_id" value="{{ $evento->id }}">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del equipo</label>
                <input type="text" 
                       name="team_name" 
                       required
                       placeholder="Ej: Tech Innovators"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Descripción (opcional)</label>
                <textarea name="team_description" 
                          rows="3"
                          placeholder="Breve descripción de tu equipo..."
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="button" 
                        id="btn-cancelar"
                        class="flex-1 py-3 px-4 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                    Cancelar
                </button>
                <button type="submit" 
                        class="flex-1 py-3 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    Crear equipo
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modal-registrar-equipo');
    const btnAbrir = document.getElementById('btn-registrar-equipo');
    const btnCerrar = document.getElementById('btn-cerrar-modal');
    const btnCancelar = document.getElementById('btn-cancelar');
    const form = document.getElementById('form-registrar-equipo');
    
    if (btnAbrir) {
        btnAbrir.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });
    }
    
    function cerrarModal() {
        modal.classList.add('hidden');
        form.reset();
    }
    
    if (btnCerrar) btnCerrar.addEventListener('click', cerrarModal);
    if (btnCancelar) btnCancelar.addEventListener('click', cerrarModal);
    
    modal.addEventListener('click', (e) => {
        if (e.target === modal) cerrarModal();
    });
    
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const btn = form.querySelector('button[type="submit"]');
        const btnText = btn.innerHTML;
        
        btn.disabled = true;
        btn.innerHTML = 'Creando...';
        
        try {
            const response = await fetch('/estudiante/registrar-equipo', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                alert('✓ Equipo creado exitosamente');
                window.location.reload();
            } else {
                alert('✗ ' + data.message);
                btn.disabled = false;
                btn.innerHTML = btnText;
            }
        } catch (error) {
            alert('✗ Error al crear el equipo');
            btn.disabled = false;
            btn.innerHTML = btnText;
        }
    });
});
</script>
@endsection
