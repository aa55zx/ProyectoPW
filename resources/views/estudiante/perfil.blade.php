@extends('layouts.estudiante')

@section('title', 'Mi Perfil - EventTec')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Columna Izquierda -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Tarjeta de Perfil Principal -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="text-center mb-6">
                    <div class="w-32 h-32 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white text-5xl font-bold shadow-xl mx-auto mb-4">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-1">{{ $user->name }}</h2>
                    <p class="text-gray-600 mb-4">{{ $user->email }}</p>
                    
                    <!-- Botones de acción -->
                    <div class="space-y-2">
                        <button id="btn-editar-perfil" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Editar Perfil
                        </button>
                        <button id="btn-cambiar-password" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-colors font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Cambiar Contraseña
                        </button>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm">{{ $user->email }}</span>
                        </div>
                        @if($user->phone)
                        <div class="flex items-center gap-3 text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-sm">{{ $user->phone }}</span>
                        </div>
                        @endif
                        @if($user->career || $user->semester)
                        <div class="flex items-center gap-3 text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm">
                                Miembro desde {{ $user->created_at->format('M Y') }}
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Logros -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Logros</h3>
                @if(count($logros) > 0)
                    <div class="space-y-3">
                        @foreach($logros as $logro)
                            <div class="flex items-center gap-3 p-3 bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl border border-yellow-200">
                                <div class="text-3xl">{{ $logro['icono'] }}</div>
                                <div class="flex-1">
                                    <div class="font-semibold text-gray-900 text-sm">{{ $logro['titulo'] }}</div>
                                    <div class="text-xs text-gray-600">{{ $logro['descripcion'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-6">
                        <div class="text-4xl mb-2">🏆</div>
                        <p class="text-gray-600 text-sm">Participa en eventos para desbloquear logros</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Columna Derecha -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Tabs -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="border-b border-gray-200">
                    <div class="flex gap-1 p-2">
                        <button class="tab-btn active px-6 py-3 text-sm font-medium rounded-lg" data-tab="historial">
                            Historial
                        </button>
                        <button class="tab-btn px-6 py-3 text-sm font-medium rounded-lg" data-tab="cuenta">
                            Cuenta
                        </button>
                        <button class="tab-btn px-6 py-3 text-sm font-medium rounded-lg" data-tab="notificaciones">
                            Notificaciones
                        </button>
                    </div>
                </div>

                <!-- Tab: Historial -->
                <div class="tab-content active p-6" id="tab-historial">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Historial de Participación</h3>
                    <p class="text-gray-600 mb-6">Tus eventos y logros anteriores</p>

                    <!-- Estadísticas -->
                    <div class="grid grid-cols-4 gap-4 mb-8">
                        <div class="text-center p-4 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl">
                            <div class="w-12 h-12 bg-gray-600 rounded-lg flex items-center justify-center mx-auto mb-2">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </div>
                            <div class="text-3xl font-bold text-gray-900">{{ $stats['proyectos_evaluados'] }}</div>
                            <div class="text-xs text-gray-600 mt-1">Eventos</div>
                        </div>

                        <div class="text-center p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-xl">
                            <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mx-auto mb-2">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="text-3xl font-bold text-gray-900">{{ $stats['total_proyectos'] }}</div>
                            <div class="text-xs text-gray-600 mt-1">Proyectos</div>
                        </div>

                        <div class="text-center p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl">
                            <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mx-auto mb-2">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="text-3xl font-bold text-gray-900">{{ $stats['total_equipos'] }}</div>
                            <div class="text-xs text-gray-600 mt-1">Equipos</div>
                        </div>

                        <div class="text-center p-4 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl">
                            <div class="w-12 h-12 bg-yellow-600 rounded-lg flex items-center justify-center mx-auto mb-2">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                            <div class="text-3xl font-bold text-gray-900">{{ $stats['promedio_puntuacion'] }}</div>
                            <div class="text-xs text-gray-600 mt-1">Promedio</div>
                        </div>
                    </div>

                    <!-- Lista de Participaciones -->
                    <div class="space-y-4">
                        @forelse($proyectos->where('status', 'evaluated')->sortByDesc('final_score')->take(5) as $proyecto)
                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-xl hover:border-blue-300 hover:shadow-sm transition-all">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-lg {{ $proyecto->rank == 1 ? 'bg-yellow-500' : ($proyecto->rank == 2 ? 'bg-gray-400' : ($proyecto->rank == 3 ? 'bg-orange-500' : 'bg-gray-300')) }} flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900">{{ $proyecto->team->event->title }}</h4>
                                        <p class="text-sm text-gray-600">Equipo: {{ $proyecto->team->name }} | {{ $proyecto->created_at->format('M Y') }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="px-4 py-1.5 bg-gray-900 text-white rounded-lg font-bold text-sm mb-1">
                                        {{ $proyecto->rank }}° Lugar
                                    </div>
                                    <div class="text-sm text-gray-600">{{ $proyecto->final_score }} pts</div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-gray-600">No tienes participaciones evaluadas aún</p>
                                <p class="text-sm text-gray-500 mt-1">Participa en eventos para ver tu historial aquí</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Tab: Cuenta -->
                <div class="tab-content hidden p-6" id="tab-cuenta">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Información de Cuenta</h3>
                    
                    <div class="space-y-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nombre Completo</label>
                                <div class="text-gray-900 bg-gray-50 px-4 py-3 rounded-lg">{{ $user->name }}</div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico</label>
                                <div class="text-gray-900 bg-gray-50 px-4 py-3 rounded-lg">{{ $user->email }}</div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Número de Control</label>
                                <div class="text-gray-900 bg-gray-50 px-4 py-3 rounded-lg">{{ $user->control_number ?? 'No registrado' }}</div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                                <div class="text-gray-900 bg-gray-50 px-4 py-3 rounded-lg">{{ $user->phone ?? 'No registrado' }}</div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Carrera</label>
                                <div class="text-gray-900 bg-gray-50 px-4 py-3 rounded-lg">{{ $user->career ?? 'No registrado' }}</div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Semestre</label>
                                <div class="text-gray-900 bg-gray-50 px-4 py-3 rounded-lg">{{ $user->semester ? 'Semestre ' . $user->semester : 'No registrado' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab: Notificaciones -->
                <div class="tab-content hidden p-6" id="tab-notificaciones">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Preferencias de Notificaciones</h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                            <div>
                                <div class="font-semibold text-gray-900">Notificaciones por Email</div>
                                <div class="text-sm text-gray-600">Recibe actualizaciones importantes por correo</div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                            <div>
                                <div class="font-semibold text-gray-900">Nuevos Eventos</div>
                                <div class="text-sm text-gray-600">Avisos cuando se publiquen nuevos eventos</div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                            <div>
                                <div class="font-semibold text-gray-900">Resultados de Evaluaciones</div>
                                <div class="text-sm text-gray-600">Notificación cuando tus proyectos sean evaluados</div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                            <div>
                                <div class="font-semibold text-gray-900">Actualizaciones de Equipo</div>
                                <div class="text-sm text-gray-600">Cambios en tus equipos y proyectos</div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Editar Perfil -->
<div id="modal-editar-perfil" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full p-8 relative max-h-[90vh] overflow-y-auto">
        <button class="cerrar-modal absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <h3 class="text-2xl font-bold text-gray-900 mb-6">Editar Perfil</h3>

        <form id="form-editar-perfil" class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nombre Completo *</label>
                    <input type="text" name="name" value="{{ $user->name }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico *</label>
                    <input type="email" name="email" value="{{ $user->email }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                    <input type="text" name="phone" value="{{ $user->phone }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Semestre</label>
                    <select name="semester" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Selecciona</option>
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $user->semester == $i ? 'selected' : '' }}>Semestre {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Carrera</label>
                    <input type="text" name="career" value="{{ $user->career }}" placeholder="Ej: Ingeniería en Sistemas"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="button" class="cerrar-modal flex-1 py-3 px-4 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                    Cancelar
                </button>
                <button type="submit" class="flex-1 py-3 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Cambiar Contraseña -->
<div id="modal-cambiar-password" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-8 relative">
        <button class="cerrar-modal absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <h3 class="text-2xl font-bold text-gray-900 mb-6">Cambiar Contraseña</h3>

        <form id="form-cambiar-password" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Contraseña Actual *</label>
                <input type="password" name="current_password" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nueva Contraseña *</label>
                <input type="password" name="new_password" required minlength="8"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-xs text-gray-500 mt-1">Mínimo 8 caracteres</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Confirmar Nueva Contraseña *</label>
                <input type="password" name="new_password_confirmation" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex gap-3 pt-4">
                <button type="button" class="cerrar-modal flex-1 py-3 px-4 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                    Cancelar
                </button>
                <button type="submit" class="flex-1 py-3 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    Cambiar Contraseña
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tabs
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const tabId = this.dataset.tab;
            
            tabBtns.forEach(b => b.classList.remove('active', 'bg-blue-50', 'text-blue-600'));
            tabContents.forEach(c => c.classList.add('hidden'));
            
            this.classList.add('active', 'bg-blue-50', 'text-blue-600');
            document.getElementById('tab-' + tabId).classList.remove('hidden');
        });
    });

    // Modales
    const modalEditarPerfil = document.getElementById('modal-editar-perfil');
    const modalCambiarPassword = document.getElementById('modal-cambiar-password');
    const btnEditarPerfil = document.getElementById('btn-editar-perfil');
    const btnCambiarPassword = document.getElementById('btn-cambiar-password');
    const cerrarBtns = document.querySelectorAll('.cerrar-modal');

    btnEditarPerfil.addEventListener('click', () => modalEditarPerfil.classList.remove('hidden'));
    btnCambiarPassword.addEventListener('click', () => modalCambiarPassword.classList.remove('hidden'));

    cerrarBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            modalEditarPerfil.classList.add('hidden');
            modalCambiarPassword.classList.add('hidden');
        });
    });

    // Editar perfil
    document.getElementById('form-editar-perfil').addEventListener('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const btn = this.querySelector('button[type="submit"]');
        btn.disabled = true;
        btn.textContent = 'Guardando...';

        try {
            const response = await fetch('{{ route("estudiante.perfil.update") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            });
            const data = await response.json();
            if (data.success) {
                alert('✓ Perfil actualizado exitosamente');
                window.location.reload();
            } else {
                alert('✗ ' + data.message);
                btn.disabled = false;
                btn.textContent = 'Guardar Cambios';
            }
        } catch (error) {
            alert('✗ Error al actualizar perfil');
            btn.disabled = false;
            btn.textContent = 'Guardar Cambios';
        }
    });

    // Cambiar contraseña
    document.getElementById('form-cambiar-password').addEventListener('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const btn = this.querySelector('button[type="submit"]');
        btn.disabled = true;
        btn.textContent = 'Cambiando...';

        try {
            const response = await fetch('{{ route("estudiante.perfil.update-password") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            });
            const data = await response.json();
            if (data.success) {
                alert('✓ Contraseña actualizada exitosamente');
                modalCambiarPassword.classList.add('hidden');
                this.reset();
            } else {
                alert('✗ ' + data.message);
            }
            btn.disabled = false;
            btn.textContent = 'Cambiar Contraseña';
        } catch (error) {
            alert('✗ Error al cambiar contraseña');
            btn.disabled = false;
            btn.textContent = 'Cambiar Contraseña';
        }
    });
});
</script>

<style>
.tab-btn.active {
    background-color: rgb(239 246 255);
    color: rgb(37 99 235);
}
</style>
@endsection
