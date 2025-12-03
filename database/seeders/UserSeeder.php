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
        // Crear usuario estudiante
        User::create([
            'name' => 'Carlos Méndez',
            'email' => 'carlos@estudiante.com',
            'numero_control' => '20211234',
            'password' => Hash::make('password123'),
            'user_type' => 'estudiante',
        ]);

        // Crear usuario maestro
        User::create([
            'name' => 'Dr. Juan Pérez',
            'email' => 'juan@maestro.com',
            'numero_control' => '10001234',
            'password' => Hash::make('password123'),
            'user_type' => 'maestro',
        ]);

        // Crear usuario juez
        User::create([
            'name' => 'Ing. María García',
            'email' => 'maria@juez.com',
            'numero_control' => '30001234',
            'password' => Hash::make('password123'),
            'user_type' => 'juez',
        ]);

        // Crear usuario admin
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@eventec.com',
            'numero_control' => '99999999',
            'password' => Hash::make('admin123'),
            'user_type' => 'admin',
        ]);

        // Usuario de prueba con el email que mencionaste
        User::create([
            'name' => 'Luis Cheluis',
            'email' => 'cheluisruiz8@gmail.com',
            'numero_control' => '20211235',
            'password' => Hash::make('password'),
            'user_type' => 'estudiante',
        ]);
    }
}
