<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Ruta temporal para reset password
Route::get('/password/reset', function () {
    return view('auth.passwords.reset');
})->name('password.request');

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Cambia la línea del dashboard de estudiante por:
Route::get('/estudiante/dashboard', function () {
    return view('estudiante.dashboard');
})->name('estudiante.dashboard')->middleware('auth');
    
    Route::get('/docente/dashboard', function () {
        return view('docente.dashboard');
    })->name('docente.dashboard');
    
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});