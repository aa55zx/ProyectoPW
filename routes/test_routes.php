<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// AGREGAR ESTAS RUTAS AL FINAL DE routes/web.php DENTRO DEL if (app()->environment('local'))

Route::get('/test-login', function () {
    $user = \App\Models\User::where('email', 'admin@eventec.com')->first();
    
    if (!$user) {
        return 'ERROR: No se encontró el usuario admin@eventec.com';
    }
    
    Auth::login($user);
    
    if (Auth::check()) {
        return 'SUCCESS: Login funcionó! Usuario: ' . Auth::user()->name . ' | Tipo: ' . Auth::user()->user_type;
    } else {
        return 'ERROR: Login falló. Auth::check() devuelve false';
    }
});

Route::get('/test-session', function () {
    session(['test_key' => 'test_value_' . time()]);
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
