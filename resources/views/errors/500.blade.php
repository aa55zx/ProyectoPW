<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Error del Servidor</title>
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
        @keyframes pulse-slow {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(0.95); }
        }
        .pulse-slow {
            animation: pulse-slow 2s ease-in-out infinite;
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
                <div class="inline-flex items-center justify-center w-20 h-20 bg-red-100 rounded-2xl mb-6 pulse-slow">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                
                <h2 class="text-7xl font-black text-gray-900 mb-4">500</h2>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Error del Servidor</h3>
                <p class="text-gray-600 max-w-md mx-auto">
                    Algo salió mal en nuestros servidores. Estamos trabajando para solucionarlo.
                </p>
            </div>

            <!-- Contenido -->
            <div class="p-8">
                <!-- Detalles del error -->
                <div class="bg-gray-50 rounded-xl p-6 mb-6">
                    <h4 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <div class="w-2 h-2 bg-red-500 rounded-full pulse-slow"></div>
                        Detalles del Error
                    </h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Código:</span>
                            <span class="font-mono text-gray-900 font-medium">HTTP 500</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Estado:</span>
                            <span class="text-red-600 font-medium">Internal Server Error</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">ID de Error:</span>
                            <span class="font-mono text-gray-600 text-xs">{{ Str::random(8) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Hora:</span>
                            <span class="text-gray-900 font-medium" id="current-time"></span>
                        </div>
                    </div>
                </div>

                <!-- Sugerencias -->
                <div class="bg-blue-50 rounded-xl p-6 mb-6 border border-blue-100">
                    <h4 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        ¿Qué puedes hacer?
                    </h4>
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li class="flex items-start gap-2">
                            <span class="text-blue-600 mt-1">•</span>
                            <span>Espera unos momentos y recarga la página</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-blue-600 mt-1">•</span>
                            <span>Regresa a la página anterior</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-blue-600 mt-1">•</span>
                            <span>Si el error persiste, contacta al soporte técnico</span>
                        </li>
                    </ul>
                </div>

                <!-- Botones -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <button 
                        onclick="window.location.reload()" 
                        class="flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-200 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Recargar
                    </button>
                    
                    <button 
                        onclick="window.history.back()" 
                        class="flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-200 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Volver
                    </button>
                    
                    <a 
                        href="{{ url('/') }}" 
                        class="flex items-center justify-center gap-2 px-6 py-3 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition-all duration-200 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Inicio
                    </a>
                </div>
            </div>
        </div>

        <!-- Pie de página -->
        <p class="text-center text-sm text-gray-500 mt-6">
            Nuestro equipo ha sido notificado y está trabajando en una solución
        </p>
    </div>

    <script>
        // Actualizar hora actual
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('es-MX', { 
                hour: '2-digit', 
                minute: '2-digit',
                second: '2-digit'
            });
            const element = document.getElementById('current-time');
            if (element) {
                element.textContent = timeString;
            }
        }
        updateTime();
        setInterval(updateTime, 1000);
    </script>
</body>
</html>
