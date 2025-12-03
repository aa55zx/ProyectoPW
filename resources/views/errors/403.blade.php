<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Acceso Denegado</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="text-center px-4">
        <div class="mb-8">
            <svg class="w-32 h-32 mx-auto text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
        </div>
        
        <h1 class="text-6xl font-bold text-gray-900 mb-4">403</h1>
        <h2 class="text-3xl font-semibold text-gray-800 mb-4">Acceso Denegado</h2>
        <p class="text-lg text-gray-600 mb-8 max-w-md mx-auto">
            {{ $exception->getMessage() ?: 'No tienes permiso para acceder a esta página.' }}
        </p>
        
        <div class="space-y-4">
            <a href="{{ url()->previous() }}" class="inline-block px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white font-semibold rounded-xl transition-all duration-300 shadow-md hover:shadow-lg">
                Volver Atrás
            </a>
            
            @auth
                @if(auth()->user()->rol === 'estudiante')
                    <a href="{{ route('estudiante.dashboard') }}" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-md hover:shadow-lg ml-4">
                        Ir al Dashboard
                    </a>
                @elseif(auth()->user()->rol === 'juez')
                    <a href="{{ route('juez.dashboard') }}" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-md hover:shadow-lg ml-4">
                        Ir al Dashboard
                    </a>
                @elseif(auth()->user()->rol === 'maestro' || auth()->user()->rol === 'asesor')
                    <a href="{{ route('asesor.dashboard') }}" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-md hover:shadow-lg ml-4">
                        Ir al Dashboard
                    </a>
                @elseif(auth()->user()->rol === 'administrador')
                    <a href="{{ route('admin.dashboard') }}" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-md hover:shadow-lg ml-4">
                        Ir al Dashboard
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-md hover:shadow-lg ml-4">
                    Iniciar Sesión
                </a>
            @endauth
        </div>
        
        <div class="mt-12 text-sm text-gray-500">
            <p>Si crees que esto es un error, contacta al administrador.</p>
        </div>
    </div>
</body>
</html>
