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
use App\Http\Controllers\ErrorTestController;

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

        // EVENTOS
        Route::get('/eventos', [EventoController::class, 'index'])->name('eventos');
        Route::get('/eventos/{id}', [EventoController::class, 'show'])->name('evento-detalle');
        Route::post('/eventos/inscribir-equipo', [EventoController::class, 'inscribirEquipo'])->name('eventos.inscribir-equipo');
        Route::post('/eventos/solicitar-unirse', [EventoController::class, 'solicitarUnirse'])->name('eventos.solicitar-unirse');
        Route::post('/registrar-equipo', [EventoController::class, 'registrarEquipo'])->name('registrar-equipo');

        // EQUIPOS
        Route::get('/equipos', [EquipoController::class, 'index'])->name('equipos');
        Route::post('/equipos', [EquipoController::class, 'store'])->name('equipos.store');
        Route::post('/equipos/join', [EquipoController::class, 'join'])->name('equipos.join');
        Route::get('/equipos/{id}', [EquipoController::class, 'show'])->name('equipos.show');
        Route::delete('/equipos/{id}/leave', [EquipoController::class, 'leave'])->name('equipos.leave');
        Route::post('/equipos/aceptar-solicitud', [EquipoController::class, 'aceptarSolicitud'])->name('equipos.aceptar-solicitud');
        Route::post('/equipos/rechazar-solicitud', [EquipoController::class, 'rechazarSolicitud'])->name('equipos.rechazar-solicitud');

        // PROYECTOS
        Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyectos');
        Route::post('/proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');
        
        // Rutas específicas ANTES de la ruta genérica {id}
        Route::post('/proyectos/{id}/solicitar-asesor', [ProyectoController::class, 'solicitarAsesor'])->name('proyectos.solicitar-asesor');
        Route::post('/proyectos/{id}/cancelar-solicitud-asesor', [ProyectoController::class, 'cancelarSolicitudAsesor'])->name('proyectos.cancelar-solicitud-asesor');
        Route::post('/proyectos/{id}/submit-file', [ProyectoController::class, 'submitFile'])->name('proyectos.submit-file');
        Route::get('/proyectos/{id}/download-submission', [ProyectoController::class, 'downloadSubmission'])->name('proyectos.download-submission');
        Route::delete('/proyectos/{id}/delete-submission', [ProyectoController::class, 'deleteSubmission'])->name('proyectos.delete-submission');
        Route::get('/proyectos/{id}/descargar-constancia', [ProyectoController::class, 'descargarConstancia'])->name('proyectos.descargar-constancia');
        Route::get('/proyectos/{id}/descargar-reconocimiento', [ProyectoController::class, 'descargarReconocimiento'])->name('proyectos.descargar-reconocimiento');
        
        // Rutas genéricas al final
        Route::get('/proyectos/{id}', [ProyectoController::class, 'show'])->name('proyectos.show');
        Route::put('/proyectos/{id}', [ProyectoController::class, 'update'])->name('proyectos.update');
        Route::delete('/proyectos/{id}', [ProyectoController::class, 'destroy'])->name('proyectos.destroy');

        // RANKINGS
        Route::get('/rankings', [RankingController::class, 'index'])->name('rankings');

        // PERFIL
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
        Route::get('/proyecto/{id}', [AsesorController::class, 'proyectoDetalle'])->name('proyecto-detalle');
        Route::post('/proyecto/{id}/comentario', [AsesorController::class, 'agregarComentario'])->name('proyecto.comentario');
        Route::get('/rankings', [AsesorController::class, 'rankings'])->name('rankings');
        Route::get('/mi-perfil', [AsesorController::class, 'miPerfil'])->name('mi-perfil');
        Route::post('/mi-perfil', [AsesorController::class, 'actualizarPerfil'])->name('mi-perfil.actualizar');
Route::post('/mi-perfil/password', [AsesorController::class, 'actualizarPassword'])->name('mi-perfil.actualizar-password');
        
        // Solicitudes de asesoría
        Route::post('/solicitudes/{id}/aceptar', [AsesorController::class, 'aceptarSolicitud'])->name('solicitudes.aceptar');
        Route::post('/solicitudes/{id}/rechazar', [AsesorController::class, 'rechazarSolicitud'])->name('solicitudes.rechazar');
        
        // Equipos disponibles
        Route::get('/equipos-disponibles', [AsesorController::class, 'equiposDisponibles'])->name('equipos-disponibles');
        Route::post('/equipos/{project}/solicitar', [AsesorController::class, 'solicitarAsesorar'])->name('equipos.solicitar');
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

        // EVENTOS
        Route::get('/eventos', [AdminController::class, 'eventos'])->name('eventos');
        Route::post('/eventos', [AdminController::class, 'crearEvento'])->name('eventos.crear');
        Route::get('/eventos/{id}', [AdminController::class, 'verEvento'])->name('eventos.ver');
        Route::put('/eventos/{id}', [AdminController::class, 'actualizarEvento'])->name('eventos.actualizar');
        Route::delete('/eventos/{id}', [AdminController::class, 'eliminarEvento'])->name('eventos.eliminar');
        Route::post('/eventos/{id}/asignar-jueces', [AdminController::class, 'asignarJueces'])->name('eventos.asignar-jueces');
        Route::post('/eventos/{id}/asignar-asesores', [AdminController::class, 'asignarAsesores'])->name('eventos.asignar-asesores');

        // EQUIPOS
        Route::get('/equipos', [AdminController::class, 'equipos'])->name('equipos');
        Route::delete('/equipos/{id}', [AdminController::class, 'eliminarEquipo'])->name('equipos.eliminar');

        // RANKINGS
        Route::get('/rankings', [AdminController::class, 'rankings'])->name('rankings');

        // ADMINISTRACIÓN
        Route::get('/administracion', [AdminController::class, 'administracion'])->name('administracion');
        Route::post('/administracion/usuarios', [AdminController::class, 'crearUsuario'])->name('administracion.crear-usuario');
        Route::put('/administracion/usuarios/{id}', [AdminController::class, 'actualizarUsuario'])->name('administracion.actualizar-usuario');
        Route::delete('/administracion/usuarios/{id}', [AdminController::class, 'eliminarUsuario'])->name('administracion.eliminar-usuario');

        // PERFIL
        Route::get('/perfil', [AdminController::class, 'perfil'])->name('perfil');
        Route::put('/perfil', [AdminController::class, 'actualizarPerfil'])->name('perfil.actualizar');
        Route::put('/perfil/password', [AdminController::class, 'actualizarPassword'])->name('perfil.actualizar-password');
    });
});

// RUTAS DE PRUEBA DE ERRORES (Solo en desarrollo)
if (app()->environment('local')) {
    Route::prefix('test-errors')->group(function () {
        Route::get('/', [ErrorTestController::class, 'index'])->name('test-errors.index');
        Route::get('/401', [ErrorTestController::class, 'show401'])->name('test-errors.401');
        Route::get('/403', [ErrorTestController::class, 'show403'])->name('test-errors.403');
        Route::get('/404', [ErrorTestController::class, 'show404'])->name('test-errors.404');
        Route::get('/419', [ErrorTestController::class, 'show419'])->name('test-errors.419');
        Route::get('/500', [ErrorTestController::class, 'show500'])->name('test-errors.500');
        Route::get('/503', [ErrorTestController::class, 'show503'])->name('test-errors.503');
    });
}
