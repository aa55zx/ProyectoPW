@extends('layouts.app')

@section('title', 'Iniciar Sesión - EventTecNM')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen px-4">
    <!-- Logo -->
    <div class="mb-8">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Instituto Tecnológico de Oaxaca" class="h-24 w-auto">
    </div>
    
    <!-- Título -->
    <h1 class="text-4xl font-bold text-gray-800 mb-2 text-center">Instituto Tecnológico de Oaxaca</h1>
    <h2 class="text-3xl font-semibold text-gray-700 mb-8 text-center">EventTecNM</h2>
    
    <!-- Contenedor del formulario -->
    <div class="bg-white rounded-3xl shadow-lg p-8 w-full max-w-xl">
        <!-- Tabs -->
        <div class="flex mb-8 bg-gray-100 rounded-full p-1">
            <button class="flex-1 py-3 px-6 rounded-full bg-white text-gray-800 font-medium shadow-sm transition-all">
                Iniciar sesión
            </button>
            <a href="{{ route('register') }}" class="flex-1 py-3 px-6 rounded-full text-gray-600 font-medium text-center hover:bg-gray-50 transition-all">
                Registrarse
            </a>
        </div>
        
        <!-- Radio buttons para tipo de usuario -->
        <div class="flex justify-center gap-4 mb-6">
            <div class="flex items-center">
                <input type="radio" id="estudiante" name="user_type" value="estudiante" checked class="w-4 h-4 text-blue-600">
                <label for="estudiante" class="ml-2 text-sm text-gray-700">Estudiante</label>
            </div>
            <div class="flex items-center">
                <input type="radio" id="docente" name="user_type" value="docente" class="w-4 h-4 text-blue-600">
                <label for="docente" class="ml-2 text-sm text-gray-700">Docente</label>
            </div>
            <div class="flex items-center">
                <input type="radio" id="admin" name="user_type" value="admin" class="w-4 h-4 text-blue-600">
                <label for="admin" class="ml-2 text-sm text-gray-700">Admin</label>
            </div>
        </div>
        
        <!-- Formulario -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <!-- Número de control -->
            <div class="mb-6">
                <label for="numero_control" class="block text-sm font-medium text-gray-700 mb-2">
                    Número de control
                </label>
                <div class="relative">
                    <input 
                        type="text" 
                        id="numero_control" 
                        name="numero_control" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('numero_control') border-red-500 @enderror"
                        value="{{ old('numero_control') }}"
                        required
                        autofocus
                    >
                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                @error('numero_control')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Contraseña -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Contraseña
                </label>
                <div class="relative">
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror"
                        required
                    >
                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                </div>
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Olvidé mi contraseña -->
            <div class="text-right mb-6">
                <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:text-gray-800">
                    Olvidé mi contraseña
                </a>
            </div>
            
            <!-- Botón de submit -->
            <button 
                type="submit" 
                class="w-full bg-blue-900 text-white py-3 rounded-lg font-medium hover:bg-blue-800 transition-colors shadow-md"
            >
                Iniciar sesión
            </button>
        </form>
    </div>
</div>
@endsection