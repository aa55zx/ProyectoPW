@extends('layouts.estudiante')

@section('title', $proyecto->title . ' - EventTec')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Botón de regresar -->
    <button onclick="window.history.back()" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 mb-6 font-medium transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        <span>Volver</span>
    </button>

    <!-- Header del Proyecto -->
    <div class="relative rounded-3xl overflow-hidden mb-8 shadow-xl">
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-blue-900 to-gray-900"></div>
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&q=80'); background-size: cover;"></div>
        </div>
        
        <div class="relative p-8">
            <div class="flex items-start justify-between mb-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-3">
                        <h1 class="text-4xl font-bold text-white">{{ $proyecto->title }}</h1>
                        @if($proyecto->status === 'in_progress')
                            <span class="px-4 py-1.5 bg-yellow-400 text-yellow-900 text-sm font-bold rounded-full">En progreso</span>
                        @elseif($proyecto->status === 'submitted')
                            <span class="px-4 py-1.5 bg-blue-400 text-blue-900 text-sm font-bold rounded-full">Entregado</span>
                        @elseif($proyecto->status === 'evaluated')
                            <span class="px-4 py-1.5 bg-green-400 text-green-900 text-sm font-bold rounded-full">Evaluado</span>
                        @endif
                    </div>
                    <p class="text-white/90 text-lg mb-4">{{ $proyecto->description }}</p>
                    <div class="flex items-center gap-6 text-white/80">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span>{{ $proyecto->team->name }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ $proyecto->team->event->title }}</span>
                        </div>
                    </div>
                </div>
                @if($proyecto->final_score)
                    <div class="flex-shrink-0">
                        <div class="text-center bg-white/10 rounded-2xl p-4 backdrop-blur-sm border border-white/20">
                            <div class="text-5xl font-bold text-white">{{ $proyecto->final_score }}</div>
                            <div class="text-sm text-white/80 mt-1">Puntuación</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Contenido Principal -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Descripción Completa -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">📝 Descripción del Proyecto</h2>
                <p class="text-gray-700 leading-relaxed">{{ $proyecto->description }}</p>
            </div>

            <!-- Miembros del Equipo -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">👥 Equipo</h2>
                <div class="space-y-3">
                    @foreach($proyecto->team->members as $member)
                        <div class="flex items-center gap-3 p-3 rounded-lg border border-gray-200">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm">
                                {{ strtoupper(substr($member->name, 0, 2)) }}
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900">{{ $member->name }}</p>
                                <p class="text-sm text-gray-600">{{ $member->email }}</p>
                            </div>
                            @if($member->id === $proyecto->team->leader_id)
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Líder</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Evaluaciones -->
            @if($proyecto->evaluations && $proyecto->evaluations->count() > 0)
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">⭐ Evaluaciones</h2>
                    <div class="space-y-4">
                        @foreach($proyecto->evaluations as $evaluacion)
                            <div class="p-4 border border-gray-200 rounded-lg">
                                <div class="flex items-center justify-between mb-2">
                                    <p class="font-semibold text-gray-900">{{ $evaluacion->judge->name }}</p>
                                    <span class="text-2xl font-bold text-blue-600">{{ $evaluacion->total_score }}/100</span>
                                </div>
                                @if($evaluacion->comments)
                                    <p class="text-gray-600 text-sm">{{ $evaluacion->comments }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 sticky top-8 space-y-4">
                <h3 class="font-bold text-lg text-gray-900 mb-4">Información</h3>
                
                <div>
                    <p class="text-sm text-gray-600 mb-1">Creado el</p>
                    <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($proyecto->created_at)->format('d M Y') }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-600 mb-1">Evento</p>
                    <p class="font-semibold text-gray-900">{{ $proyecto->team->event->title }}</p>
                </div>

                @if($proyecto->rank)
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Posición</p>
                        <div class="flex items-center gap-2">
                            @if($proyecto->rank === 1)
                                <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @elseif($proyecto->rank === 2)
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @elseif($proyecto->rank === 3)
                                <svg class="w-6 h-6 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endif
                            <p class="text-2xl font-bold text-gray-900">#{{ $proyecto->rank }}</p>
                        </div>
                    </div>
                @endif

                @if($proyecto->team->leader_id === auth()->id())
                    <div class="pt-4 border-t border-gray-200">
                        <button id="btn-eliminar" class="w-full py-3 px-4 border border-red-300 text-red-600 rounded-lg hover:bg-red-50 transition-colors font-medium">
                            Eliminar proyecto
                        </button>
                    </div>
                @endif

                <a href="{{ route('estudiante.equipos.show', $proyecto->team_id) }}" 
                   class="block w-full py-3 px-4 bg-gray-900 text-white text-center rounded-lg hover:bg-gray-800 transition-colors font-medium">
                    Ver equipo
                </a>
            </div>
        </div>
    </div>
</div>

<script>
@if($proyecto->team->leader_id === auth()->id())
document.getElementById('btn-eliminar')?.addEventListener('click', function() {
    if (confirm('¿Estás seguro de eliminar este proyecto? Esta acción no se puede deshacer.')) {
        fetch('{{ route("estudiante.proyectos.destroy", $proyecto->id) }}', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('✓ Proyecto eliminado');
                window.location.href = '{{ route("estudiante.proyectos") }}';
            } else {
                alert('✗ ' + data.message);
            }
        })
        .catch(() => alert('✗ Error al eliminar'));
    }
});
@endif
</script>
@endsection
