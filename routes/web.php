<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Estudiante\DashboardController;
use App\Http\Controllers\Estudiante\EventoController;
use App\Http\Controllers\Estudiante\EquipoController;
use App\Http\Controllers\Estudiante\ProyectoController;
use App\Http\Controllers\Estudiante\RankingController;
use App\Http\Controllers\Estudiante\PerfilController;
use App\Http\Controllers\AsesorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Juez\JuezDashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

// AUTENTICACIÓN
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// RUTAS PROTEGIDAS
Route::middleware('auth')->group(function () {
    
    // ESTUDIANTE
    Route::prefix('estudiante')->name('estudiante.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::get('/eventos', [EventoController::class, 'index'])->name('eventos');
        Route::get('/eventos/{id}', [EventoController::class, 'show'])->name('evento-detalle');
        Route::post('/registrar-equipo', [EventoController::class, 'registrarEquipo'])->name('registrar-equipo');
        
        Route::get('/equipos', [EquipoController::class, 'index'])->name('equipos');
        Route::post('/equipos', [EquipoController::class, 'store'])->name('equipos.store');
        Route::post('/equipos/join', [EquipoController::class, 'join'])->name('equipos.join');
        Route::get('/equipos/{id}', [EquipoController::class, 'show'])->name('equipos.show');
        Route::delete('/equipos/{id}/leave', [EquipoController::class, 'leave'])->name('equipos.leave');
        
        Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyectos');
        Route::post('/proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');
        Route::get('/proyectos/{id}', [ProyectoController::class, 'show'])->name('proyectos.show');
        Route::put('/proyectos/{id}', [ProyectoController::class, 'update'])->name('proyectos.update');
        Route::delete('/proyectos/{id}', [ProyectoController::class, 'destroy'])->name('proyectos.destroy');
        
        Route::get('/rankings', [RankingController::class, 'index'])->name('rankings');
        
        // Perfil
        Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');
        Route::post('/perfil', [PerfilController::class, 'update'])->name('perfil.update');
        Route::post('/perfil/password', [PerfilController::class, 'updatePassword'])->name('perfil.update-password');
    });
    
    // ASESOR
    Route::prefix('asesor')->name('asesor.')->group(function () {
        Route::get('/dashboard', [AsesorController::class, 'dashboard'])->name('dashboard');
        Route::get('/eventos', [AsesorController::class, 'eventos'])->name('eventos');
        Route::get('/evento/{id}', [AsesorController::class, 'eventoDetalle'])->name('evento-detalle');
        Route::get('/equipos', [AsesorController::class, 'equipos'])->name('equipos');
        Route::get('/proyectos', [AsesorController::class, 'proyectos'])->name('proyectos');
        Route::get('/rankings', [AsesorController::class, 'rankings'])->name('rankings');
        Route::get('/mi-perfil', [AsesorController::class, 'miPerfil'])->name('mi-perfil');
    });
    
    // JUEZ
    Route::prefix('juez')->name('juez.')->group(function () {
        Route::get('/dashboard', [JuezDashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/eventos', [JuezDashboardController::class, 'eventos'])->name('eventos');
        Route::get('/evaluaciones', [JuezDashboardController::class, 'evaluaciones'])->name('evaluaciones');
        Route::get('/evaluaciones/{id}', [JuezDashboardController::class, 'evaluarProyecto'])->name('evaluar-proyecto');
        Route::post('/evaluaciones/{id}', [JuezDashboardController::class, 'guardarEvaluacion'])->name('guardar-evaluacion');
        Route::get('/rankings', [JuezDashboardController::class, 'rankings'])->name('rankings');
        Route::get('/perfil', [JuezDashboardController::class, 'perfil'])->name('perfil');
        Route::put('/perfil', [JuezDashboardController::class, 'updatePerfil'])->name('update-perfil');
        Route::put('/perfil/password', [JuezDashboardController::class, 'updatePassword'])->name('update-password');
    });
    
    // ADMIN
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/eventos', [AdminController::class, 'eventos'])->name('eventos');
        Route::get('/equipos', [AdminController::class, 'equipos'])->name('equipos');
        Route::get('/rankings', [AdminController::class, 'rankings'])->name('rankings');
        Route::get('/administracion', [AdminController::class, 'administracion'])->name('administracion');
        Route::get('/perfil', [AdminController::class, 'perfil'])->name('perfil');
    });
});
