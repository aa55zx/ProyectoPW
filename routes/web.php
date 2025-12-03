<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Estudiante\DashboardController;
use App\Http\Controllers\Estudiante\EventoController;
use App\Http\Controllers\Estudiante\EquipoController;
use App\Http\Controllers\AsesorController;
use App\Http\Controllers\AdminController;

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
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Eventos
        Route::get('/eventos', [EventoController::class, 'index'])->name('eventos');
        Route::get('/eventos/{id}', [EventoController::class, 'show'])->name('evento-detalle');
        Route::post('/registrar-equipo', [EventoController::class, 'registrarEquipo'])->name('registrar-equipo');
        
        // Equipos
        Route::get('/equipos', [EquipoController::class, 'index'])->name('equipos');
        Route::post('/equipos', [EquipoController::class, 'store'])->name('equipos.store');
        Route::get('/equipos/{id}', [EquipoController::class, 'show'])->name('equipos.show');
        Route::delete('/equipos/{id}/leave', [EquipoController::class, 'leave'])->name('equipos.leave');
        
        // Proyectos
        Route::get('/proyectos', function () {
            return view('estudiante.mi-progreso');
        })->name('proyectos');
        
        // Rankings
        Route::get('/rankings', function () {
            return view('estudiante.dashboard');
        })->name('rankings');
        
        // Perfil
        Route::get('/perfil', function () {
            return view('estudiante.dashboard');
        })->name('perfil');
    });
    
    // ==========================================
    // RUTAS DE ASESOR (MAESTRO)
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
        
        Route::get('/eventos', function () {
            return view('juez.eventos');
        })->name('eventos');
        
        Route::get('/evaluaciones', function () {
            return view('juez.evaluaciones');
        })->name('evaluaciones');
        
        Route::get('/evaluaciones/{id}', function ($id) {
            return view('juez.evaluar-proyecto', ['id' => $id]);
        })->name('evaluar-proyecto');
        
        Route::post('/evaluaciones/{id}', function ($id) {
            return redirect()->route('juez.evaluaciones')->with('success', 'Evaluación guardada exitosamente');
        })->name('guardar-evaluacion');
        
        Route::get('/rankings', function () {
            return view('juez.rankings');
        })->name('rankings');
        
        Route::get('/perfil', function () {
            return view('juez.perfil');
        })->name('perfil');
    });
    
    // ==========================================
    // RUTAS DE ADMIN
    // ==========================================
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/eventos', [AdminController::class, 'eventos'])->name('eventos');
        Route::get('/equipos', [AdminController::class, 'equipos'])->name('equipos');
        Route::get('/rankings', [AdminController::class, 'rankings'])->name('rankings');
        Route::get('/administracion', [AdminController::class, 'administracion'])->name('administracion');
        Route::get('/perfil', [AdminController::class, 'perfil'])->name('perfil');
    });
    
});
