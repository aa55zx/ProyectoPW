@extends('layouts.juez')

@section('title', 'Evaluar Proyecto - EvenTec')
@section('breadcrumb', 'Evaluaciones > Evaluar Proyecto')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Encabezado del Proyecto -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-8">
        <div class="flex items-start justify-between mb-6">
            <div class="flex-1">
                <h1 class="text-3xl font-bold text-gray-900 mb-3">{{ $project->title }}</h1>
                <div class="flex flex-wrap items-center gap-6 text-sm text-gray-600">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="font-medium">Equipo: {{ $project->team->name }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="font-medium">Líder: {{ $project->team->leader->name }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-medium">Evento: {{ $project->event->title }}</span>
                    </div>
                </div>
            </div>
            <span class="px-4 py-2 bg-yellow-100 text-yellow-700 text-sm font-semibold rounded-xl">Pendiente</span>
        </div>

        @if($project->team->members->isNotEmpty())
            <div class="mb-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">Miembros del Equipo</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($project->team->members as $member)
                        <span class="px-3 py-1.5 bg-gray-100 text-gray-700 text-sm rounded-full">
                            {{ $member->name }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Descripción del Proyecto -->
        <div class="bg-gray-50 rounded-xl p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-3">Descripción del Proyecto</h3>
            @if($project->description)
                <p class="text-gray-700 leading-relaxed mb-4">{{ $project->description }}</p>
            @else
                <p class="text-gray-500 italic">No hay descripción disponible</p>
            @endif
            
            @if($project->demo_url || $project->repository_url || $project->presentation_url)
                <div class="flex flex-wrap items-center gap-4 mt-4">
                    @if($project->presentation_url)
                        <a href="{{ $project->presentation_url }}" 
                           target="_blank"
                           class="text-indigo-600 hover:text-indigo-700 font-medium flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Ver presentación
                        </a>
                    @endif
                    
                    @if($project->demo_url)
                        <a href="{{ $project->demo_url }}" 
                           target="_blank"
                           class="text-indigo-600 hover:text-indigo-700 font-medium flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            Ver demo en vivo
                        </a>
                    @endif
                    
                    @if($project->repository_url)
                        <a href="{{ $project->repository_url }}" 
                           target="_blank"
                           class="text-indigo-600 hover:text-indigo-700 font-medium flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                            </svg>
                            Ver repositorio
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- Formulario de Evaluación -->
    <form method="POST" action="{{ route('juez.guardar-evaluacion', $project->id) }}" id="evaluationForm" class="space-y-8">
        @csrf
        
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Criterios de Evaluación</h2>
            
            @if($rubric && $rubric->criteria->isNotEmpty())
                <div class="space-y-6">
                    @foreach($rubric->criteria as $index => $criterion)
                        <div class="bg-gray-50 rounded-xl p-6 border border-gray-200 hover:border-indigo-300 transition-all">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <span class="flex items-center justify-center w-8 h-8 bg-indigo-600 text-white font-bold rounded-full text-sm">
                                            {{ $index + 1 }}
                                        </span>
                                        <label class="text-xl font-bold text-gray-900">
                                            {{ $criterion->name }}
                                        </label>
                                    </div>
                                    @if($criterion->description)
                                        <p class="text-sm text-gray-600 ml-11">{{ $criterion->description }}</p>
                                    @endif
                                </div>
                                <div class="text-right ml-4">
                                    <p class="text-xs text-gray-500 mb-1">Puntos máximos</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $criterion->max_points }}</p>
                                </div>
                            </div>

                            <div class="ml-11 flex items-center gap-4">
                                <!-- Input de puntuación -->
                                <div class="flex-1">
                                    <div class="flex items-center gap-3">
                                        <input type="number" 
                                               name="scores[{{ $criterion->id }}]"
                                               id="score_{{ $criterion->id }}"
                                               min="0" 
                                               max="{{ $criterion->max_points }}" 
                                               step="0.5"
                                               value="{{ $criterion->max_points / 2 }}"
                                               onchange="updateScores()"
                                               oninput="updateScores()"
                                               class="w-32 px-4 py-3 text-2xl font-bold text-center border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('scores.'.$criterion->id) border-red-500 @enderror"
                                               required>
                                        
                                        <div class="flex flex-col gap-2">
                                            <button type="button" 
                                                    onclick="incrementScore('{{ $criterion->id }}', {{ $criterion->max_points }})"
                                                    class="px-3 py-1 bg-indigo-100 hover:bg-indigo-200 text-indigo-700 rounded-lg transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                                </svg>
                                            </button>
                                            <button type="button" 
                                                    onclick="decrementScore('{{ $criterion->id }}')"
                                                    class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Botones rápidos -->
                                        <div class="flex gap-2 ml-4">
                                            <button type="button" 
                                                    onclick="setScore('{{ $criterion->id }}', 0)"
                                                    class="px-3 py-2 text-xs font-semibold bg-red-100 hover:bg-red-200 text-red-700 rounded-lg transition-colors">
                                                0
                                            </button>
                                            <button type="button" 
                                                    onclick="setScore('{{ $criterion->id }}', {{ $criterion->max_points / 4 }})"
                                                    class="px-3 py-2 text-xs font-semibold bg-orange-100 hover:bg-orange-200 text-orange-700 rounded-lg transition-colors">
                                                25%
                                            </button>
                                            <button type="button" 
                                                    onclick="setScore('{{ $criterion->id }}', {{ $criterion->max_points / 2 }})"
                                                    class="px-3 py-2 text-xs font-semibold bg-yellow-100 hover:bg-yellow-200 text-yellow-700 rounded-lg transition-colors">
                                                50%
                                            </button>
                                            <button type="button" 
                                                    onclick="setScore('{{ $criterion->id }}', {{ ($criterion->max_points * 3) / 4 }})"
                                                    class="px-3 py-2 text-xs font-semibold bg-lime-100 hover:bg-lime-200 text-lime-700 rounded-lg transition-colors">
                                                75%
                                            </button>
                                            <button type="button" 
                                                    onclick="setScore('{{ $criterion->id }}', {{ $criterion->max_points }})"
                                                    class="px-3 py-2 text-xs font-semibold bg-green-100 hover:bg-green-200 text-green-700 rounded-lg transition-colors">
                                                100%
                                            </button>
                                        </div>
                                    </div>
                                    @error('scores.'.$criterion->id)
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Barra de progreso visual -->
                            <div class="ml-11 mt-4">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div id="progress_{{ $criterion->id }}" 
                                         class="h-full rounded-full transition-all duration-300 bg-gradient-to-r from-red-500 via-yellow-500 to-green-500" 
                                         style="width: 50%"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Área de Comentarios -->
                    <div class="pt-6 border-t-2 border-gray-200">
                        <label class="text-lg font-semibold text-gray-900 block mb-3">
                            💬 Comentarios y Retroalimentación
                        </label>
                        <textarea name="comments" 
                                  rows="6" 
                                  class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-none @error('comments') border-red-500 @enderror"
                                  placeholder="Proporciona retroalimentación constructiva y detallada para el equipo...">{{ old('comments') }}</textarea>
                        @error('comments')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-sm text-gray-500 mt-2">Máximo 1000 caracteres</p>
                    </div>

                    <!-- Resumen de Calificación -->
                    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-6 border-2 border-indigo-200">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">📊 Resumen de Evaluación</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-white rounded-xl p-4 shadow-sm">
                                <p class="text-sm font-medium text-gray-600 mb-1">Puntaje Obtenido</p>
                                <p id="totalRawScore" class="text-3xl font-bold text-gray-900">{{ number_format($rubric->criteria->sum('max_points') / 2, 1) }}</p>
                                <p class="text-xs text-gray-500 mt-1">de {{ $rubric->criteria->sum('max_points') }} puntos</p>
                            </div>

                            <div class="bg-white rounded-xl p-4 shadow-sm">
                                <p class="text-sm font-medium text-gray-600 mb-1">Calificación Final</p>
                                <p id="normalizedScore" class="text-3xl font-bold text-indigo-600">50.0</p>
                                <p class="text-xs text-gray-500 mt-1">de 100 puntos</p>
                            </div>

                            <div class="bg-white rounded-xl p-4 shadow-sm">
                                <p class="text-sm font-medium text-gray-600 mb-1">Porcentaje</p>
                                <p id="percentageScore" class="text-3xl font-bold text-purple-600">50%</p>
                                <p class="text-xs text-gray-500 mt-1">del total</p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="flex items-center justify-between text-xs text-gray-600 mb-2">
                                <span>Progreso de Evaluación</span>
                                <span id="progressText">50.0%</span>
                            </div>
                            <div class="w-full bg-white rounded-full h-3 overflow-hidden shadow-inner">
                                <div id="totalProgress" 
                                     class="h-full bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-500 rounded-full" 
                                     style="width: 50%"></div>
                            </div>
                        </div>
                    </div>

                    @if($errors->any())
                        <div class="bg-red-50 border-2 border-red-200 rounded-xl p-4">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-red-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-red-900 mb-1">Por favor corrige los siguientes errores:</p>
                                    <ul class="list-disc list-inside text-sm text-red-700">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Botones de Acción -->
                    <div class="flex items-center justify-between pt-6 border-t-2 border-gray-200">
                        <a href="{{ route('juez.evaluaciones') }}" 
                           class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-xl transition-all duration-300">
                            ← Cancelar
                        </a>
                        <button type="submit" 
                                class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-md hover:shadow-lg flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Guardar Evaluación
                        </button>
                    </div>
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No hay criterios de evaluación</h3>
                    <p class="text-gray-600">Este evento no tiene una rúbrica configurada.</p>
                    <a href="{{ route('juez.evaluaciones') }}" 
                       class="inline-block mt-4 px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-xl transition-all">
                        Volver a evaluaciones
                    </a>
                </div>
            @endif
        </div>
    </form>
</div>

@if($rubric && $rubric->criteria->isNotEmpty())
<script>
// Configuración de criterios
const criteriaConfig = {
    @foreach($rubric->criteria as $criterion)
        '{{ $criterion->id }}': {
            maxPoints: {{ $criterion->max_points }},
            weight: {{ $criterion->max_points }}
        },
    @endforeach
};

const maxTotalPoints = {{ $rubric->criteria->sum('max_points') }};

// Función para incrementar score
function incrementScore(criterionId, maxPoints) {
    const input = document.getElementById('score_' + criterionId);
    let currentValue = parseFloat(input.value) || 0;
    let newValue = Math.min(currentValue + 0.5, maxPoints);
    input.value = newValue.toFixed(1);
    updateScores();
}

// Función para decrementar score
function decrementScore(criterionId) {
    const input = document.getElementById('score_' + criterionId);
    let currentValue = parseFloat(input.value) || 0;
    let newValue = Math.max(currentValue - 0.5, 0);
    input.value = newValue.toFixed(1);
    updateScores();
}

// Función para establecer score directamente
function setScore(criterionId, value) {
    const input = document.getElementById('score_' + criterionId);
    input.value = parseFloat(value).toFixed(1);
    updateScores();
}

// Función principal para actualizar todos los scores
function updateScores() {
    let totalRaw = 0;
    
    // Calcular puntaje total y actualizar barras de progreso
    Object.keys(criteriaConfig).forEach(criterionId => {
        const input = document.getElementById('score_' + criterionId);
        const progress = document.getElementById('progress_' + criterionId);
        
        if (input && progress) {
            const value = parseFloat(input.value) || 0;
            const maxPoints = criteriaConfig[criterionId].maxPoints;
            
            // Validar que no exceda el máximo
            if (value > maxPoints) {
                input.value = maxPoints.toFixed(1);
            }
            
            // Validar que no sea negativo
            if (value < 0) {
                input.value = '0.0';
            }
            
            const validValue = parseFloat(input.value);
            totalRaw += validValue;
            
            // Actualizar barra de progreso individual
            const percentage = (validValue / maxPoints) * 100;
            progress.style.width = percentage + '%';
        }
    });
    
    // Calcular score normalizado
    const normalizedScore = maxTotalPoints > 0 ? (totalRaw / maxTotalPoints) * 100 : 0;
    
    // Actualizar displays
    document.getElementById('totalRawScore').textContent = totalRaw.toFixed(1);
    document.getElementById('normalizedScore').textContent = normalizedScore.toFixed(1);
    document.getElementById('percentageScore').textContent = normalizedScore.toFixed(0) + '%';
    document.getElementById('progressText').textContent = normalizedScore.toFixed(1) + '%';
    document.getElementById('totalProgress').style.width = normalizedScore + '%';
}

// Inicializar scores al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    updateScores();
});
</script>
@endif
@endsection
