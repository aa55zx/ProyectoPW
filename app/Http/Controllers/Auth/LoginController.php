<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'Debe ser un correo electrónico válido',
            'password.required' => 'La contraseña es obligatoria',
        ]);

        try {
            $user = \App\Models\User::where('email', $credentials['email'])->first();

            if (!$user) {
                return back()->withErrors([
                    'email' => 'No existe una cuenta con este correo electrónico.',
                ])->withInput($request->only('email'));
            }

            if (!$user->is_active) {
                return back()->withErrors([
                    'email' => 'Tu cuenta ha sido desactivada. Contacta al administrador.',
                ])->withInput($request->only('email'));
            }

            if (!Hash::check($credentials['password'], $user->password)) {
                return back()->withErrors([
                    'email' => 'Las credenciales proporcionadas son incorrectas.',
                ])->withInput($request->only('email'));
            }

            Auth::login($user, $request->filled('remember'));
            $request->session()->regenerate();

            // Actualizar último login si el método existe
            if (method_exists($user, 'updateLastLogin')) {
                $user->updateLastLogin();
            }

            // CORREGIDO: Obtener el rol del campo correcto (user_type es el campo real en BD)
            $rol = $user->user_type ?? 'estudiante';
            
            // Log para debugging
            Log::info('Login exitoso', [
                'email' => $user->email,
                'user_type' => $user->user_type,
                'rol_detectado' => $rol
            ]);
            
            // Redirigir según el user_type
            return match($rol) {
                'admin', 'administrador' => redirect()->intended('/admin/dashboard'),
                'maestro', 'asesor', 'profesor' => redirect()->intended('/asesor/dashboard'),
                'juez' => redirect()->intended('/juez/dashboard'),
                'estudiante' => redirect()->intended('/estudiante/dashboard'),
                default => redirect()->intended('/estudiante/dashboard'),
            };

        } catch (\Exception $e) {
            Log::error('Error en login: ' . $e->getMessage());
            return back()->withErrors([
                'email' => 'Ocurrió un error al intentar iniciar sesión. Por favor, intenta de nuevo.',
            ])->withInput($request->only('email'));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Sesión cerrada correctamente');
    }
}
