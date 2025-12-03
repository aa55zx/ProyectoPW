@extends('layouts.estudiante')

@section('title', 'Dashboard - EventTec')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header con saludo -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">
            ¡Hola, {{ explode(' ', $user->name)[0] }}! 👋
        </h1>
        <p class="text-gray-600 text-lg">Aquí está tu resumen de actividades</p>
    </div>

    <!-- Estadísticas principales -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Equipos -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <span class="text-3xl font-bold">{{ $stats['total_equipos'] }}</span>
            </div>
            <p class="text-white/90 font-medium">Mis Equipos</p>
        </div>

        <!-- Total Proyectos -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <span class="text-3xl font-bold">{{ $stats['total_proyectos'] }}</span>
            </div>
            <p class="text-white/90 font-medium">Proyectos</p>
        </div>

        <!-- Promedio -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                </div>
                <span class="text-3xl font-bold">{{ $stats['promedio_puntuacion'] }}</span>
            </div>
            <p class="text-white/90 font-medium">Promedio</p>
        </div>

        <!-- Mejor Posición -->
        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                </div>
                <span class="text-3xl font-bold">#{{ $stats['mejor_posicion'] }}</span>
            </div>
            <p class="text-white/90 font-medium">Mejor Posición</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Columna Principal -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Proyecto Destacado -->
            @if($proyectoDestacado)
                <div class="bg-gradient-to-br from-gray-900 via-blue-900 to-gray-900 rounded-2xl p-8 text-white shadow-xl relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute inset-0" style="background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&q=80'); background-size: cover;"></div>
                    </div>
                    <div class="relative">
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <span class="text-yellow-400 font-bold">Tu Mejor Proyecto</span>
                        </div>
                        <h3 class="text-3xl font-bold mb-2">{{ $proyectoDestacado->title }}</h3>
                        <p class="text-white/80 mb-4">{{ Str::limit($proyectoDestacado->description, 100) }}</p>
                        <div class="flex items-center gap-6 mb-4">
                            <div class="flex items-center gap-2">
                                <span class="text-5xl font-bold text-yellow-400">{{ $proyectoDestacado->final_score }}</span>
                                <span class="text-white/60">/100</span>
                            </div>
                            @if($proyectoDestacado->rank)
                                <div class="text-center">
                                    <div class="text-3xl font-bold">#{{ $proyectoDestacado->rank }}</div>
                                    <div class="text-sm text-white/60">Posición</div>
                                </div>
                            @endif
                        </div>
                        <a href="{{ route('estudiante.proyectos.show', $proyectoDestacado->id) }}" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-white text-gray-900 rounded-lg font-medium hover:bg-gray-100 transition-colors">
                            Ver proyecto
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endif

            <!-- Mis Equipos -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-900">Mis Equipos</h2>
                    <a href="{{ route('estudiante.equipos') }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                        Ver todos →
                    </a>
                </div>
                <div class="p-6">
                    @if($equipos->count() > 0)
                        <div class="space-y-4">
                            @foreach($equipos->take(3) as $equipo)
                                <a href="{{ route('estudiante.equipos.show', $equipo->id) }}" 
                                   class="block p-4 border border-gray-200 rounded-xl hover:border-blue-300 hover:shadow-sm transition-all">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-12 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold">
                                                {{ strtoupper(substr($equipo->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <h3 class="font-bold text-gray-900">{{ $equipo->name }}</h3>
                                                <p class="text-sm text-gray-600">{{ $equipo->event->title }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-sm text-gray-600">{{ $equipo->members_count }} miembros</div>
                                            @if($equipo->leader_id === $user->id)
                                                <span class="inline-block px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full mt-1">Líder</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <p class="text-gray-600 mb-4">No tienes equipos aún</p>
                            <a href="{{ route('estudiante.equipos') }}" 
                               class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Crear equipo
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Mis Proyectos -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-900">Mis Proyectos</h2>
                    <a href="{{ route('estudiante.proyectos') }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                        Ver todos →
                    </a>
                </div>
                <div class="p-6">
                    @if($proyectos->count() > 0)
                        <div class="space-y-4">
                            @foreach($proyectos->take(3) as $proyecto)
                                <a href="{{ route('estudiante.proyectos.show', $proyecto->id) }}" 
                                   class="block p-4 border border-gray-200 rounded-xl hover:border-blue-300 hover:shadow-sm transition-all">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-2">
                                                <h3 class="font-bold text-gray-900">{{ $proyecto->title }}</h3>
                                                @if($proyecto->status === 'evaluated')
                                                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Evaluado</span>
                                                @elseif($proyecto->status === 'submitted')
                                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">Entregado</span>
                                                @else
                                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">En progreso</span>
                                                @endif
                                            </div>
                                            <p class="text-sm text-gray-600 mb-2">{{ Str::limit($proyecto->description, 60) }}</p>
                                            <p class="text-xs text-gray-500">{{ $proyecto->team->name }} • {{ $proyecto->team->event->title }}</p>
                                        </div>
                                        @if($proyecto->final_score)
                                            <div class="text-right ml-4">
                                                <div class="text-2xl font-bold text-gray-900">{{ $proyecto->final_score }}</div>
                                                <div class="text-xs text-gray-500">puntos</div>
                                            </div>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="text-gray-600 mb-4">No tienes proyectos aún</p>
                            <a href="{{ route('estudiante.proyectos') }}" 
                               class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Crear proyecto
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Columna Lateral -->
        <div class="space-y-8">
            <!-- Eventos Activos -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-bold text-gray-900">Eventos Activos</h2>
                </div>
                <div class="p-6">
                    @if($eventosActivos->count() > 0)
                        <div class="space-y-4">
                            @foreach($eventosActivos as $evento)
                                <a href="{{ route('estudiante.evento-detalle', $evento->id) }}" 
                                   class="block p-4 border border-gray-200 rounded-xl hover:border-green-300 hover:shadow-sm transition-all">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">En curso</span>
                                        <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs font-semibold rounded-full">{{ $evento->category }}</span>
                                    </div>
                                    <h3 class="font-bold text-gray-900 mb-1">{{ $evento->title }}</h3>
                                    <p class="text-xs text-gray-600">
                                        <svg class="w-3 h-3 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($evento->event_start_date)->format('d M Y') }}
                                    </p>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-500 text-sm py-4">No hay eventos activos</p>
                    @endif
                    <a href="{{ route('estudiante.eventos') }}" 
                       class="block mt-4 text-center text-blue-600 hover:text-blue-700 font-medium text-sm">
                        Ver todos los eventos →
                    </a>
                </div>
            </div>

            <!-- Actividad Reciente -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-bold text-gray-900">Actividad Reciente</h2>
                </div>
                <div class="p-6">
                    @if($actividadReciente->count() > 0)
                        <div class="space-y-4">
                            @foreach($actividadReciente as $actividad)
                                <div class="flex gap-3">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        @if($actividad['icono'] === 'users')
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $actividad['titulo'] }}</p>
                                        <p class="text-xs text-gray-600">{{ $actividad['descripcion'] }}</p>
                                        <p class="text-xs text-gray-400 mt-1">{{ $actividad['fecha']->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-500 text-sm py-4">No hay actividad reciente</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
