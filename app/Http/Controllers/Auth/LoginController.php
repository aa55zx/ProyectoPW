<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Mostrar el formulario de login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Procesar el login
     */
    public function login(Request $request)
    {
        // Validar los datos del formulario
        $credentials = $request->validate([
            'numero_control' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Redirigir según el tipo de usuario
            $user = Auth::user();
            
            return $this->redirectBasedOnRole($user);
        }

        // Si falla la autenticación
        throw ValidationException::withMessages([
            'numero_control' => ['Las credenciales proporcionadas no coinciden con nuestros registros.'],
        ]);
    }

    /**
     * Redirigir según el rol del usuario
     */
    protected function redirectBasedOnRole($user)
    {
        switch ($user->user_type) {
            case 'admin':
                return redirect()->intended('/admin/dashboard');
            case 'docente':
                return redirect()->intended('/docente/dashboard');
            case 'estudiante':
                return redirect()->intended('/estudiante/dashboard');
            default:
                return redirect()->intended('/dashboard');
        }
    }

    /**
     * Cerrar sesión
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}