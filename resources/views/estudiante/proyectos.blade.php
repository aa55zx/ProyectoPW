@extends('layouts.estudiante')

@section('title', 'Mis Proyectos - EventTec')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Proyectos</h1>
            <p class="text-gray-600 text-lg">Gestiona tus proyectos y presentaciones</p>
        </div>
        <button id="btn-nuevo-proyecto" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Nuevo Proyecto
        </button>
    </div>

    <!-- Tabs de filtro -->
    <div class="flex gap-4 mb-6 border-b border-gray-200">
        <button class="tab-filter active px-4 py-2 font-medium text-gray-900 border-b-2 border-blue-600" data-status="all">
            Todos ({{ $proyectos->count() }})
        </button>
        <button class="tab-filter px-4 py-2 font-medium text-gray-600 hover:text-gray-900 border-b-2 border-transparent" data-status="in_progress">
            En progreso ({{ $proyectos->where('status', 'in_progress')->count() }})
        </button>
        <button class="tab-filter px-4 py-2 font-medium text-gray-600 hover:text-gray-900 border-b-2 border-transparent" data-status="submitted">
            Entregados ({{ $proyectos->where('status', 'submitted')->count() }})
        </button>
        <button class="tab-filter px-4 py-2 font-medium text-gray-600 hover:text-gray-900 border-b-2 border-transparent" data-status="evaluated">
            Evaluados ({{ $proyectos->where('status', 'evaluated')->count() }})
        </button>
    </div>

    <!-- Lista de proyectos -->
    @if($proyectos->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($proyectos as $proyecto)
                <div class="proyecto-card bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow border border-gray-100 overflow-hidden" 
                     data-status="{{ $proyecto->status }}">
                    <!-- Header del proyecto -->
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-3">
                            <h3 class="text-xl font-bold text-gray-900 flex-1">{{ $proyecto->title }}</h3>
                            @if($proyecto->status === 'in_progress')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">En progreso</span>
                            @elseif($proyecto->status === 'submitted')
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">Entregado</span>
                            @elseif($proyecto->status === 'evaluated')
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Evaluado</span>
                            @endif
                        </div>

                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($proyecto->description, 80) }}</p>

                        <!-- Info del proyecto -->
                        <div class="space-y-2 text-sm text-gray-600 mb-4">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span>{{ $proyecto->team->name }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $proyecto->team->event->title }}</span>
                            </div>
                            @if($proyecto->final_score)
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <span class="font-semibold text-gray-900">{{ $proyecto->final_score }}/100</span>
                                </div>
                            @endif
                        </div>

                        <!-- Botón ver detalles -->
                        <a href="{{ route('estudiante.proyectos.show', $proyecto->id) }}" 
                           class="block w-full py-2 px-4 bg-gray-900 text-white text-center rounded-lg hover:bg-gray-800 transition-colors font-medium">
                            Ver detalles
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Mensaje cuando no hay proyectos -->
        <div class="text-center py-16">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">No tienes proyectos</h3>
            <p class="text-gray-600 mb-6">Crea tu primer proyecto para participar en eventos</p>
            <button onclick="document.getElementById('btn-nuevo-proyecto').click()" 
                    class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Crear proyecto
            </button>
        </div>
    @endif
</div>

<!-- Modal de Nuevo Proyecto (SIMPLIFICADO) -->
<div id="modal-nuevo-proyecto" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-8 relative">
        <button id="btn-cerrar-modal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <h3 class="text-2xl font-bold text-gray-900 mb-2">Nuevo Proyecto</h3>
        <p class="text-gray-600 mb-6">Crea un proyecto para tu equipo</p>

        <form id="form-nuevo-proyecto" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Equipo *</label>
                <select name="team_id" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Selecciona un equipo</option>
                    @foreach($equipos as $equipo)
                        @if(!$equipo->project)
                            <option value="{{ $equipo->id }}">{{ $equipo->name }} - {{ $equipo->event->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Título del proyecto *</label>
                <input type="text" 
                       name="title" 
                       required
                       placeholder="Ej: Sistema de Gestión Inteligente"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Descripción *</label>
                <textarea name="description" 
                          required
                          rows="4"
                          placeholder="Describe tu proyecto..."
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
                    Crear proyecto
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modal-nuevo-proyecto');
    const btnNuevo = document.getElementById('btn-nuevo-proyecto');
    const btnCerrar = document.getElementById('btn-cerrar-modal');
    const btnCancelar = document.getElementById('btn-cancelar');
    const form = document.getElementById('form-nuevo-proyecto');
    const tabFilters = document.querySelectorAll('.tab-filter');
    const proyectoCards = document.querySelectorAll('.proyecto-card');
    
    // Abrir modal
    if (btnNuevo) {
        btnNuevo.addEventListener('click', () => modal.classList.remove('hidden'));
    }
    
    // Cerrar modal
    function cerrarModal() {
        modal.classList.add('hidden');
        form.reset();
    }
    
    if (btnCerrar) btnCerrar.addEventListener('click', cerrarModal);
    if (btnCancelar) btnCancelar.addEventListener('click', cerrarModal);
    
    modal.addEventListener('click', (e) => {
        if (e.target === modal) cerrarModal();
    });
    
    // Enviar formulario
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const btn = form.querySelector('button[type="submit"]');
        const btnText = btn.innerHTML;
        
        btn.disabled = true;
        btn.innerHTML = 'Creando...';
        
        try {
            const response = await fetch('{{ route("estudiante.proyectos.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                alert('✓ Proyecto creado exitosamente');
                window.location.reload();
            } else {
                alert('✗ ' + data.message);
                btn.disabled = false;
                btn.innerHTML = btnText;
            }
        } catch (error) {
            alert('✗ Error al crear el proyecto');
            btn.disabled = false;
            btn.innerHTML = btnText;
        }
    });
    
    // Filtros por tabs
    tabFilters.forEach(tab => {
        tab.addEventListener('click', function() {
            const status = this.dataset.status;
            
            tabFilters.forEach(t => {
                t.classList.remove('active', 'text-gray-900', 'border-blue-600');
                t.classList.add('text-gray-600', 'border-transparent');
            });
            this.classList.add('active', 'text-gray-900', 'border-blue-600');
            this.classList.remove('text-gray-600', 'border-transparent');
            
            proyectoCards.forEach(card => {
                if (status === 'all' || card.dataset.status === status) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endsection
