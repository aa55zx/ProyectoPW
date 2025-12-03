<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - EventTecNM</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-red-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">EventTecNM</h1>
                <p class="text-sm opacity-90">Panel de Administración</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="font-semibold">{{ auth()->user()->name }}</p>
                    <p class="text-xs opacity-75">{{ auth()->user()->numero_control }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-gray-800 hover:bg-gray-900 px-4 py-2 rounded-lg transition">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Contenido -->
    <div class="container mx-auto px-4 py-8">
        <!-- Bienvenida -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">
                ¡Bienvenido, {{ auth()->user()->name }}!
            </h2>
            <p class="text-gray-600">
                Rol: <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                    👨‍💼 Administrador
                </span>
            </p>
        </div>

        <!-- Grid de tarjetas -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Tarjeta 1 -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Usuarios</h3>
                    <span class="text-3xl">👥</span>
                </div>
                <p class="text-gray-600 mb-4">Gestionar usuarios del sistema</p>
                <button class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 rounded-lg transition">
                    Gestionar
                </button>
            </div>

            <!-- Tarjeta 2 -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Eventos</h3>
                    <span class="text-3xl">📅</span>
                </div>
                <p class="text-gray-600 mb-4">Administrar eventos</p>
                <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded-lg transition">
                    Gestionar
                </button>
            </div>

            <!-- Tarjeta 3 -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Equipos</h3>
                    <span class="text-3xl">👨‍👩‍👧‍👦</span>
                </div>
                <p class="text-gray-600 mb-4">Gestionar equipos</p>
                <button class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 rounded-lg transition">
                    Gestionar
                </button>
            </div>

            <!-- Tarjeta 4 -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Reportes</h3>
                    <span class="text-3xl">📊</span>
                </div>
                <p class="text-gray-600 mb-4">Ver estadísticas</p>
                <button class="w-full bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 rounded-lg transition">
                    Ver Reportes
                </button>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">
            <div class="bg-blue-500 text-white rounded-lg shadow-md p-6">
                <p class="text-sm opacity-90">Total Estudiantes</p>
                <p class="text-4xl font-bold">0</p>
            </div>
            <div class="bg-green-500 text-white rounded-lg shadow-md p-6">
                <p class="text-sm opacity-90">Total Maestros</p>
                <p class="text-4xl font-bold">0</p>
            </div>
            <div class="bg-purple-500 text-white rounded-lg shadow-md p-6">
                <p class="text-sm opacity-90">Total Jueces</p>
                <p class="text-4xl font-bold">0</p>
            </div>
            <div class="bg-orange-500 text-white rounded-lg shadow-md p-6">
                <p class="text-sm opacity-90">Total Eventos</p>
                <p class="text-4xl font-bold">0</p>
            </div>
        </div>

        <!-- Información adicional -->
        <div class="mt-8 bg-red-50 border border-red-200 rounded-lg p-6">
            <h3 class="text-lg font-bold text-red-800 mb-2">👨‍💼 Panel de Control Administrativo</h3>
            <p class="text-red-700">
                Desde aquí puedes administrar todos los aspectos del sistema EventTecNM.
            </p>
        </div>
    </div>
</body>
</html>
