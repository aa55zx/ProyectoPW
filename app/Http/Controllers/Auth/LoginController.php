<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

            $user->updateLastLogin();

            return match($user->user_type) {
                'admin' => redirect()->intended('/admin/dashboard'),
                'maestro' => redirect()->intended('/maestro/dashboard'),
                'juez' => redirect()->intended('/juez/dashboard'),
                'estudiante' => redirect()->intended('/estudiante/dashboard'),
                default => redirect()->intended('/estudiante/dashboard'),
            };

        } catch (\Exception $e) {
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
