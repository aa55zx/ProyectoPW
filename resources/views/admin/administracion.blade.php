@extends('layouts.admin')

@section('title', 'Administración')
@section('breadcrumb', 'Administración')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Mensajes -->
    @if(session('success'))
    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
        <p class="text-green-700">{{ session('success') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
        <p class="text-red-700">{{ session('error') }}</p>
    </div>
    @endif

    <!-- Encabezado -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-900">Panel de Administración</h1>
            <p class="text-gray-600 mt-2 text-lg">Gestiona usuarios, configuración y permisos del sistema</p>
        </div>
        <button onclick="openCreateUserModal()" class="px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white font-semibold rounded-xl transition-all duration-300 flex items-center gap-2 shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Crear Usuario
        </button>
    </div>

    <!-- Estadísticas Rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl shadow-sm p-6 text-white">
            <div class="flex items-center justify-between mb-2">
                <p class="text-sm opacity-90">Total Usuarios</p>
                <svg class="w-6 h-6 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <p class="text-4xl font-bold">{{ $usuarios->total() }}</p>
        </div>
        <div class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-2xl shadow-sm p-6 text-white">
            <div class="flex items-center justify-between mb-2">
                <p class="text-sm opacity-90">Estudiantes</p>
                <svg class="w-6 h-6 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <p class="text-4xl font-bold">{{ $totalEstudiantes }}</p>
        </div>
        <div class="bg-gradient-to-br from-gray-600 to-gray-700 rounded-2xl shadow-sm p-6 text-white">
            <div class="flex items-center justify-between mb-2">
                <p class="text-sm opacity-90">Jueces</p>
                <svg class="w-6 h-6 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
            </div>
            <p class="text-4xl font-bold">{{ $totalJueces }}</p>
        </div>
        <div class="bg-gradient-to-br from-gray-500 to-gray-600 rounded-2xl shadow-sm p-6 text-white">
            <div class="flex items-center justify-between mb-2">
                <p class="text-sm opacity-90">Asesores</p>
                <svg class="w-6 h-6 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            <p class="text-4xl font-bold">{{ $totalAsesores }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Gestión de Usuarios -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Filtros y Búsqueda -->
            <form method="GET" action="{{ route('admin.administracion') }}" class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-2">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar usuarios..." class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
                    </div>
                    <div>
                        <select name="role" onchange="this.form.submit()" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
                            <option value="all">Todos los roles</option>
                            <option value="estudiante" {{ request('role') == 'estudiante' ? 'selected' : '' }}>Estudiante</option>
                            <option value="juez" {{ request('role') == 'juez' ? 'selected' : '' }}>Juez</option>
                            <option value="asesor" {{ request('role') == 'asesor' ? 'selected' : '' }}>Asesor</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                        </select>
                    </div>
                </div>
            </form>

            <!-- Tabla de Usuarios -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-bold text-gray-900">Lista de Usuarios</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actividad</th>
                                <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($usuarios as $usuario)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ substr($usuario->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $usuario->name }}</p>
                                            <p class="text-sm text-gray-600">{{ $usuario->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 {{ $usuario->getRoleBadgeClass() }} text-xs font-medium rounded-full">
                                        {{ $usuario->getRoleName() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600">
                                        @if($usuario->user_type == 'estudiante' || $usuario->role == 'estudiante')
                                            <p>{{ $usuario->teams_count }} equipos</p>
                                        @elseif($usuario->user_type == 'juez' || $usuario->role == 'juez')
                                            <p>Juez del sistema</p>
                                        @elseif($usuario->user_type == 'maestro' || $usuario->role == 'asesor')
                                            <p>Asesor del sistema</p>
                                        @else
                                            <p>Administrador</p>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button onclick="openEditUserModal('{{ $usuario->id }}')" class="px-3 py-1.5 text-sm font-medium text-blue-700 hover:bg-blue-50 rounded-lg transition-colors">
                                            Editar
                                        </button>
                                        @if($usuario->id !== auth()->id())
                                        <button onclick="confirmDeleteUser('{{ $usuario->id }}', '{{ $usuario->name }}')" class="px-3 py-1.5 text-sm font-medium text-red-700 hover:bg-red-50 rounded-lg transition-colors">
                                            Eliminar
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                    No se encontraron usuarios
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                @if($usuarios->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $usuarios->links() }}
                </div>
                @endif
            </div>
        </div>

        <!-- Actividad Reciente -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 sticky top-8">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Actividad Reciente</h2>
                
                <div class="space-y-4">
                    @forelse($actividadReciente as $actividad)
                    <div class="flex gap-3 items-start">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-2 h-2 bg-{{ $actividad['color'] }}-500 rounded-full"></div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900 font-medium">{{ $actividad['mensaje'] }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $actividad['tiempo'] }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 text-sm text-center py-4">No hay actividad reciente</p>
                    @endforelse
                </div>

                <!-- Configuración Rápida -->
                <div class="mt-8 pt-6 border-t border-gray-100">
                    <h3 class="text-sm font-bold text-gray-900 mb-4">Configuración Rápida</h3>
                    
                    <div class="space-y-3">
                        <button class="w-full px-4 py-3 text-left text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition-colors flex items-center justify-between">
                            <span>Notificaciones</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                        
                        <button class="w-full px-4 py-3 text-left text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition-colors flex items-center justify-between">
                            <span>Respaldos</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                        
                        <button class="w-full px-4 py-3 text-left text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition-colors flex items-center justify-between">
                            <span>Seguridad</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Usuario -->
<div id="createUserModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-900">Crear Nuevo Usuario</h2>
                <button onclick="closeCreateUserModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <form action="{{ route('admin.administracion.crear-usuario') }}" method="POST" class="p-6">
            @csrf
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nombre Completo *</label>
                    <input type="text" name="name" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Número de Control (Opcional)</label>
                    <input type="text" name="numero_control" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Contraseña *</label>
                    <input type="password" name="password" required minlength="8" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                    <p class="text-xs text-gray-500 mt-1">Mínimo 8 caracteres</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirmar Contraseña *</label>
                    <input type="password" name="password_confirmation" required minlength="8" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rol del Usuario *</label>
                    <select name="user_type" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                        <option value="">Seleccionar rol...</option>
                        <option value="estudiante">Estudiante</option>
                        <option value="juez">Juez</option>
                        <option value="maestro">Asesor/Maestro</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
            </div>
            
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-200">
                <button type="button" onclick="closeCreateUserModal()" class="px-6 py-2.5 text-gray-700 hover:bg-gray-100 rounded-xl transition-colors font-medium">
                    Cancelar
                </button>
                <button type="submit" class="px-6 py-2.5 bg-gray-900 hover:bg-gray-800 text-white rounded-xl transition-colors font-medium">
                    Crear Usuario
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Editar Usuario -->
<div id="editUserModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-900">Editar Usuario</h2>
                <button onclick="closeEditUserModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="editUserForm" method="POST" class="p-6">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nombre *</label>
                    <input type="text" name="name" id="edit_name" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" id="edit_email" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rol *</label>
                    <select name="role" id="edit_role" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900">
                        <option value="estudiante">Estudiante</option>
                        <option value="juez">Juez</option>
                        <option value="asesor">Asesor</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
            </div>
            
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-200">
                <button type="button" onclick="closeEditUserModal()" class="px-6 py-2.5 text-gray-700 hover:bg-gray-100 rounded-xl transition-colors font-medium">
                    Cancelar
                </button>
                <button type="submit" class="px-6 py-2.5 bg-gray-900 hover:bg-gray-800 text-white rounded-xl transition-colors font-medium">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

<script>
const usuarios = @json($usuarios->items());

function openCreateUserModal() {
    document.getElementById('createUserModal').classList.remove('hidden');
}

function closeCreateUserModal() {
    document.getElementById('createUserModal').classList.add('hidden');
}

function openEditUserModal(userId) {
    const usuario = usuarios.find(u => u.id === userId);
    if (usuario) {
        document.getElementById('edit_name').value = usuario.name;
        document.getElementById('edit_email').value = usuario.email;
        document.getElementById('edit_role').value = usuario.role;
        document.getElementById('editUserForm').action = `/admin/administracion/usuarios/${userId}`;
        document.getElementById('editUserModal').classList.remove('hidden');
    }
}

function closeEditUserModal() {
    document.getElementById('editUserModal').classList.add('hidden');
}

function confirmDeleteUser(userId, userName) {
    if (confirm(`¿Estás seguro de que deseas eliminar al usuario "${userName}"? Esta acción no se puede deshacer.`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/administracion/usuarios/${userId}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}

// Cerrar modales al hacer clic fuera
document.addEventListener('click', function(event) {
    const createModal = document.getElementById('createUserModal');
    const editModal = document.getElementById('editUserModal');
    
    if (event.target === createModal) {
        closeCreateUserModal();
    }
    if (event.target === editModal) {
        closeEditUserModal();
    }
});
</script>

@endsection
