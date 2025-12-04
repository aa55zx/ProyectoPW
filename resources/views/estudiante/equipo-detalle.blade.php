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

    <!-- Header del Equipo -->
    <div class="relative rounded-3xl overflow-hidden mb-8 shadow-xl">
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-blue-900 to-gray-900"></div>
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&q=80'); background-size: cover; background-position: center;"></div>
        </div>
        
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
            
            <!-- Solicitudes Pendientes (Solo para Líder) -->
            @if($equipo->leader_id === auth()->id() && count($solicitudesPendientes) > 0)
            <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-8 shadow-sm border-2 border-blue-200">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-3 bg-blue-500 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">📬 Solicitudes Pendientes</h2>
                        <p class="text-sm text-gray-600">{{ count($solicitudesPendientes) }} {{ count($solicitudesPendientes) == 1 ? 'persona quiere' : 'personas quieren' }} unirse a tu equipo</p>
                    </div>
                </div>

                <div class="space-y-4">
                    @foreach($solicitudesPendientes as $solicitud)
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200" id="solicitud-{{ $solicitud->id }}">
                            <div class="flex items-start gap-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                                    {{ strtoupper(substr($solicitud->name, 0, 2)) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-lg text-gray-900 mb-1">{{ $solicitud->name }}</h3>
                                    <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-3">
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            <span>{{ $solicitud->email }}</span>
                                        </div>
                                        @if($solicitud->career)
                                            <div class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                                </svg>
                                                <span>{{ $solicitud->career }}</span>
                                                @if($solicitud->semester)
                                                    <span class="text-gray-400">• Sem. {{ $solicitud->semester }}</span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        Solicitó unirse hace {{ \Carbon\Carbon::parse($solicitud->created_at)->diffForHumans() }}
                                    </div>
                                    @if($solicitud->message)
                                        <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                                            <p class="text-sm text-gray-700 italic">"{{ $solicitud->message }}"</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex flex-col gap-2 flex-shrink-0">
                                    <button onclick="aceptarSolicitud('{{ $solicitud->id }}', '{{ $solicitud->name }}')"
                                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm font-semibold whitespace-nowrap">
                                        ✓ Aceptar
                                    </button>
                                    <button onclick="rechazarSolicitud('{{ $solicitud->id }}', '{{ $solicitud->name }}')"
                                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm font-semibold whitespace-nowrap">
                                        ✗ Rechazar
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Miembros del Equipo -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">👥 Miembros del Equipo</h2>
                </div>

                <div class="space-y-4">
                    @foreach($equipo->members as $member)
                        <div class="flex items-center gap-4 p-4 rounded-xl border border-gray-200 hover:border-gray-300 transition-colors">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold text-xl">
                                    {{ strtoupper(substr($member->name, 0, 2)) }}
                                </div>
                            </div>

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
                        </div>
                    @endforeach
                </div>

                @if($equipo->members_count < $equipo->event->max_team_size)
                    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-sm text-blue-800">
                            <span class="font-semibold">💡 Tip:</span> Puedes agregar hasta {{ $equipo->event->max_team_size - $equipo->members_count }} miembros más.
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

<script>
async function aceptarSolicitud(requestId, userName) {
    if (!confirm(`¿Aceptar la solicitud de ${userName}?`)) {
        return;
    }

    try {
        const response = await fetch('{{ route("estudiante.equipos.aceptar-solicitud") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ request_id: requestId })
        });

        const data = await response.json();

        if (data.success) {
            alert('✓ ' + data.message);
            window.location.reload();
        } else {
            alert('✗ ' + data.message);
        }
    } catch (error) {
        alert('✗ Error al aceptar la solicitud');
    }
}

async function rechazarSolicitud(requestId, userName) {
    if (!confirm(`¿Rechazar la solicitud de ${userName}?`)) {
        return;
    }

    try {
        const response = await fetch('{{ route("estudiante.equipos.rechazar-solicitud") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ request_id: requestId })
        });

        const data = await response.json();

        if (data.success) {
            alert('✓ ' + data.message);
            window.location.reload();
        } else {
            alert('✗ ' + data.message);
        }
    } catch (error) {
        alert('✗ Error al rechazar la solicitud');
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
