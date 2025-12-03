<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

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
     * Manejar el registro de un nuevo usuario (solo estudiantes)
     */
    public function register(Request $request)
    {
        // Validar los datos
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'numero_control' => ['required', 'string', 'max:20', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.required' => 'El nombre es obligatorio',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'Debe ser un correo electrónico válido',
            'email.unique' => 'Este correo ya está registrado',
            'numero_control.required' => 'El número de control es obligatorio',
            'numero_control.unique' => 'Este número de control ya está registrado',
            'password.required' => 'La contraseña es obligatoria',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ]);

        // Crear el usuario (siempre como estudiante)
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'numero_control' => $validated['numero_control'],
            'user_type' => 'estudiante', // Siempre estudiante
            'password' => Hash::make($validated['password']),
            'email_verified_at' => now(),
        ]);

        // Iniciar sesión automáticamente
        Auth::login($user);

        // Redirigir al dashboard de estudiante
        return redirect('/estudiante/dashboard')->with('success', '¡Cuenta creada exitosamente!');
    }
}
