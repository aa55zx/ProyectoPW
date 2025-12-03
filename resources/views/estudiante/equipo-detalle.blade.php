@extends('layouts.estudiante')

@section('title', $equipo->name . ' - EventTec')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Botón de regresar -->
    <button onclick="window.history.back()" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 mb-6 font-medium transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        <span>Volver</span>
    </button>

    <!-- Header del Equipo con degradado -->
    <div class="relative rounded-3xl overflow-hidden mb-8 shadow-xl">
        <!-- Imagen de fondo con degradado -->
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-blue-900 to-gray-900"></div>
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&q=80'); background-size: cover; background-position: center;"></div>
        </div>
        
        <!-- Contenido del header -->
        <div class="relative p-8">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-3">
                        <h1 class="text-4xl font-bold text-white">{{ $equipo->name }}</h1>
                        @if($equipo->leader_id === auth()->id())
                            <span class="px-4 py-1.5 bg-yellow-400 text-yellow-900 text-sm font-bold rounded-full">Líder</span>
                        @endif
                    </div>
                    <p class="text-white/90 text-lg mb-4">{{ $equipo->description ?? 'Sin descripción' }}</p>
                    <div class="flex items-center gap-6 text-white/80">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ $equipo->event->title }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                            <span class="font-mono text-lg">{{ $equipo->invitation_code }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <div class="text-center bg-white/10 rounded-2xl p-4 backdrop-blur-sm border border-white/20">
                        <div class="text-5xl font-bold text-white">{{ $equipo->members_count }}</div>
                        <div class="text-sm text-white/80 mt-1">Miembros</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Información del Equipo -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Miembros del Equipo -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">👥 Miembros del Equipo</h2>
                    @if($equipo->leader_id === auth()->id())
                        <button id="btn-invitar-miembro" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                            + Invitar miembro
                        </button>
                    @endif
                </div>

                <div class="space-y-4">
                    @foreach($equipo->members as $member)
                        <div class="flex items-center gap-4 p-4 rounded-xl border border-gray-200 hover:border-gray-300 transition-colors">
                            <!-- Avatar -->
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold text-xl">
                                    {{ strtoupper(substr($member->name, 0, 2)) }}
                                </div>
                            </div>

                            <!-- Info -->
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <h3 class="font-bold text-gray-900 text-lg">{{ $member->name }}</h3>
                                    @if($member->id === $equipo->leader_id)
                                        <span class="px-2 py-0.5 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Líder</span>
                                    @endif
                                </div>
                                <div class="flex flex-wrap gap-3 text-sm text-gray-600">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span>{{ $member->email }}</span>
                                    </div>
                                    @if($member->numero_control)
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                            </svg>
                                            <span>{{ $member->numero_control }}</span>
                                        </div>
                                    @endif
                                    @if($member->career)
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                            </svg>
                                            <span>{{ $member->career }}</span>
                                            @if($member->semester)
                                                <span class="text-gray-400">• Sem. {{ $member->semester }}</span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                @if($member->pivot && $member->pivot->joined_at)
                                    <div class="text-xs text-gray-500 mt-2">
                                        Se unió el {{ \Carbon\Carbon::parse($member->pivot->joined_at)->format('d/m/Y') }}
                                    </div>
                                @endif
                            </div>

                            <!-- Acciones -->
                            @if($equipo->leader_id === auth()->id() && $member->id !== $equipo->leader_id)
                                <div class="flex-shrink-0">
                                    <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" 
                                            onclick="confirmarEliminarMiembro('{{ $member->id }}', '{{ $member->name }}')">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                @if($equipo->members_count < $equipo->event->max_team_size)
                    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-sm text-blue-800">
                            <span class="font-semibold">💡 Tip:</span> Puedes agregar hasta {{ $equipo->event->max_team_size - $equipo->members_count }} miembros más. Comparte el código: <span class="font-mono font-bold">{{ $equipo->invitation_code }}</span>
                        </p>
                    </div>
                @endif
            </div>

            <!-- Proyecto del Equipo -->
            @if($equipo->project)
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">📁 Proyecto</h2>
                    <div class="space-y-4">
                        <div>
                            <h3 class="font-bold text-lg text-gray-900">{{ $equipo->project->title }}</h3>
                            <p class="text-gray-600 mt-2">{{ $equipo->project->description }}</p>
                        </div>
                        @if($equipo->project->repository_url)
                            <a href="{{ $equipo->project->repository_url }}" target="_blank" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                Ver repositorio
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Información del Evento -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 sticky top-8">
                <h3 class="font-bold text-lg text-gray-900 mb-4">Información del Evento</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-600 mb-1">Evento</p>
                        <p class="font-semibold text-gray-900">{{ $equipo->event->title }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 mb-1">Fecha del evento</p>
                        <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($equipo->event->event_start_date)->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 mb-1">Ubicación</p>
                        <p class="font-semibold text-gray-900">{{ $equipo->event->location }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 mb-1">Estado del equipo</p>
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                            <span class="w-2 h-2 bg-green-600 rounded-full"></span>
                            {{ ucfirst($equipo->status) }}
                        </span>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <a href="{{ route('estudiante.evento-detalle', $equipo->event_id) }}" 
                       class="block w-full py-3 px-4 bg-gray-900 text-white text-center rounded-lg hover:bg-gray-800 transition-colors font-medium">
                        Ver evento completo
                    </a>
                </div>

                @if($equipo->leader_id !== auth()->id())
                    <div class="mt-4">
                        <button onclick="confirmarSalirEquipo()" 
                                class="block w-full py-3 px-4 border border-red-300 text-red-600 text-center rounded-lg hover:bg-red-50 transition-colors font-medium">
                            Abandonar equipo
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal de Invitar Miembro -->
<div id="modal-invitar" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-8 relative">
        <button id="btn-cerrar-modal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <h3 class="text-2xl font-bold text-gray-900 mb-2">Invitar miembro</h3>
        <p class="text-gray-600 mb-6">Comparte este código con tu compañero</p>

        <div class="bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg p-6 text-center mb-6">
            <p class="text-sm text-gray-600 mb-2">Código de invitación</p>
            <p class="text-4xl font-bold font-mono text-gray-900 mb-4">{{ $equipo->invitation_code }}</p>
            <button onclick="copiarCodigo('{{ $equipo->invitation_code }}')" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                📋 Copiar código
            </button>
        </div>

        <div class="text-sm text-gray-600">
            <p class="mb-2">Los miembros pueden unirse:</p>
            <ul class="list-disc list-inside space-y-1">
                <li>Ingresando el código en "Unirse a equipo"</li>
                <li>Máximo {{ $equipo->event->max_team_size }} miembros por equipo</li>
            </ul>
        </div>

        <button onclick="cerrarModalInvitar()" 
                class="w-full mt-6 py-3 px-4 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
            Cerrar
        </button>
    </div>
</div>

<script>
// Modal de invitar
const modalInvitar = document.getElementById('modal-invitar');
const btnInvitar = document.getElementById('btn-invitar-miembro');
const btnCerrarModal = document.getElementById('btn-cerrar-modal');

if (btnInvitar) {
    btnInvitar.addEventListener('click', () => {
        modalInvitar.classList.remove('hidden');
    });
}

if (btnCerrarModal) {
    btnCerrarModal.addEventListener('click', cerrarModalInvitar);
}

function cerrarModalInvitar() {
    modalInvitar.classList.add('hidden');
}

function copiarCodigo(codigo) {
    navigator.clipboard.writeText(codigo).then(() => {
        alert('✓ Código copiado: ' + codigo);
    });
}

function confirmarEliminarMiembro(userId, userName) {
    if (confirm(`¿Estás seguro de eliminar a ${userName} del equipo?`)) {
        // TODO: Implementar eliminación
        alert('Función en desarrollo');
    }
}

function confirmarSalirEquipo() {
    if (confirm('¿Estás seguro de que quieres abandonar este equipo?')) {
        fetch('{{ route("estudiante.equipos.leave", $equipo->id) }}', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('✓ Has abandonado el equipo');
                window.location.href = '{{ route("estudiante.equipos") }}';
            } else {
                alert('✗ ' + data.message);
            }
        })
        .catch(() => alert('✗ Error al salir del equipo'));
    }
}
</script>
@endsection
