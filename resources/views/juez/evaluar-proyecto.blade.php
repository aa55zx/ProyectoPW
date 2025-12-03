@extends('layouts.juez')

@section('title', 'Evaluar Proyecto - EvenTec')
@section('breadcrumb', 'Evaluaciones > Evaluar Proyecto')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Encabezado del Proyecto -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-8">
        <div class="flex items-start justify-between mb-6">
            <div class="flex-1">
                <h1 class="text-3xl font-bold text-gray-900 mb-3">EcoTrack - Monitoreo Ambiental Inteligente</h1>
                <div class="flex items-center gap-6 text-sm text-gray-600">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="font-medium">Equipo: Tech Innovators</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-medium">Evento: Hackathon Innovación 2024</span>
                    </div>
                </div>
            </div>
            <span class="px-4 py-2 bg-yellow-100 text-yellow-700 text-sm font-semibold rounded-xl">Pendiente</span>
        </div>

        <!-- Descripción del Proyecto -->
        <div class="bg-gray-50 rounded-xl p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-3">Descripción del Proyecto</h3>
            <p class="text-gray-700 leading-relaxed mb-4">
                EcoTrack es una plataforma inteligente de monitoreo ambiental que utiliza sensores IoT y machine learning para detectar y predecir problemas ambientales en tiempo real. El sistema recopila datos de calidad del aire, nivel de ruido, temperatura y humedad, proporcionando alertas tempranas a las autoridades y ciudadanos.
            </p>
            <div class="flex items-center gap-4">
                <button class="text-indigo-600 hover:text-indigo-700 font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Ver documentación
                </button>
                <button class="text-indigo-600 hover:text-indigo-700 font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    Ver demo en vivo
                </button>
            </div>
        </div>
    </div>

    <!-- Formulario de Evaluación -->
    <form action="{{ route('juez.guardar-evaluacion', $id) }}" method="POST">
        @csrf
        
        <!-- Criterios de Evaluación -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Criterios de Evaluación</h2>
            
            <div class="space-y-8">
                <!-- Criterio 1: Innovación -->
                <div class="border-b border-gray-100 pb-8 last:border-0 last:pb-0">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Innovación</h3>
                            <p class="text-sm text-gray-600">Originalidad de la idea, creatividad en la solución y aporte innovador al campo.</p>
                        </div>
                        <div class="text-right">
                            <span class="text-3xl font-bold text-indigo-600" id="innovacion-value">0</span>
                            <span class="text-gray-500 text-lg">/100</span>
                        </div>
                    </div>
                    <input type="range" 
                           name="innovacion" 
                           min="0" 
                           max="100" 
                           value="0" 
                           class="w-full h-3 bg-gray-200 rounded-lg appearance-none cursor-pointer slider"
                           oninput="document.getElementById('innovacion-value').textContent = this.value"
                           style="accent-color: #4f46e5;">
                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                        <span>Insuficiente</span>
                        <span>Regular</span>
                        <span>Bueno</span>
                        <span>Excelente</span>
                    </div>
                </div>

                <!-- Criterio 2: Viabilidad -->
                <div class="border-b border-gray-100 pb-8 last:border-0 last:pb-0">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Viabilidad</h3>
                            <p class="text-sm text-gray-600">Posibilidad de implementación real, sostenibilidad y escalabilidad de la solución.</p>
                        </div>
                        <div class="text-right">
                            <span class="text-3xl font-bold text-indigo-600" id="viabilidad-value">0</span>
                            <span class="text-gray-500 text-lg">/100</span>
                        </div>
                    </div>
                    <input type="range" 
                           name="viabilidad" 
                           min="0" 
                           max="100" 
                           value="0" 
                           class="w-full h-3 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                           oninput="document.getElementById('viabilidad-value').textContent = this.value"
                           style="accent-color: #4f46e5;">
                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                        <span>Insuficiente</span>
                        <span>Regular</span>
                        <span>Bueno</span>
                        <span>Excelente</span>
                    </div>
                </div>

                <!-- Criterio 3: Presentación -->
                <div class="border-b border-gray-100 pb-8 last:border-0 last:pb-0">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Presentación</h3>
                            <p class="text-sm text-gray-600">Calidad de la documentación, claridad en la exposición y material de apoyo.</p>
                        </div>
                        <div class="text-right">
                            <span class="text-3xl font-bold text-indigo-600" id="presentacion-value">0</span>
                            <span class="text-gray-500 text-lg">/100</span>
                        </div>
                    </div>
                    <input type="range" 
                           name="presentacion" 
                           min="0" 
                           max="100" 
                           value="0" 
                           class="w-full h-3 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                           oninput="document.getElementById('presentacion-value').textContent = this.value"
                           style="accent-color: #4f46e5;">
                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                        <span>Insuficiente</span>
                        <span>Regular</span>
                        <span>Bueno</span>
                        <span>Excelente</span>
                    </div>
                </div>

                <!-- Criterio 4: Impacto -->
                <div class="border-b border-gray-100 pb-8 last:border-0 last:pb-0">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Impacto</h3>
                            <p class="text-sm text-gray-600">Relevancia del problema resuelto, beneficio social y potencial de transformación.</p>
                        </div>
                        <div class="text-right">
                            <span class="text-3xl font-bold text-indigo-600" id="impacto-value">0</span>
                            <span class="text-gray-500 text-lg">/100</span>
                        </div>
                    </div>
                    <input type="range" 
                           name="impacto" 
                           min="0" 
                           max="100" 
                           value="0" 
                           class="w-full h-3 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                           oninput="document.getElementById('impacto-value').textContent = this.value"
                           style="accent-color: #4f46e5;">
                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                        <span>Insuficiente</span>
                        <span>Regular</span>
                        <span>Bueno</span>
                        <span>Excelente</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comentarios -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Comentarios y Retroalimentación</h2>
            <p class="text-sm text-gray-600 mb-4">Proporciona comentarios constructivos que ayuden al equipo a mejorar su proyecto.</p>
            
            <textarea name="comentarios" 
                      rows="6" 
                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none"
                      placeholder="Escribe aquí tus comentarios, sugerencias y áreas de mejora..."></textarea>
        </div>

        <!-- Resumen de Calificación -->
        <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl shadow-lg p-8 mb-8 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-indigo-100 text-lg mb-2">Calificación Total</p>
                    <p class="text-5xl font-bold" id="total-score">0</p>
                    <p class="text-indigo-100 mt-1">de 100 puntos</p>
                </div>
                <div class="bg-white/20 p-6 rounded-2xl">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="flex gap-4">
            <a href="{{ route('juez.evaluaciones') }}" 
               class="flex-1 px-6 py-4 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-xl transition-all duration-300 text-center">
                Cancelar
            </a>
            <button type="submit" 
                    class="flex-1 px-6 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Guardar Evaluación
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sliders = document.querySelectorAll('input[type="range"]');
    const totalScore = document.getElementById('total-score');
    
    function updateTotal() {
        let total = 0;
        sliders.forEach(slider => {
            total += parseInt(slider.value);
        });
        const average = Math.round(total / sliders.length);
        totalScore.textContent = average;
    }
    
    sliders.forEach(slider => {
        slider.addEventListener('input', updateTotal);
    });
});
</script>
@endsection
