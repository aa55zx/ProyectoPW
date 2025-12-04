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
    <form method="POST" action="{{ route('juez.guardar-evaluacion', $project->id) }}" class="space-y-8">
        @csrf
        
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Criterios de Evaluación</h2>
            
            @if($rubric && $rubric->criteria->isNotEmpty())
                <div class="space-y-8" x-data="evaluationForm()">
                    @foreach($rubric->criteria as $criterion)
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex-1">
                                    <label class="text-lg font-semibold text-gray-900 block mb-1">
                                        {{ $criterion->name }}
                                    </label>
                                    @if($criterion->description)
                                        <p class="text-sm text-gray-600">{{ $criterion->description }}</p>
                                    @endif
                                </div>
                                <div class="text-right ml-4">
                                    <span class="text-3xl font-bold text-indigo-600" 
                                          x-text="scores.criterion_{{ $criterion->id }}">
                                        {{ $criterion->max_points / 2 }}
                                    </span>
                                    <span class="text-lg text-gray-500">/{{ $criterion->max_points }}</span>
                                </div>
                            </div>
                            
                            <div class="relative">
                                <input type="range" 
                                       name="scores[{{ $criterion->id }}]"
                                       x-model="scores.criterion_{{ $criterion->id }}"
                                       min="0" 
                                       max="{{ $criterion->max_points }}" 
                                       value="{{ $criterion->max_points / 2 }}"
                                       step="0.5"
                                       class="w-full h-3 bg-gray-200 rounded-full appearance-none cursor-pointer slider"
                                       required>
                                <div class="flex justify-between text-xs text-gray-500 mt-2">
                                    <span>0</span>
                                    <span>{{ number_format($criterion->max_points / 4, 1) }}</span>
                                    <span>{{ number_format($criterion->max_points / 2, 1) }}</span>
                                    <span>{{ number_format(($criterion->max_points * 3) / 4, 1) }}</span>
                                    <span>{{ $criterion->max_points }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Área de Comentarios -->
                    <div class="pt-6 border-t border-gray-100">
                        <label class="text-lg font-semibold text-gray-900 block mb-3">
                            Comentarios y Retroalimentación
                        </label>
                        <textarea name="comments" 
                                  rows="6" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none @error('comments') border-red-500 @enderror"
                                  placeholder="Proporciona retroalimentación constructiva para el equipo...">{{ old('comments') }}</textarea>
                        @error('comments')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-sm text-gray-500 mt-2">Máximo 1000 caracteres</p>
                    </div>

                    <!-- Resumen de Calificación -->
                    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-6 border border-indigo-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">Calificación Total</p>
                                <p class="text-4xl font-bold text-indigo-600" x-text="totalScore().toFixed(1)">
                                    {{ number_format($rubric->criteria->sum('max_points') / 2, 1) }}
                                </p>
                                <p class="text-sm text-gray-500 mt-1">de {{ $rubric->criteria->sum('max_points') }} puntos posibles</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-600">Evaluación basada en</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $rubric->criteria->count() }} criterios</p>
                            </div>
                        </div>
                    </div>

                    @if($errors->any())
                        <div class="bg-red-50 border border-red-200 rounded-xl p-4">
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
                    <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                        <a href="{{ route('juez.evaluaciones') }}" 
                           class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-xl transition-all duration-300">
                            Cancelar
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
function evaluationForm() {
    return {
        scores: {
            @foreach($rubric->criteria as $criterion)
                criterion_{{ $criterion->id }}: {{ $criterion->max_points / 2 }},
            @endforeach
        },
        totalScore() {
            const values = Object.values(this.scores);
            const sum = values.reduce((a, b) => parseFloat(a) + parseFloat(b), 0);
            return sum;
        }
    }
}
</script>

<style>
/* Estilo personalizado para el slider */
input[type="range"].slider::-webkit-slider-thumb {
    appearance: none;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: #6366f1;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    transition: all 0.2s;
}

input[type="range"].slider::-webkit-slider-thumb:hover {
    background: #4f46e5;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    transform: scale(1.1);
}

input[type="range"].slider::-moz-range-thumb {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: #6366f1;
    cursor: pointer;
    border: none;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    transition: all 0.2s;
}

input[type="range"].slider::-moz-range-thumb:hover {
    background: #4f46e5;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    transform: scale(1.1);
}

input[type="range"].slider::-webkit-slider-runnable-track {
    background: linear-gradient(to right, 
        #ef4444 0%, 
        #f59e0b 25%, 
        #eab308 50%, 
        #84cc16 75%, 
        #22c55e 100%);
    height: 12px;
    border-radius: 6px;
}

input[type="range"].slider::-moz-range-track {
    background: linear-gradient(to right, 
        #ef4444 0%, 
        #f59e0b 25%, 
        #eab308 50%, 
        #84cc16 75%, 
        #22c55e 100%);
    height: 12px;
    border-radius: 6px;
}
</style>
@endif
@endsection
