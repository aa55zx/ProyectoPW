<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AsesoresSeeder extends Seeder
{
    public function run()
    {
        $asesores = [
            ['name' => 'Dr. Miguel Ángel Torres Ramírez', 'email' => 'miguel.torres@tecnm.mx'],
            ['name' => 'Dra. Ana Patricia Hernández López', 'email' => 'ana.hernandez@tecnm.mx'],
            ['name' => 'Mtro. José Luis García Martínez', 'email' => 'jose.garcia@tecnm.mx'],
            ['name' => 'Dra. Laura Elena Rodríguez Sánchez', 'email' => 'laura.rodriguez@tecnm.mx'],
            ['name' => 'Dr. Roberto Carlos Díaz Pérez', 'email' => 'roberto.diaz@tecnm.mx'],
            ['name' => 'Mtra. María Fernanda Morales Cruz', 'email' => 'maria.morales@tecnm.mx'],
            ['name' => 'Dr. Fernando Javier Ruiz Flores', 'email' => 'fernando.ruiz@tecnm.mx'],
            ['name' => 'Dra. Gabriela Alejandra Méndez Castillo', 'email' => 'gabriela.mendez@tecnm.mx'],
            ['name' => 'Mtro. Daniel Arturo Jiménez Ramos', 'email' => 'daniel.jimenez@tecnm.mx'],
            ['name' => 'Dra. Claudia Verónica Castro Delgado', 'email' => 'claudia.castro@tecnm.mx'],
            ['name' => 'Dr. Héctor Manuel Ríos Ortega', 'email' => 'hector.rios@tecnm.mx'],
            ['name' => 'Mtra. Sofía Isabel Vargas Gutiérrez', 'email' => 'sofia.vargas@tecnm.mx'],
            ['name' => 'Dr. Armando Javier Romero Silva', 'email' => 'armando.romero@tecnm.mx'],
            ['name' => 'Dra. Patricia Guadalupe Salazar Méndez', 'email' => 'patricia.salazar@tecnm.mx'],
            ['name' => 'Mtro. Ricardo Enrique Navarro Vega', 'email' => 'ricardo.navarro@tecnm.mx'],
            ['name' => 'Dra. Mónica Beatriz Reyes Aguilar', 'email' => 'monica.reyes@tecnm.mx'],
            ['name' => 'Dr. Sergio Alberto Campos Martínez', 'email' => 'sergio.campos@tecnm.mx'],
            ['name' => 'Mtra. Diana Carolina Vázquez Pérez', 'email' => 'diana.vazquez@tecnm.mx'],
            ['name' => 'Dr. Gustavo Adolfo Mendoza Juárez', 'email' => 'gustavo.mendoza@tecnm.mx'],
            ['name' => 'Dra. Adriana Lizeth Fuentes Rojas', 'email' => 'adriana.fuentes@tecnm.mx'],
        ];

        foreach ($asesores as $asesor) {
            DB::table('users')->insert([
                'id' => Str::uuid(),
                'name' => $asesor['name'],
                'email' => $asesor['email'],
                'password' => Hash::make('password'),
                'user_type' => 'maestro',
                'role' => 'asesor',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✓ 20 asesores agregados exitosamente!');
        $this->command->info('Contraseña para todos: password');
    }
}
