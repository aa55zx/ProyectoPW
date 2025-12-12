<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorTestController extends Controller
{
    /**
     * Página de prueba de errores
     * Solo disponible en desarrollo
     */
    public function index()
    {
        if (!app()->environment('local')) {
            abort(404);
        }

        return view('errors.test-index');
    }

    /**
     * Muestra la página de error 401
     */
    public function show401()
    {
        abort(401);
    }

    /**
     * Muestra la página de error 403
     */
    public function show403()
    {
        abort(403);
    }

    /**
     * Muestra la página de error 404
     */
    public function show404()
    {
        abort(404);
    }

    /**
     * Muestra la página de error 419
     */
    public function show419()
    {
        abort(419);
    }

    /**
     * Muestra la página de error 500
     */
    public function show500()
    {
        throw new \Exception('Error de prueba 500');
    }

    /**
     * Muestra la página de error 503
     */
    public function show503()
    {
        abort(503);
    }
}
