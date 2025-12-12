<?php

/*
 * SCRIPT PARA RESETEAR CONTRASEÑAS DESPUÉS DE MIGRACIÓN
 * 
 * Este script resetea las contraseñas de todos los usuarios
 * a una contraseña temporal después de migrar de SQLite a MySQL
 * 
 * USO: php reset_passwords.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "==========================================\n";
echo "  RESET DE CONTRASEÑAS POST-MIGRACIÓN\n";
echo "==========================================\n\n";

// Contraseña temporal que se asignará a todos
$passwordTemporal = 'EventTec2024!';

echo "⚠️  Esta acción cambiará las contraseñas de TODOS los usuarios\n";
echo "📝 Nueva contraseña temporal: {$passwordTemporal}\n\n";
echo "¿Deseas continuar? (escribe 'si' para confirmar): ";

$handle = fopen("php://stdin", "r");
$line = fgets($handle);
fclose($handle);

if(trim(strtolower($line)) != 'si') {
    echo "\n❌ Operación cancelada.\n";
    exit;
}

echo "\n🔄 Procesando usuarios...\n\n";

$usuarios = User::all();
$contador = 0;

foreach ($usuarios as $user) {
    $passwordAnterior = $user->password;
    $user->password = Hash::make($passwordTemporal);
    $user->save();
    
    $contador++;
    echo "✅ [{$contador}] {$user->name} ({$user->email}) - Contraseña actualizada\n";
}

echo "\n==========================================\n";
echo "✨ PROCESO COMPLETADO\n";
echo "==========================================\n";
echo "Total de usuarios actualizados: {$contador}\n";
echo "Contraseña temporal: {$passwordTemporal}\n";
echo "\n⚠️  IMPORTANTE: Los usuarios deberán cambiar su contraseña al iniciar sesión\n";
echo "==========================================\n";
