<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Registrar los middlewares personalizados
        $middleware->alias([
            'admin' => \App\Http\Middleware\CheckAdmin::class,
            'estudiante' => \App\Http\Middleware\CheckEstudiante::class,
            'juez' => \App\Http\Middleware\CheckJuez::class,
            'asesor' => \App\Http\Middleware\CheckAsesor::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Manejo personalizado de errores 404
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Recurso no encontrado',
                    'message' => 'La ruta solicitada no existe'
                ], 404);
            }
            
            return response()->view('errors.404', [], 404);
        });

        // Manejo personalizado de errores 403
        $exceptions->render(function (AccessDeniedHttpException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Acceso denegado',
                    'message' => 'No tienes permisos para acceder a este recurso'
                ], 403);
            }
            
            return response()->view('errors.403', [], 403);
        });

        // Manejo personalizado de errores 500
        $exceptions->render(function (Throwable $e, Request $request) {
            // Solo manejar errores 500 en producción
            if (app()->environment('production')) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'error' => 'Error del servidor',
                        'message' => 'Ha ocurrido un error en el servidor'
                    ], 500);
                }
                
                // Si es un error no manejado específicamente, mostrar página 500
                if ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
                    $statusCode = $e->getStatusCode();
                    
                    // Verificar si existe una vista personalizada para este código de estado
                    if (view()->exists("errors.{$statusCode}")) {
                        return response()->view("errors.{$statusCode}", [], $statusCode);
                    }
                }
            }
            
            // En desarrollo, dejar que Laravel maneje el error normalmente
            return null;
        });
    })->create();
