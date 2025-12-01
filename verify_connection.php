#!/usr/bin/env php
<?php

/**
 * Script de Verificación de Conexión a Supabase
 * EventTecNM
 * 
 * Ejecuta: php verify_connection.php
 */

echo "\n";
echo "==============================================\n";
echo "  EventTecNM - Verificación de Conexión\n";
echo "==============================================\n\n";

// Cargar autoload de Laravel
require __DIR__.'/vendor/autoload.php';

// Cargar la aplicación Laravel
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

try {
    echo "📡 Probando conexión a la base de datos...\n";
    
    // Intenta conectar
    DB::connection()->getPdo();
    echo "✅ Conexión exitosa!\n\n";
    
    // Obtener información de la conexión
    $config = DB::connection()->getConfig();
    echo "📊 Información de conexión:\n";
    echo "   - Driver: " . $config['driver'] . "\n";
    echo "   - Host: " . $config['host'] . "\n";
    echo "   - Puerto: " . $config['port'] . "\n";
    echo "   - Base de datos: " . $config['database'] . "\n";
    echo "   - Usuario: " . $config['username'] . "\n\n";
    
    // Verificar tablas
    echo "📋 Verificando tablas...\n";
    $tables = [
        'users',
        'password_reset_tokens',
        'sessions',
        'cache',
        'cache_locks',
        'jobs',
        'job_batches',
        'failed_jobs'
    ];
    
    $existingTables = [];
    $missingTables = [];
    
    foreach ($tables as $table) {
        if (Schema::hasTable($table)) {
            $existingTables[] = $table;
            echo "   ✅ Tabla '$table' existe\n";
        } else {
            $missingTables[] = $table;
            echo "   ❌ Tabla '$table' NO existe\n";
        }
    }
    
    echo "\n";
    
    // Verificar usuarios de prueba
    echo "👥 Verificando usuarios de prueba...\n";
    $users = DB::table('users')->get(['numero_control', 'name', 'email', 'user_type']);
    
    if ($users->count() > 0) {
        echo "   Total de usuarios: " . $users->count() . "\n\n";
        foreach ($users as $user) {
            echo "   - Número de Control: {$user->numero_control}\n";
            echo "     Nombre: {$user->name}\n";
            echo "     Email: {$user->email}\n";
            echo "     Tipo: {$user->user_type}\n\n";
        }
    } else {
        echo "   ⚠️  No hay usuarios en la base de datos\n";
        echo "   Ejecuta el script SQL completo en Supabase\n\n";
    }
    
    // Resumen
    echo "==============================================\n";
    echo "  RESUMEN\n";
    echo "==============================================\n";
    echo "✅ Conexión: OK\n";
    echo "📊 Tablas existentes: " . count($existingTables) . "/" . count($tables) . "\n";
    
    if (count($missingTables) > 0) {
        echo "⚠️  Tablas faltantes: " . implode(', ', $missingTables) . "\n";
        echo "\n💡 Ejecuta el script SQL en Supabase para crear las tablas faltantes\n";
    }
    
    echo "\n🎉 ¡La aplicación está lista para usarse!\n\n";
    
} catch (Exception $e) {
    echo "❌ Error de conexión:\n";
    echo "   " . $e->getMessage() . "\n\n";
    
    echo "🔧 Verifica lo siguiente:\n";
    echo "   1. Las credenciales en el archivo .env\n";
    echo "   2. Que el servidor de Supabase esté accesible\n";
    echo "   3. Que las extensiones de PostgreSQL estén instaladas\n";
    echo "   4. Que DB_SSLMODE=require esté configurado\n\n";
    
    exit(1);
}
