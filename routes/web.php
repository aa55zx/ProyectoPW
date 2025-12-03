<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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
            // Guardar evaluación
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
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });
    
});
