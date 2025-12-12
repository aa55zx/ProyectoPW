<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - EvenTec</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-xl w-full max-w-md p-8">
        
        <!-- Logo y Título -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-black rounded-2xl mb-4">
                <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">EvenTec</h1>
            <p class="text-gray-600 text-sm">Registro de Estudiante</p>
        </div>

        <!-- Mensajes de error -->
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                <ul class="text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario -->
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Nombre Completo -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nombre completo
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </span>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition"
                        placeholder="Juan Pérez García"
                        required
                        autofocus
                    >
                </div>
            </div>

            <!-- Correo Electrónico -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Correo electrónico
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </span>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition"
                        placeholder="tu@correo.edu.mx"
                        required
                    >
                </div>
            </div>

            <!-- Número de Control -->
            <div>
                <label for="numero_control" class="block text-sm font-medium text-gray-700 mb-2">
                    Número de control
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </span>
                    <input 
                        type="text" 
                        id="numero_control" 
                        name="numero_control" 
                        value="{{ old('numero_control') }}"
                        class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition"
                        placeholder="20240001"
                        required
                    >
                </div>
            </div>

            <!-- Carrera -->
            <div>
                <label for="career" class="block text-sm font-medium text-gray-700 mb-2">
                    Carrera
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </span>
                    <select 
                        id="career" 
                        name="career" 
                        class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition appearance-none bg-white"
                        required
                    >
                        <option value="" disabled {{ old('career') ? '' : 'selected' }}>Selecciona tu carrera</option>
                        <option value="Ing. en Sistemas Computacionales" {{ old('career') == 'Ing. en Sistemas Computacionales' ? 'selected' : '' }}>Ing. en Sistemas Computacionales</option>
                        <option value="Ing. Industrial" {{ old('career') == 'Ing. Industrial' ? 'selected' : '' }}>Ing. Industrial</option>
                        <option value="Ing. en Electrónica" {{ old('career') == 'Ing. en Electrónica' ? 'selected' : '' }}>Ing. en Electrónica</option>
                        <option value="Ing. en Gestión Empresarial" {{ old('career') == 'Ing. en Gestión Empresarial' ? 'selected' : '' }}>Ing. en Gestión Empresarial</option>
                        <option value="Ing. Mecatrónica" {{ old('career') == 'Ing. Mecatrónica' ? 'selected' : '' }}>Ing. Mecatrónica</option>
                        <option value="Ing. Mecánica" {{ old('career') == 'Ing. Mecánica' ? 'selected' : '' }}>Ing. Mecánica</option>
                        <option value="Ing. en Administración" {{ old('career') == 'Ing. en Administración' ? 'selected' : '' }}>Ing. en Administración</option>
                        <option value="Lic. en Administración" {{ old('career') == 'Lic. en Administración' ? 'selected' : '' }}>Lic. en Administración</option>
                    </select>
                </div>
            </div>

            <!-- Semestre -->
            <div>
                <label for="semester" class="block text-sm font-medium text-gray-700 mb-2">
                    Semestre
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </span>
                    <select 
                        id="semester" 
                        name="semester" 
                        class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition appearance-none bg-white"
                        required
                    >
                        <option value="" disabled {{ old('semester') ? '' : 'selected' }}>Selecciona tu semestre</option>
                        <option value="1" {{ old('semester') == '1' ? 'selected' : '' }}>1° Semestre</option>
                        <option value="2" {{ old('semester') == '2' ? 'selected' : '' }}>2° Semestre</option>
                        <option value="3" {{ old('semester') == '3' ? 'selected' : '' }}>3° Semestre</option>
                        <option value="4" {{ old('semester') == '4' ? 'selected' : '' }}>4° Semestre</option>
                        <option value="5" {{ old('semester') == '5' ? 'selected' : '' }}>5° Semestre</option>
                        <option value="6" {{ old('semester') == '6' ? 'selected' : '' }}>6° Semestre</option>
                        <option value="7" {{ old('semester') == '7' ? 'selected' : '' }}>7° Semestre</option>
                        <option value="8" {{ old('semester') == '8' ? 'selected' : '' }}>8° Semestre</option>
                        <option value="9" {{ old('semester') == '9' ? 'selected' : '' }}>9° Semestre</option>
                        <option value="10" {{ old('semester') == '10' ? 'selected' : '' }}>10° Semestre</option>
                        <option value="11" {{ old('semester') == '11' ? 'selected' : '' }}>11° Semestre</option>
                        <option value="12" {{ old('semester') == '12' ? 'selected' : '' }}>12° Semestre</option>
                    </select>
                </div>
            </div>

            <!-- Contraseña -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Contraseña
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </span>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition"
                        placeholder="••••••••"
                        required
                    >
                </div>
            </div>

            <!-- Confirmar Contraseña -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    Confirmar contraseña
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </span>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition"
                        placeholder="••••••••"
                        required
                    >
                </div>
            </div>

            <!-- Campo oculto para user_type (siempre estudiante) -->
            <input type="hidden" name="user_type" value="estudiante">

            <!-- Botón de Registro -->
            <button 
                type="submit" 
                class="w-full bg-black text-white font-semibold py-3 rounded-lg hover:bg-gray-800 transition duration-300 shadow-lg mt-6"
            >
                Registrarse
            </button>
        </form>

        <!-- Enlace a Login -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                ¿Ya tienes cuenta? 
                <a href="{{ route('login') }}" class="text-black font-semibold hover:underline">
                    Inicia sesión aquí
                </a>
            </p>
        </div>
    </div>
</body>
</html>
