<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEstudiante
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión primero.');
        }

        // Obtener el rol del usuario (puede estar en 'rol' o 'user_type')
        $rol = auth()->user()->rol ?? auth()->user()->user_type ?? '';

        // Verificar si el usuario tiene el rol de estudiante
        if ($rol !== 'estudiante') {
            abort(403, 'No tienes permiso para acceder a esta área de Estudiantes.');
        }

        return $next($request);
    }
}
