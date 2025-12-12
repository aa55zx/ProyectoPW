<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\WelcomeMail;

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
     * Manejar el registro de nuevo usuario
     */
    public function register(Request $request)
    {
        // Validar los datos
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'numero_control' => ['required', 'string', 'max:20', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'career' => ['required', 'string', 'max:100'],
            'semester' => ['required', 'integer', 'min:1', 'max:12'],
        ], [
            'name.required' => 'El nombre es obligatorio',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'Debe ser un correo electrónico válido',
            'email.unique' => 'Este correo ya está registrado',
            'numero_control.required' => 'El número de control es obligatorio',
            'numero_control.unique' => 'Este número de control ya está registrado',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'career.required' => 'La carrera es obligatoria',
            'semester.required' => 'El semestre es obligatorio',
        ]);

        try {
            // Crear el usuario
            $user = User::create([
                'id' => (string) Str::uuid(),
                'name' => $validated['name'],
                'email' => $validated['email'],
                'numero_control' => $validated['numero_control'],
                'password' => Hash::make($validated['password']),
                'user_type' => 'estudiante',
                'career' => $validated['career'],
                'semester' => $validated['semester'],
                'is_active' => true,
            ]);

            // NOTA: Correo de bienvenida deshabilitado temporalmente para evitar timeouts
            // Se puede habilitar cuando se configure un servicio de correo real (SendGrid, Mailgun, etc.)
            /*
            try {
                Mail::to($user->email)->send(new WelcomeMail($user));
            } catch (\Exception $e) {
                \Log::error('Error al enviar correo de bienvenida: ' . $e->getMessage());
            }
            */

            // Login automático
            Auth::login($user, true);
            
            // Regenerar sesión para seguridad
            $request->session()->regenerate();

            // Redirigir inmediatamente al dashboard
            return redirect('/estudiante/dashboard')
                ->with('success', '¡Bienvenido a EventTec! Tu cuenta ha sido creada exitosamente.');

        } catch (\Exception $e) {
            \Log::error('Error en registro: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return back()->withErrors([
                'error' => 'Ocurrió un error al crear tu cuenta. Por favor, intenta de nuevo.',
            ])->withInput($request->except('password', 'password_confirmation'));
        }
    }

    /**
     * Redirigir al dashboard según el tipo de usuario
     */
    protected function redirectToDashboard(User $user)
    {
        $message = '¡Bienvenido a EventTec! Tu cuenta ha sido creada exitosamente.';
        
        if ($user->isEstudiante()) {
            return redirect()->route('estudiante.dashboard')->with('success', $message);
        } elseif ($user->isMaestro()) {
            return redirect()->route('asesor.dashboard')->with('success', $message);
        } elseif ($user->isJuez()) {
            return redirect()->route('juez.dashboard')->with('success', $message);
        } elseif ($user->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('success', $message);
        }

        // Por defecto, enviar al dashboard de estudiante
        return redirect()->route('estudiante.dashboard')->with('success', $message);
    }
}
