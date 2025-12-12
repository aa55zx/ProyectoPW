<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Acceso Denegado</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .float {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gray-50 antialiased min-h-screen flex items-center justify-center p-6">
    <div class="max-w-2xl w-full fade-in">
        <!-- Logo/Header -->
        <div class="flex items-center justify-center mb-8">
            <div class="w-12 h-12 bg-gray-900 rounded-xl flex items-center justify-center shadow-md">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h1 class="ml-3 text-2xl font-bold text-gray-900">EvenTec</h1>
        </div>

        <!-- Card principal -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Icono y código de error -->
            <div class="p-12 text-center border-b border-gray-200">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-red-100 rounded-2xl mb-6 float">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                
                <h2 class="text-7xl font-black text-gray-900 mb-4">403</h2>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Acceso Denegado</h3>
                <p class="text-gray-600 max-w-md mx-auto">
                    No tienes los permisos necesarios para acceder a este recurso.
                </p>
            </div>

            <!-- Contenido -->
            <div class="p-8">
                <div class="bg-gray-50 rounded-xl p-6 mb-6">
                    <h4 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        ¿Por qué veo esto?
                    </h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <span class="text-gray-400 mt-1">•</span>
                            <span>No tienes permisos para ver esta página</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-gray-400 mt-1">•</span>
                            <span>Tu rol de usuario no tiene acceso a este recurso</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-gray-400 mt-1">•</span>
                            <span>Contacta al administrador si crees que deberías tener acceso</span>
                        </li>
                    </ul>
                </div>

                <!-- Botones -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <button 
                        onclick="window.history.back()" 
                        class="flex-1 flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-200 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Volver atrás
                    </button>
                    
                    <a 
                        href="{{ url('/') }}" 
                        class="flex-1 flex items-center justify-center gap-2 px-6 py-3 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition-all duration-200 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Ir al inicio
                    </a>
                </div>
            </div>
        </div>

        <!-- Pie de página -->
        <p class="text-center text-sm text-gray-500 mt-6">
            ¿Necesitas ayuda? Contacta con soporte técnico
        </p>
    </div>
</body>
</html>
