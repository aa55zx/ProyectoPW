<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pruebas de Páginas de Error - EvenTec</title>
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
    </style>
</head>
<body class="bg-gray-50 antialiased min-h-screen p-6 md:p-12">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 mb-8 fade-in">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-14 h-14 bg-gray-900 rounded-xl flex items-center justify-center shadow-md">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-gray-900">EvenTec</h1>
                    <p class="text-gray-600">Sistema de Gestión de Eventos</p>
                </div>
            </div>
            <div class="border-t border-gray-200 pt-4 mt-4">
                <h2 class="text-xl font-bold text-gray-900 mb-2">🧪 Pruebas de Páginas de Error</h2>
                <p class="text-gray-600">
                    Haz clic en cualquier tarjeta para ver la página de error correspondiente.
                    Esta página solo está disponible en modo desarrollo.
                </p>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 text-center fade-in" style="animation-delay: 0.1s;">
                <div class="text-4xl font-black text-gray-900 mb-2">6</div>
                <div class="text-sm text-gray-600 font-medium">Páginas de Error</div>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 text-center fade-in" style="animation-delay: 0.2s;">
                <div class="text-4xl font-black text-gray-900 mb-2">100%</div>
                <div class="text-sm text-gray-600 font-medium">Responsive</div>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 text-center fade-in" style="animation-delay: 0.3s;">
                <div class="text-4xl font-black text-gray-900 mb-2">0</div>
                <div class="text-sm text-gray-600 font-medium">Dependencias</div>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 text-center fade-in" style="animation-delay: 0.4s;">
                <div class="text-4xl font-black text-gray-900 mb-2">✨</div>
                <div class="text-sm text-gray-600 font-medium">Diseño EvenTec</div>
            </div>
        </div>

        <!-- Grid de páginas de error -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- 401 -->
            <a href="{{ url('/test-errors/401') }}" 
               class="bg-white rounded-2xl shadow-sm border border-gray-200 hover:border-gray-300 hover:shadow-md transition-all duration-200 overflow-hidden group fade-in" style="animation-delay: 0.5s;">
                <div class="p-6 border-b border-gray-200 bg-yellow-50 group-hover:bg-yellow-100 transition-colors duration-200">
                    <div class="flex items-center justify-between mb-3">
                        <div class="text-5xl font-black text-gray-900">401</div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center group-hover:bg-yellow-200 transition-colors duration-200">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">No Autorizado</h3>
                    <p class="text-sm text-gray-600">Usuario sin autenticar</p>
                </div>
                <div class="p-4 bg-white">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Ver página →</span>
                        <span class="text-gray-400">HTTP 401</span>
                    </div>
                </div>
            </a>

            <!-- 403 -->
            <a href="{{ url('/test-errors/403') }}" 
               class="bg-white rounded-2xl shadow-sm border border-gray-200 hover:border-gray-300 hover:shadow-md transition-all duration-200 overflow-hidden group fade-in" style="animation-delay: 0.6s;">
                <div class="p-6 border-b border-gray-200 bg-red-50 group-hover:bg-red-100 transition-colors duration-200">
                    <div class="flex items-center justify-between mb-3">
                        <div class="text-5xl font-black text-gray-900">403</div>
                        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center group-hover:bg-red-200 transition-colors duration-200">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Acceso Denegado</h3>
                    <p class="text-sm text-gray-600">Sin permisos</p>
                </div>
                <div class="p-4 bg-white">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Ver página →</span>
                        <span class="text-gray-400">HTTP 403</span>
                    </div>
                </div>
            </a>

            <!-- 404 -->
            <a href="{{ url('/test-errors/404') }}" 
               class="bg-white rounded-2xl shadow-sm border border-gray-200 hover:border-gray-300 hover:shadow-md transition-all duration-200 overflow-hidden group fade-in" style="animation-delay: 0.7s;">
                <div class="p-6 border-b border-gray-200 bg-blue-50 group-hover:bg-blue-100 transition-colors duration-200">
                    <div class="flex items-center justify-between mb-3">
                        <div class="text-5xl font-black text-gray-900">404</div>
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center group-hover:bg-blue-200 transition-colors duration-200">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">No Encontrado</h3>
                    <p class="text-sm text-gray-600">Ruta inexistente</p>
                </div>
                <div class="p-4 bg-white">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Ver página →</span>
                        <span class="text-gray-400">HTTP 404</span>
                    </div>
                </div>
            </a>

            <!-- 419 -->
            <a href="{{ url('/test-errors/419') }}" 
               class="bg-white rounded-2xl shadow-sm border border-gray-200 hover:border-gray-300 hover:shadow-md transition-all duration-200 overflow-hidden group fade-in" style="animation-delay: 0.8s;">
                <div class="p-6 border-b border-gray-200 bg-blue-50 group-hover:bg-blue-100 transition-colors duration-200">
                    <div class="flex items-center justify-between mb-3">
                        <div class="text-5xl font-black text-gray-900">419</div>
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center group-hover:bg-blue-200 transition-colors duration-200">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Sesión Expirada</h3>
                    <p class="text-sm text-gray-600">Token CSRF inválido</p>
                </div>
                <div class="p-4 bg-white">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Ver página →</span>
                        <span class="text-gray-400">HTTP 419</span>
                    </div>
                </div>
            </a>

            <!-- 500 -->
            <a href="{{ url('/test-errors/500') }}" 
               class="bg-white rounded-2xl shadow-sm border border-gray-200 hover:border-gray-300 hover:shadow-md transition-all duration-200 overflow-hidden group fade-in" style="animation-delay: 0.9s;">
                <div class="p-6 border-b border-gray-200 bg-red-50 group-hover:bg-red-100 transition-colors duration-200">
                    <div class="flex items-center justify-between mb-3">
                        <div class="text-5xl font-black text-gray-900">500</div>
                        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center group-hover:bg-red-200 transition-colors duration-200">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Error del Servidor</h3>
                    <p class="text-sm text-gray-600">Error interno</p>
                </div>
                <div class="p-4 bg-white">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Ver página →</span>
                        <span class="text-gray-400">HTTP 500</span>
                    </div>
                </div>
            </a>

            <!-- 503 -->
            <a href="{{ url('/test-errors/503') }}" 
               class="bg-white rounded-2xl shadow-sm border border-gray-200 hover:border-gray-300 hover:shadow-md transition-all duration-200 overflow-hidden group fade-in" style="animation-delay: 1s;">
                <div class="p-6 border-b border-gray-200 bg-purple-50 group-hover:bg-purple-100 transition-colors duration-200">
                    <div class="flex items-center justify-between mb-3">
                        <div class="text-5xl font-black text-gray-900">503</div>
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center group-hover:bg-purple-200 transition-colors duration-200">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">No Disponible</h3>
                    <p class="text-sm text-gray-600">Mantenimiento</p>
                </div>
                <div class="p-4 bg-white">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Ver página →</span>
                        <span class="text-gray-400">HTTP 503</span>
                    </div>
                </div>
            </a>
        </div>

        <!-- Información adicional -->
        <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6 mb-8 fade-in" style="animation-delay: 1.1s;">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 mb-2">Nota Importante</h3>
                    <ul class="text-sm text-gray-700 space-y-1">
                        <li>• Esta página solo está disponible en modo desarrollo</li>
                        <li>• El error 500 solo muestra la página personalizada en producción</li>
                        <li>• Todas las páginas usan el diseño de EvenTec</li>
                        <li>• Las páginas son responsive y funcionan sin layouts adicionales</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Botón volver -->
        <div class="text-center fade-in" style="animation-delay: 1.2s;">
            <a href="{{ url('/') }}" 
               class="inline-flex items-center gap-2 px-8 py-4 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition-all duration-200 font-medium shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver al Inicio
            </a>
        </div>
    </div>
</body>
</html>
