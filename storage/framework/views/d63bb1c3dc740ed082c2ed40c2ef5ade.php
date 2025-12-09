<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Dashboard - EvenTec'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar Blanco -->
        <aside class="w-64 bg-white flex flex-col border-r border-gray-200">
            <!-- Header del Sidebar -->
            <div class="p-6">
                <!-- Logo -->
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 bg-black rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 text-lg">EvenTec</h3>
                    </div>
                </div>

                <!-- User Info Card -->
                <div class="bg-gray-900 rounded-xl p-4">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gray-600 to-gray-800 flex items-center justify-center">
                                <span class="text-white font-semibold text-sm"><?php echo e(substr(Auth::user()->name, 0, 2)); ?></span>
                            </div>
                            <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full border-2 border-gray-900"></div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-white text-sm truncate"><?php echo e(Auth::user()->name); ?></p>
                            <p class="text-xs text-gray-400">Asesor</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navegación Principal -->
            <nav class="flex-1 px-4 overflow-y-auto">
                <ul class="space-y-1">
                    <li>
                        <a href="<?php echo e(route('asesor.dashboard')); ?>" 
                           class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all <?php echo e(request()->routeIs('asesor.dashboard') ? 'bg-black text-white font-medium' : 'text-gray-700 hover:bg-gray-100'); ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('asesor.eventos')); ?>" 
                           class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all <?php echo e(request()->routeIs('asesor.eventos*') ? 'bg-black text-white font-medium' : 'text-gray-700 hover:bg-gray-100'); ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>Eventos</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('asesor.equipos')); ?>" 
                           class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all <?php echo e(request()->routeIs('asesor.equipos') ? 'bg-black text-white font-medium' : 'text-gray-700 hover:bg-gray-100'); ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span>Equipos</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('asesor.proyectos')); ?>" 
                           class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all <?php echo e(request()->routeIs('asesor.proyectos') ? 'bg-black text-white font-medium' : 'text-gray-700 hover:bg-gray-100'); ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Proyectos</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('asesor.rankings')); ?>" 
                           class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all <?php echo e(request()->routeIs('asesor.rankings') ? 'bg-black text-white font-medium' : 'text-gray-700 hover:bg-gray-100'); ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            <span>Rankings</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('asesor.mi-perfil')); ?>" 
                           class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all <?php echo e(request()->routeIs('asesor.mi-perfil') ? 'bg-black text-white font-medium' : 'text-gray-700 hover:bg-gray-100'); ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Mi Perfil</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Footer del Sidebar -->
            <div class="p-4 border-t border-gray-200">
                <!-- User Info Bottom -->
                <div class="flex items-center gap-3 mb-3">
                    <div class="relative">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                            <span class="text-white font-semibold text-sm"><?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?></span>
                        </div>
                        <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-gray-900 text-sm truncate"><?php echo e(Auth::user()->name); ?></p>
                        <p class="text-xs text-gray-500">Asesor</p>
                    </div>
                </div>

                <!-- Logout Button -->
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-red-600 hover:bg-red-50 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="font-medium">Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content (SIN HEADER) -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto bg-gray-50">
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\Cheluis\Documentos\7Semestre\Programacion web\ProyectoPW\resources\views/layouts/asesor-dashboard.blade.php ENDPATH**/ ?>