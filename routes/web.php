<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AsesorController;

// Redirigir raíz al login
Route::get('/', function () {
    return redirect()->route('login');
});

// ==========================================
// RUTAS DE AUTENTICACIÓN (públicas)
// ==========================================

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ==========================================
// RUTAS PROTEGIDAS (requieren autenticación)
// ==========================================

Route::middleware('auth')->group(function () {
    
    // ==========================================
    // RUTAS DE ESTUDIANTE
    // ==========================================
    Route::prefix('estudiante')->name('estudiante.')->group(function () {
        Route::get('/dashboard', function () {
            return view('estudiante.dashboard');
        })->name('dashboard');
        
        Route::get('/eventos', function () {
            return view('estudiante.eventos');
        })->name('eventos');
        
        Route::get('/eventos/{id}', function ($id) {
            return view('estudiante.evento-detalle', ['id' => $id]);
        })->name('evento-detalle');
        
        Route::post('/registrar-equipo', function () {
            // Por ahora solo redirige de vuelta
            return redirect()->back()->with('success', 'Equipo registrado exitosamente');
        })->name('registrar-equipo');
        
        Route::get('/equipos', function () {
            return view('estudiante.mi-equipo');
        })->name('equipos');
        
        Route::get('/proyectos', function () {
            return view('estudiante.mi-progreso');
        })->name('proyectos');
        
        Route::get('/rankings', function () {
            return view('estudiante.dashboard');
        })->name('rankings');
        
        Route::get('/perfil', function () {
            return view('estudiante.dashboard');
        })->name('perfil');
    });
    
    // ==========================================
    // RUTAS DE MAESTRO (ASESOR)
    // ==========================================
    Route::prefix('maestro')->name('maestro.')->group(function () {
        Route::get('/dashboard', function () {
            return view('maestro.dashboard');
        })->name('dashboard');
    });
    
    // ==========================================
    // RUTAS DE ASESOR
    // ==========================================
    Route::prefix('asesor')->name('asesor.')->group(function () {
        Route::get('/dashboard', [AsesorController::class, 'dashboard'])->name('dashboard');
        Route::get('/eventos', [AsesorController::class, 'eventos'])->name('eventos');
        Route::get('/evento/{id}', [AsesorController::class, 'eventoDetalle'])->name('evento-detalle');
        Route::get('/equipos', [AsesorController::class, 'equipos'])->name('equipos');
        Route::get('/proyectos', [AsesorController::class, 'proyectos'])->name('proyectos');
        Route::get('/rankings', [AsesorController::class, 'rankings'])->name('rankings');
        Route::get('/mi-perfil', [AsesorController::class, 'miPerfil'])->name('mi-perfil');
    });
    
    // ==========================================
    // RUTAS DE JUEZ
    // ==========================================
    Route::prefix('juez')->name('juez.')->group(function () {
        Route::get('/dashboard', function () {
            return view('juez.dashboard');
        })->name('dashboard');
    });
    
    // ==========================================
    // RUTAS DE ADMIN
    // ==========================================
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });
    
});
