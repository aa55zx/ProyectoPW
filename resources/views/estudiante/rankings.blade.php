@extends('layouts.estudiante')

@section('title', 'Rankings - EventTec')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Rankings</h1>
        <p class="text-gray-600 text-lg">Clasificaciones y resultados de eventos</p>
    </div>

    <!-- Selector de Evento -->
    <div class="mb-6">
        <select id="event-selector" class="px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 font-medium bg-white">
            @foreach($eventos as $evento)
                <option value="{{ $evento->id }}" {{ $eventoSeleccionado && $eventoSeleccionado->id === $evento->id ? 'selected' : '' }}>
                    {{ $evento->title }} ({{ $evento->projects_count }} proyectos)
                </option>
            @endforeach
        </select>
    </div>

    @if($eventoSeleccionado && $proyectosRanking->count() > 0)
        <!-- Podio Top 3 -->
        @if($top3->count() >= 3)
            <div class="mb-8">
                <div class="grid grid-cols-3 gap-6 max-w-4xl mx-auto">
                    <!-- 2do Lugar -->
                    <div class="order-1 flex flex-col items-center">
                        <div class="relative mb-4">
                            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center text-white text-3xl font-bold shadow-lg">
                                {{ strtoupper(substr($top3[1]->team->name, 0, 2)) }}
                            </div>
                            <div class="absolute -top-2 -right-2 w-10 h-10 bg-gray-400 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                                2
                            </div>
                        </div>
                        <div class="bg-white rounded-xl p-6 text-center shadow-sm border-2 border-gray-300 w-full">
                            <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <h3 class="font-bold text-gray-900 mb-1">{{ $top3[1]->team->name }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ Str::limit($top3[1]->title, 30) }}</p>
                            <div class="text-3xl font-bold text-gray-900 mb-1">{{ $top3[1]->final_score }}</div>
                            <div class="text-xs text-gray-500">puntos</div>
                            @if($top3[1]->team->leader)
                                <div class="mt-3 pt-3 border-t border-gray-200">
                                    <p class="text-xs text-gray-600">Líder: {{ $top3[1]->team->leader->name }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- 1er Lugar -->
                    <div class="order-2 flex flex-col items-center -mt-8">
                        <div class="relative mb-4">
                            <div class="w-32 h-32 rounded-full bg-gradient-to-br from-yellow-300 to-yellow-500 flex items-center justify-center text-white text-4xl font-bold shadow-xl">
                                {{ strtoupper(substr($top3[0]->team->name, 0, 2)) }}
                            </div>
                            <div class="absolute -top-3 -right-3 w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                                1
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl p-6 text-center shadow-md border-2 border-yellow-400 w-full">
                            <svg class="w-10 h-10 text-yellow-500 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <div class="inline-block px-3 py-1 bg-yellow-500 text-white text-xs font-bold rounded-full mb-2">
                                🏆 GANADOR
                            </div>
                            <h3 class="font-bold text-gray-900 mb-1 text-lg">{{ $top3[0]->team->name }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ Str::limit($top3[0]->title, 30) }}</p>
                            <div class="text-4xl font-bold text-yellow-600 mb-1">{{ $top3[0]->final_score }}</div>
                            <div class="text-xs text-gray-600">puntos</div>
                            @if($top3[0]->team->leader)
                                <div class="mt-3 pt-3 border-t border-yellow-300">
                                    <p class="text-xs text-gray-700 font-medium">Líder: {{ $top3[0]->team->leader->name }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- 3er Lugar -->
                    <div class="order-3 flex flex-col items-center">
                        <div class="relative mb-4">
                            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-orange-300 to-orange-500 flex items-center justify-center text-white text-3xl font-bold shadow-lg">
                                {{ strtoupper(substr($top3[2]->team->name, 0, 2)) }}
                            </div>
                            <div class="absolute -top-2 -right-2 w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                                3
                            </div>
                        </div>
                        <div class="bg-white rounded-xl p-6 text-center shadow-sm border-2 border-orange-300 w-full">
                            <svg class="w-8 h-8 text-orange-500 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <h3 class="font-bold text-gray-900 mb-1">{{ $top3[2]->team->name }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ Str::limit($top3[2]->title, 30) }}</p>
                            <div class="text-3xl font-bold text-gray-900 mb-1">{{ $top3[2]->final_score }}</div>
                            <div class="text-xs text-gray-500">puntos</div>
                            @if($top3[2]->team->leader)
                                <div class="mt-3 pt-3 border-t border-gray-200">
                                    <p class="text-xs text-gray-600">Líder: {{ $top3[2]->team->leader->name }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Tabla de Clasificación Completa -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-900">Tabla de Clasificación Completa</h2>
                <p class="text-sm text-gray-600">{{ $proyectosRanking->count() }} equipos participaron en {{ $eventoSeleccionado->title }}</p>
            </div>

            <!-- Buscador -->
            <div class="p-4 bg-gray-50 border-b border-gray-200">
                <input type="text" 
                       id="search-ranking" 
                       placeholder="Buscar equipo o proyecto..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posición</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Equipo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Proyecto</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Puntuación</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Premio</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="ranking-tbody">
                        @foreach($proyectosRanking as $proyecto)
                            @php
                                $esMiProyecto = false;
                                foreach($proyecto->team->members as $member) {
                                    if($member->id === auth()->id()) {
                                        $esMiProyecto = true;
                                        break;
                                    }
                                }
                            @endphp
                            <tr class="ranking-row hover:bg-gray-50 transition-colors {{ $esMiProyecto ? 'bg-blue-50' : '' }}" 
                                data-search="{{ strtolower($proyecto->team->name . ' ' . $proyecto->title) }}">
                                <!-- Posición -->
                                <td class="px-6 py-4 whitespace-nowrap">
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
                                        <span class="text-lg font-bold text-gray-900">#{{ $proyecto->rank }}</span>
                                    </div>
                                </td>

                                <!-- Equipo -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm">
                                            {{ strtoupper(substr($proyecto->team->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $proyecto->team->name }}</div>
                                            @if($proyecto->team->leader)
                                                <div class="text-xs text-gray-500">{{ $proyecto->team->leader->name }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <!-- Proyecto -->
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">{{ $proyecto->title }}</div>
                                    <div class="text-sm text-gray-500">{{ Str::limit($proyecto->description, 50) }}</div>
                                </td>

                                <!-- Puntuación -->
                                <td class="px-6 py-4 text-center">
                                    <span class="text-2xl font-bold text-gray-900">{{ $proyecto->final_score }}</span>
                                    <div class="text-xs text-gray-500">puntos</div>
                                </td>

                                <!-- Premio -->
                                <td class="px-6 py-4 text-center">
                                    @if($proyecto->rank === 1)
                                        <span class="font-semibold text-green-600">$20,000 MXN</span>
                                    @elseif($proyecto->rank === 2)
                                        <span class="font-semibold text-gray-600">$10,000 MXN</span>
                                    @elseif($proyecto->rank === 3)
                                        <span class="font-semibold text-orange-600">$5,000 MXN</span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>

                                <!-- Acciones -->
                                <td class="px-6 py-4 text-right">
                                    @if($esMiProyecto)
                                        <a href="{{ route('estudiante.proyectos.show', $proyecto->id) }}" 
                                           class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                            Ver Detalles
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center gap-3 mb-2">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <div>
                        <div class="text-3xl font-bold text-gray-900">{{ $stats['total_equipos'] }}</div>
                        <div class="text-sm text-gray-600">Equipos</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center gap-3 mb-2">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <div>
                        <div class="text-3xl font-bold text-gray-900">{{ $stats['proyectos_participados'] }}</div>
                        <div class="text-sm text-gray-600">Proyectos</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center gap-3 mb-2">
                    <svg class="w-8 h-8 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <div>
                        <div class="text-3xl font-bold text-gray-900">{{ $stats['puntuacion_maxima'] }}</div>
                        <div class="text-sm text-gray-600">Máxima</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center gap-3 mb-2">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <div>
                        <div class="text-3xl font-bold text-gray-900">{{ $stats['criterios_evaluados'] }}</div>
                        <div class="text-sm text-gray-600">Criterios</div>
                    </div>
                </div>
            </div>
        </div>

    @else
        <!-- Mensaje cuando no hay rankings -->
        <div class="text-center py-16">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            <h3 class="text-xl font-bold text-gray-900 mb-2">No hay rankings disponibles</h3>
            <p class="text-gray-600">Los proyectos aún no han sido evaluados</p>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cambiar evento
    const eventSelector = document.getElementById('event-selector');
    if (eventSelector) {
        eventSelector.addEventListener('change', function() {
            window.location.href = '?event_id=' + this.value;
        });
    }
    
    // Buscador
    const searchInput = document.getElementById('search-ranking');
    const rows = document.querySelectorAll('.ranking-row');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const search = this.value.toLowerCase();
            
            rows.forEach(row => {
                const searchText = row.dataset.search;
                if (searchText.includes(search)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
});
</script>
@endsection
