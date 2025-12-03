@extends('layouts.admin')

@section('title', 'Administración')
@section('breadcrumb', 'Administración')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Encabezado -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Panel de Administración</h1>
        <p class="text-gray-600 mt-2 text-lg">Gestiona usuarios, configuración y permisos del sistema</p>
    </div>

    <!-- Estadísticas Rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-sm p-6 text-white">
            <div class="flex items-center justify-between mb-2">
                <p class="text-sm opacity-90">Total Usuarios</p>
                <svg class="w-6 h-6 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <p class="text-4xl font-bold">342</p>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-sm p-6 text-white">
            <div class="flex items-center justify-between mb-2">
                <p class="text-sm opacity-90">Estudiantes</p>
                <svg class="w-6 h-6 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <p class="text-4xl font-bold">280</p>
        </div>
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-sm p-6 text-white">
            <div class="flex items-center justify-between mb-2">
                <p class="text-sm opacity-90">Jueces</p>
                <svg class="w-6 h-6 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
            </div>
            <p class="text-4xl font-bold">45</p>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl shadow-sm p-6 text-white">
            <div class="flex items-center justify-between mb-2">
                <p class="text-sm opacity-90">Asesores</p>
                <svg class="w-6 h-6 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            <p class="text-4xl font-bold">17</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Gestión de Usuarios -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Filtros y Búsqueda -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-2">
                        <input type="text" placeholder="Buscar usuarios..." class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
                    </div>
                    <div>
                        <select class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
                            <option>Todos los roles</option>
                            <option>Estudiante</option>
                            <option>Juez</option>
                            <option>Asesor</option>
                            <option>Administrador</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Lista de Usuarios -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-gray-900">Usuarios Registrados</h2>
                    <button class="px-4 py-2.5 bg-gray-900 hover:bg-gray-800 text-white font-semibold rounded-xl transition-all duration-300 flex items-center gap-2 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Agregar Usuario
                    </button>
                </div>

                <div class="divide-y divide-gray-100">
                    <!-- Usuario 1 -->
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                                    JD
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Juan Pérez Díaz</h3>
                                    <div class="flex items-center gap-3 mt-1">
                                        <span class="px-2.5 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded">Estudiante</span>
                                        <p class="text-sm text-gray-600">L20293847</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                </button>
                                <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Usuario 2 -->
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                                    MR
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">María Rodríguez</h3>
                                    <div class="flex items-center gap-3 mt-1">
                                        <span class="px-2.5 py-1 bg-purple-100 text-purple-700 text-xs font-semibold rounded">Juez</span>
                                        <p class="text-sm text-gray-600">maria.rodriguez@email.com</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                </button>
                                <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Usuario 3 -->
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                                    LG
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Luis García</h3>
                                    <div class="flex items-center gap-3 mt-1">
                                        <span class="px-2.5 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded">Estudiante</span>
                                        <p class="text-sm text-gray-600">L20293848</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                </button>
                                <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Usuario 4 -->
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                                    SP
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Sofía Pérez</h3>
                                    <div class="flex items-center gap-3 mt-1">
                                        <span class="px-2.5 py-1 bg-orange-100 text-orange-700 text-xs font-semibold rounded">Asesor</span>
                                        <p class="text-sm text-gray-600">sofia.perez@email.com</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                </button>
                                <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 border-t border-gray-100">
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-gray-600">Mostrando 1-4 de 342 usuarios</p>
                        <div class="flex items-center gap-2">
                            <button class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                Anterior
                            </button>
                            <button class="px-4 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg">
                                1
                            </button>
                            <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                Siguiente
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel Lateral: Configuración -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Configuración del Sistema -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Configuración</h2>
                
                <div class="space-y-4">
                    <button class="w-full p-4 bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 rounded-xl text-left transition-all duration-300 border border-blue-200">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-blue-500 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Configuración General</p>
                                <p class="text-xs text-gray-600">Ajustes del sistema</p>
                            </div>
                        </div>
                    </button>

                    <button class="w-full p-4 bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 rounded-xl text-left transition-all duration-300 border border-purple-200">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-purple-500 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Permisos y Roles</p>
                                <p class="text-xs text-gray-600">Gestionar accesos</p>
                            </div>
                        </div>
                    </button>

                    <button class="w-full p-4 bg-gradient-to-br from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 rounded-xl text-left transition-all duration-300 border border-green-200">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-green-500 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Notificaciones</p>
                                <p class="text-xs text-gray-600">Configurar alertas</p>
                            </div>
                        </div>
                    </button>

                    <button class="w-full p-4 bg-gradient-to-br from-orange-50 to-orange-100 hover:from-orange-100 hover:to-orange-200 rounded-xl text-left transition-all duration-300 border border-orange-200">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-orange-500 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Respaldo de Datos</p>
                                <p class="text-xs text-gray-600">Backups del sistema</p>
                            </div>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Actividad Reciente -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Actividad Reciente</h2>
                
                <div class="space-y-4">
                    <div class="flex gap-3 items-start">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-900 font-medium">Usuario agregado</p>
                            <p class="text-xs text-gray-500 mt-0.5">Juan Pérez - Hace 10 min</p>
                        </div>
                    </div>

                    <div class="flex gap-3 items-start">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-900 font-medium">Configuración actualizada</p>
                            <p class="text-xs text-gray-500 mt-0.5">Sistema - Hace 1 hora</p>
                        </div>
                    </div>

                    <div class="flex gap-3 items-start">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-900 font-medium">Rol modificado</p>
                            <p class="text-xs text-gray-500 mt-0.5">María Rodríguez - Hace 2 horas</p>
                        </div>
                    </div>

                    <div class="flex gap-3 items-start">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-900 font-medium">Usuario eliminado</p>
                            <p class="text-xs text-gray-500 mt-0.5">Sistema - Hace 3 horas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
