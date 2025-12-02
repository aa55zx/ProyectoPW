@extends('layouts.dashboard')

@section('title', 'Detalle del Evento - Asesor')

@section('content')
<div class="p-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li>
                <a href="{{ route('asesor.eventos') }}" class="text-gray-600 hover:text-gray-900 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Eventos
                </a>
            </li>
            <li>
                <span class="text-gray-400">/</span>
            </li>
            <li>
                <span class="text-gray-800 font-medium">Hackathon de Innovación 2024</span>
            </li>
        </ol>
    </nav>

    <!-- Header del evento con imagen -->
    <div class="relative h-72 rounded-2xl overflow-hidden mb-8">
        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200" 
             alt="Hackathon" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
        <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
            <div class="flex items-center gap-3 mb-3">
                <span class="px-3 py-1 bg-yellow-500 text-white text-xs font-semibold rounded-full">En curso</span>
                <span class="px-3 py-1 bg-blue-900 text-white text-xs font-semibold rounded-full">Tecnología</span>
            </div>
            <h1 class="text-4xl font-bold mb-2">Hackathon de Innovación 2024</h1>
            <p class="text-lg text-gray-200">Desarrolla soluciones tecnológicas innovadoras para problemas reales</p>
        </div>
    </div>

    <!-- Grid de contenido -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Columna principal -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Descripción -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Descripción</h2>
                <div class="prose prose-gray max-w-none text-gray-600">
                    <p class="mb-4">
                        El Hackathon de Innovación 2024 es un evento intensivo de 48 horas donde equipos de estudiantes trabajan para 
                        desarrollar soluciones tecnológicas innovadoras a problemas reales. Este año, el tema central es "Tecnología 
                        para el Desarrollo Sostenible".
                    </p>
                    <p class="mb-4">
                        Los participantes tendrán acceso a mentores expertos, recursos tecnológicos de última generación, y la 
                        oportunidad de presentar sus proyectos ante un panel de jueces conformado por profesionales de la industria 
                        y académicos reconocidos.
                    </p>
                    <h3 class="text-xl font-bold text-gray-800 mt-6 mb-3">Objetivos</h3>
                    <ul class="list-disc list-inside space-y-2 mb-4">
                        <li>Fomentar la innovación y creatividad en el desarrollo de soluciones tecnológicas</li>
                        <li>Promover el trabajo en equipo y la colaboración interdisciplinaria</li>
                        <li>Conectar a estudiantes con profesionales de la industria</li>
                        <li>Desarrollar habilidades técnicas y de presentación</li>
                    </ul>
                </div>
            </div>

            <!-- Cronograma -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Cronograma</h2>
                <div class="space-y-4">
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-3 h-3 bg-blue-600 rounded-full"></div>
                            <div class="w-0.5 h-full bg-gray-200"></div>
                        </div>
                        <div class="pb-6">
                            <p class="text-sm font-semibold text-gray-800">14 Abril 2024 - 9:00 AM</p>
                            <p class="text-gray-600 mt-1">Inauguración y presentación del reto</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-3 h-3 bg-blue-600 rounded-full"></div>
                            <div class="w-0.5 h-full bg-gray-200"></div>
                        </div>
                        <div class="pb-6">
                            <p class="text-sm font-semibold text-gray-800">14 Abril 2024 - 10:00 AM</p>
                            <p class="text-gray-600 mt-1">Inicio del desarrollo - Fase de ideación</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-3 h-3 bg-blue-600 rounded-full"></div>
                            <div class="w-0.5 h-full bg-gray-200"></div>
                        </div>
                        <div class="pb-6">
                            <p class="text-sm font-semibold text-gray-800">15 Abril 2024 - 2:00 PM</p>
                            <p class="text-gray-600 mt-1">Check-point intermedio y mentoría</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-3 h-3 bg-blue-600 rounded-full"></div>
                            <div class="w-0.5 h-full bg-gray-200"></div>
                        </div>
                        <div class="pb-6">
                            <p class="text-sm font-semibold text-gray-800">16 Abril 2024 - 9:00 AM</p>
                            <p class="text-gray-600 mt-1">Cierre de desarrollo y preparación de presentaciones</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-3 h-3 bg-green-600 rounded-full"></div>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800">16 Abril 2024 - 2:00 PM</p>
                            <p class="text-gray-600 mt-1">Presentaciones finales y premiación</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Requisitos -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Requisitos de Participación</h2>
                <div class="space-y-3">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-gray-700">Equipos de 3 a 5 integrantes</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-gray-700">Al menos un integrante debe ser estudiante activo del TecNM</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-gray-700">Contar con laptop y conocimientos básicos de programación</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-gray-700">Disponibilidad para las 48 horas del evento</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Información general -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Información General</h3>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-500">Fecha</p>
                            <p class="font-semibold text-gray-800">14-16 Abril 2024</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-500">Duración</p>
                            <p class="font-semibold text-gray-800">48 horas</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-500">Ubicación</p>
                            <p class="font-semibold text-gray-800">Centro de Innovación TecNM</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-500">Equipos</p>
                            <p class="font-semibold text-gray-800">24 registrados</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-500">Tamaño de equipo</p>
                            <p class="font-semibold text-gray-800">3-5 integrantes</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Premios -->
            <div class="bg-gradient-to-br from-yellow-50 to-amber-50 rounded-2xl shadow-sm p-6 border-2 border-yellow-200">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    Premios
                </h3>
                <div class="space-y-3">
                    <div class="bg-white rounded-xl p-4">
                        <p class="text-sm text-gray-600 mb-1">1er Lugar</p>
                        <p class="text-2xl font-bold text-yellow-600">$20,000 MXN</p>
                    </div>
                    <div class="bg-white rounded-xl p-4">
                        <p class="text-sm text-gray-600 mb-1">2do Lugar</p>
                        <p class="text-2xl font-bold text-gray-600">$10,000 MXN</p>
                    </div>
                    <div class="bg-white rounded-xl p-4">
                        <p class="text-sm text-gray-600 mb-1">3er Lugar</p>
                        <p class="text-2xl font-bold text-orange-600">$5,000 MXN</p>
                    </div>
                </div>
            </div>

            <!-- Contacto -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Contacto</h3>
                <div class="space-y-3">
                    <a href="mailto:eventos@tecnm.mx" class="flex items-center gap-3 text-gray-700 hover:text-blue-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-sm">eventos@tecnm.mx</span>
                    </a>
                    <a href="tel:+525512345678" class="flex items-center gap-3 text-gray-700 hover:text-blue-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="text-sm">+52 55 1234 5678</span>
                    </a>
                </div>
            </div>

            <!-- Botón de acción -->
            <button class="w-full px-6 py-4 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition-colors font-semibold text-center">
                Ver mis equipos participantes
            </button>
        </div>
    </div>
</div>
@endsection
