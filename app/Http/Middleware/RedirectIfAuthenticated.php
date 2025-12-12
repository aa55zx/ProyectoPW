<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
                
                // Redirigir según el tipo de usuario
                return match($user->user_type) {
                    'admin' => redirect('/admin/dashboard'),
                    'maestro' => redirect('/asesor/dashboard'),
                    'juez' => redirect('/juez/dashboard'),
                    'estudiante' => redirect('/estudiante/dashboard'),
                    default => redirect('/estudiante/dashboard'),
                };
            }
        }

        return $next($request);
    }
}
