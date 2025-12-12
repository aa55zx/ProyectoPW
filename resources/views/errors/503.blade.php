<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>503 - Servicio No Disponible</title>
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
        @keyframes bounce-slow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        .bounce-slow {
            animation: bounce-slow 2s ease-in-out infinite;
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
                <div class="inline-flex items-center justify-center w-20 h-20 bg-purple-100 rounded-2xl mb-6 bounce-slow">
                    <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                
                <h2 class="text-7xl font-black text-gray-900 mb-4">503</h2>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Servicio No Disponible</h3>
                <p class="text-gray-600 max-w-md mx-auto">
                    El sitio está temporalmente en mantenimiento. Volveremos pronto.
                </p>
            </div>

            <!-- Contenido -->
            <div class="p-8">
                <div class="bg-gray-50 rounded-xl p-6 mb-6">
                    <h4 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Estamos trabajando en:
                    </h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <div class="w-2 h-2 bg-purple-500 rounded-full mt-2"></div>
                            <span>Mejoras del sistema</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <div class="w-2 h-2 bg-purple-500 rounded-full mt-2"></div>
                            <span>Actualizaciones de seguridad</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <div class="w-2 h-2 bg-purple-500 rounded-full mt-2"></div>
                            <span>Optimización del rendimiento</span>
                        </li>
                    </ul>
                </div>

                <!-- Tiempo estimado -->
                <div class="bg-blue-50 rounded-xl p-6 mb-6 border border-blue-100">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-1">Tiempo estimado</h4>
                            <p class="text-sm text-gray-700">
                                El mantenimiento debería finalizar pronto. Puedes intentar recargar la página en unos minutos.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <button 
                        onclick="window.location.reload()" 
                        class="flex-1 flex items-center justify-center gap-2 px-6 py-3 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition-all duration-200 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Intentar de Nuevo
                    </button>
                </div>
            </div>
        </div>

        <!-- Pie de página -->
        <p class="text-center text-sm text-gray-500 mt-6">
            Gracias por tu paciencia mientras mejoramos el servicio
        </p>
    </div>
</body>
</html>
