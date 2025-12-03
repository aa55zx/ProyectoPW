<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ==========================================
        // USUARIOS ASESORES (MAESTROS)
        // ==========================================
        
        // Asesor 1 - Ana García
        User::create([
            'name' => 'Ana García',
            'email' => 'ana.garcia@asesor.com',
            'password' => Hash::make('password123'),
            'user_type' => 'maestro',
            'numero_control' => 'ASESOR001',
        ]);

        // Asesor 2 - Carlos Mendoza
        User::create([
            'name' => 'Carlos Mendoza',
            'email' => 'carlos.mendoza@asesor.com',
            'password' => Hash::make('password123'),
            'user_type' => 'maestro',
            'numero_control' => 'ASESOR002',
        ]);

        // Asesor 3 - María López
        User::create([
            'name' => 'María López',
            'email' => 'maria.lopez@maestro.com',
            'password' => Hash::make('password123'),
            'user_type' => 'maestro',
            'numero_control' => 'MAESTRO001',
        ]);

        // ==========================================
        // USUARIOS ESTUDIANTES
        // ==========================================
        
        User::create([
            'name' => 'Carlos Méndez',
            'email' => 'carlos@estudiante.com',
            'numero_control' => '20211234',
            'password' => Hash::make('password123'),
            'user_type' => 'estudiante',
        ]);

        User::create([
            'name' => 'Luis Cheluis',
            'email' => 'cheluisruiz8@gmail.com',
            'numero_control' => '20211235',
            'password' => Hash::make('password'),
            'user_type' => 'estudiante',
        ]);

        // ==========================================
        // USUARIO JUEZ
        // ==========================================
        
        User::create([
            'name' => 'Ing. María García',
            'email' => 'maria@juez.com',
            'numero_control' => '30001234',
            'password' => Hash::make('password123'),
            'user_type' => 'juez',
        ]);

        // ==========================================
        // USUARIO ADMIN
        // ==========================================
        
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@eventec.com',
            'numero_control' => '99999999',
            'password' => Hash::make('admin123'),
            'user_type' => 'admin',
        ]);

        echo "\n";
        echo "✅ Base de datos poblada exitosamente\n";
        echo "\n";
        echo "📚 USUARIOS ASESORES (MAESTROS):\n";
        echo "   📧 ana.garcia@asesor.com | 🔑 password123\n";
        echo "   📧 carlos.mendoza@asesor.com | 🔑 password123\n";
        echo "   📧 maria.lopez@maestro.com | 🔑 password123\n";
        echo "\n";
        echo "📚 USUARIOS ESTUDIANTES:\n";
        echo "   📧 carlos@estudiante.com | 🔑 password123\n";
        echo "   📧 cheluisruiz8@gmail.com | 🔑 password\n";
        echo "\n";
        echo "📚 USUARIO JUEZ:\n";
        echo "   📧 maria@juez.com | 🔑 password123\n";
        echo "\n";
        echo "📚 USUARIO ADMIN:\n";
        echo "   📧 admin@eventec.com | 🔑 admin123\n";
        echo "\n";
    }
}
