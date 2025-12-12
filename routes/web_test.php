<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

// Ruta de prueba de login
Route::get('/test-login', function () {
    // Buscar un usuario
    $user = User::where('email', 'admin@eventec.com')->first();
    
    if (!$user) {
        return 'ERROR: No se encontró el usuario admin@eventec.com';
    }
    
    // Intentar login
    Auth::login($user);
    
    // Verificar si funcionó
    if (Auth::check()) {
        return 'SUCCESS: Login funcionó! Usuario: ' . Auth::user()->name . ' | Tipo: ' . Auth::user()->user_type;
    } else {
        return 'ERROR: Login falló. Auth::check() devuelve false';
    }
});

// Ruta para probar sesiones
Route::get('/test-session', function () {
    // Guardar algo en sesión
    session(['test_key' => 'test_value_' . time()]);
    
    // Leer de sesión
    $value = session('test_key');
    
    return [
        'session_driver' => config('session.driver'),
        'session_works' => $value !== null,
        'session_value' => $value,
        'session_path' => storage_path('framework/sessions'),
        'session_path_exists' => is_dir(storage_path('framework/sessions')),
        'session_path_writable' => is_writable(storage_path('framework/sessions')),
    ];
});

// Ruta para verificar configuración
Route::get('/test-config', function () {
    return [
        'app_env' => config('app.env'),
        'app_debug' => config('app.debug'),
        'db_connection' => config('database.default'),
        'db_database' => config('database.connections.mysql.database'),
        'session_driver' => config('session.driver'),
        'session_lifetime' => config('session.lifetime'),
        'cache_store' => config('cache.default'),
        'users_count' => \App\Models\User::count(),
    ];
});
