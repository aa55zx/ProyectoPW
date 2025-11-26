<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Mostrar el formulario de registro
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Procesar el registro
     */
    public function register(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'numero_control' => ['required', 'string', 'max:20', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'user_type' => ['required', 'in:estudiante,docente,admin'],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe proporcionar un correo electrónico válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'numero_control.required' => 'El número de control es obligatorio.',
            'numero_control.unique' => 'Este número de control ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        // Crear el usuario
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'numero_control' => $validated['numero_control'],
            'password' => Hash::make($validated['password']),
            'user_type' => $validated['user_type'],
        ]);

        // Iniciar sesión automáticamente
        Auth::login($user);

        // Redirigir según el tipo de usuario
        return $this->redirectBasedOnRole($user);
    }

    /**
     * Redirigir según el rol del usuario
     */
    protected function redirectBasedOnRole($user)
    {
        switch ($user->user_type) {
            case 'admin':
                return redirect('/admin/dashboard')->with('success', '¡Registro exitoso! Bienvenido.');
            case 'docente':
                return redirect('/docente/dashboard')->with('success', '¡Registro exitoso! Bienvenido.');
            case 'estudiante':
                return redirect('/estudiante/dashboard')->with('success', '¡Registro exitoso! Bienvenido.');
            default:
                return redirect('/dashboard')->with('success', '¡Registro exitoso! Bienvenido.');
        }
    }
}