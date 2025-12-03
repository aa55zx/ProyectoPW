<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - EventTec</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        [x-cloak] { display: none !important; }
        
        /* Fuente personalizada */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        
        /* Scrollbar personalizado */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 antialiased">
    <!-- Sidebar -->
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar fijo -->
        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col shadow-sm">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center gap-3 cursor-pointer">
                    <div class="w-10 h-10 bg-gray-900 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h1 class="text-xl font-bold text-gray-900">EvenTec</h1>
                    <button class="ml-auto text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Navegación -->
            <nav class="flex-1 p-4 overflow-y-auto">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('estudiante.dashboard') }}" 
                           class="{{ request()->routeIs('estudiante.dashboard') ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-100' }} flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-3zM14 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1h-4a1 1 0 01-1-1v-3z"></path>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('estudiante.eventos') }}" 
                           class="{{ request()->routeIs('estudiante.eventos') ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-100' }} flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Eventos</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('estudiante.equipos') }}" 
                           class="{{ request()->routeIs('estudiante.equipos') ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-100' }} flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span>Equipos</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('estudiante.proyectos') }}" 
                           class="{{ request()->routeIs('estudiante.proyectos') ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-100' }} flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>Proyectos</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('estudiante.rankings') }}" 
                           class="{{ request()->routeIs('estudiante.rankings') ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-100' }} flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <span>Rankings</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('estudiante.perfil') }}" 
                           class="{{ request()->routeIs('estudiante.perfil') ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-100' }} flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Mi Perfil</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Usuario -->
            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center gap-3 mb-3 p-2 hover:bg-gray-50 rounded-xl transition-colors cursor-pointer">
                    <div class="relative">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ explode(' ', auth()->user()->name)[0] }} {{ explode(' ', auth()->user()->name)[1] ?? '' }}</p>
                        <p class="text-xs text-gray-500">Alumno</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 rounded-xl transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </aside>

        <!-- Contenido Principal -->
        <div class="flex-1 flex flex-col overflow-hidden bg-gray-50">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-8 py-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <!-- Breadcrumb -->
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="font-medium text-gray-900">Dashboard</span>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <!-- Buscador -->
                        <div class="relative">
                            <input type="text" 
                                   placeholder="Buscar eventos, equipos..." 
                                   class="w-80 pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-sm">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        
                        <!-- Modo oscuro -->
                        <button class="p-2.5 text-gray-500 hover:bg-gray-100 rounded-xl transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                            </svg>
                        </button>
                        
                        <!-- Notificaciones -->
                        <div class="relative">
                            <button class="p-2.5 text-gray-500 hover:bg-gray-100 rounded-xl transition-all duration-200 relative">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full ring-2 ring-white"></span>
                            </button>
                        </div>

                        <!-- Avatar -->
                        <div class="flex items-center gap-3 pl-3 border-l border-gray-200">
                            <div class="relative cursor-pointer">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold shadow-md hover:shadow-lg transition-all">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
                            </div>
                            <div class="hidden xl:block">
                                <p class="text-sm font-semibold text-gray-900">{{ explode(' ', auth()->user()->name)[0] }} {{ explode(' ', auth()->user()->name)[1] ?? '' }}</p>
                                <p class="text-xs text-gray-500">Alumno</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Contenido que hace scroll -->
            <main class="flex-1 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
