@extends('layouts.asesor-dashboard')

@section('title', 'Detalle del Proyecto - Asesor')

@section('content')
<div class="p-8">
    <!-- Header con estado -->
    <div class="mb-8 flex items-start justify-between">
        <div class="flex-1">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $proyecto->title }}</h1>
            <p class="text-gray-600">{{ $proyecto->description ?? 'Sin descripción' }}</p>
        </div>
        <div>
            @if($proyecto->status === 'draft' || $proyecto->status === 'in_progress')
                <span class="px-4 py-2 bg-yellow-100 text-yellow-700 text-sm font-semibold rounded-full">En progreso</span>
            @elseif($proyecto->status === 'submitted')
                <span class="px-4 py-2 bg-blue-100 text-blue-700 text-sm font-semibold rounded-full">Entregado</span>
            @elseif($proyecto->status === 'evaluated')
                <span class="px-4 py-2 bg-green-100 text-green-700 text-sm font-semibold rounded-full">Evaluado</span>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Columna principal -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Información del equipo -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Equipo</h2>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-lg">{{ substr($proyecto->team->name, 0, 2) }}</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ $proyecto->team->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $proyecto->team->members->count() }} miembros</p>
                    </div>
                </div>

                <h3 class="font-semibold text-gray-900 mb-3">Miembros del equipo</h3>
                <div class="space-y-2">
                    @foreach($proyecto->team->members as $member)
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                            <span class="text-gray-700 font-semibold text-sm">{{ substr($member->user->name, 0, 2) }}</span>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">{{ $member->user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $member->user->email }}</p>
                        </div>
                        @if($member->role === 'leader')
                        <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded">Líder</span>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Recursos del proyecto -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Recursos del Proyecto</h2>
                
                <div class="space-y-3">
                    @if($proyecto->repository_url)
                    <a href="{{ $proyecto->repository_url }}" target="_blank" class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">Repositorio</p>
                            <p class="text-sm text-gray-500">Ver código fuente</p>
                        </div>
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    @endif

                    @if($proyecto->demo_url)
                    <a href="{{ $proyecto->demo_url }}" target="_blank" class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">Demo</p>
                            <p class="text-sm text-gray-500">Ver proyecto en vivo</p>
                        </div>
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    @endif

                    @if(!$proyecto->repository_url && !$proyecto->demo_url)
                    <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-gray-300 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-500">No hay recursos disponibles</p>
                            <p class="text-sm text-gray-400">El equipo aún no ha agregado enlaces</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Columna lateral -->
        <div class="space-y-6">
            <!-- Información del evento -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Evento</h2>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-500">Nombre</p>
                        <p class="font-semibold text-gray-900">{{ $proyecto->event->title }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Fecha inicio</p>
                        <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($proyecto->event->event_start_date)->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Fecha fin</p>
                        <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($proyecto->event->event_end_date)->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Puntuación -->
            @if($proyecto->final_score)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Evaluación</h2>
                <div class="text-center">
                    <div class="text-5xl font-bold text-gray-900 mb-2">{{ $proyecto->final_score }}</div>
                    <p class="text-sm text-gray-500">Puntuación final</p>
                    @if($proyecto->rank)
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-2xl font-bold text-blue-600">#{{ $proyecto->rank }}</p>
                        <p class="text-sm text-gray-500">Posición en ranking</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Fechas del proyecto -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Información</h2>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-500">Creado</p>
                        <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($proyecto->created_at)->format('d/m/Y H:i') }}</p>
                    </div>
                    @if($proyecto->submitted_at)
                    <div>
                        <p class="text-gray-500">Entregado</p>
                        <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($proyecto->submitted_at)->format('d/m/Y H:i') }}</p>
                    </div>
                    @endif
                    <div>
                        <p class="text-gray-500">Última actualización</p>
                        <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($proyecto->updated_at)->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
