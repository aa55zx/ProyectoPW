<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AsesorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario asesor principal - Ana García
        User::create([
            'name' => 'Ana García',
            'email' => 'ana.garcia@asesor.com',
            'password' => Hash::make('password123'),
            'user_type' => 'maestro',  // Cambiado a maestro
            'numero_control' => 'ASESOR001',
        ]);

        // Crear usuario asesor secundario - Carlos Mendoza
        User::create([
            'name' => 'Carlos Mendoza',
            'email' => 'carlos.mendoza@asesor.com',
            'password' => Hash::make('password123'),
            'user_type' => 'maestro',  // Cambiado a maestro
            'numero_control' => 'ASESOR002',
        ]);

        // Crear usuario maestro adicional - María López
        User::create([
            'name' => 'María López',
            'email' => 'maria.lopez@maestro.com',
            'password' => Hash::make('password123'),
            'user_type' => 'maestro',
            'numero_control' => 'MAESTRO001',
        ]);

        echo "✅ Usuarios asesor/maestro creados exitosamente\n";
        echo "📧 Email: ana.garcia@asesor.com | Password: password123\n";
        echo "📧 Email: carlos.mendoza@asesor.com | Password: password123\n";
        echo "📧 Email: maria.lopez@maestro.com | Password: password123\n";
    }
}
