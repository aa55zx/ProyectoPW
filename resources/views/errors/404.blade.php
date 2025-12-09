@extends('layouts.estudiante')

@section('title', '404 - Página No Encontrada')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4">
    <div class="max-w-lg w-full text-center">
        <div class="mb-8">
            <div class="w-24 h-24 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h1 class="text-6xl font-bold text-gray-900 mb-4">404</h1>
            <h2 class="text-2xl font-bold text-gray-800 mb-3">Página No Encontrada</h2>
            <p class="text-gray-600 mb-8">
                Lo sentimos, la página que buscas no existe o ha sido movida.
            </p>
        </div>
        
        <div class="flex gap-4 justify-center">
            <button onclick="window.history.back()" 
                    class="px-6 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition-colors font-semibold">
                Volver atrás
            </button>
            <a href="{{ route('estudiante.dashboard') }}" 
               class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors font-semibold">
                Ir al inicio
            </a>
        </div>
    </div>
</div>
@endsection
