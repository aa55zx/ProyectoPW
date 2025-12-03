<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

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
        //
    })->create();
