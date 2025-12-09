@echo off
cls
color 0A
echo ================================================
echo   SOLUCION AUTOMATICA - PANEL DE JUEZ
echo   (VERSION CORREGIDA)
echo ================================================
echo.
echo Este script solucionara automaticamente:
echo  1. Crear datos de prueba si no existen
echo  2. Actualizar evento a in_progress
echo  3. Asignar juez al evento
echo  4. Resetear evaluaciones
echo  5. Verificar que todo este correcto
echo.
echo NOTA: Se ha corregido el error de documentation_url
echo.
pause

cls
echo ================================================
echo   PASO 1/5: CREANDO DATOS DE PRUEBA
echo ================================================
echo.
echo Creando jueces, estudiantes, eventos y proyectos...
echo.

php artisan db:seed --class=JudgeEvaluationSeeder

if %errorlevel% neq 0 (
    echo.
    echo ❌ ERROR al crear datos de prueba
    echo.
    echo Posibles soluciones:
    echo 1. Verifica que el seeder este corregido
    echo 2. Ejecuta: php artisan migrate:fresh
    echo 3. Luego vuelve a ejecutar este script
    echo.
    pause
    exit /b 1
)

echo.
echo ✅ Datos de prueba creados correctamente
pause

cls
echo ================================================
echo   PASO 2/5: ACTUALIZANDO EVENTO
echo ================================================
echo.

php artisan tinker --execute="
\$evento = \App\Models\Event::where('slug', 'hackathon-evaluaciones-2025')->first();
if (\$evento) {
    \$evento->update(['status' => 'in_progress']);
    echo '✅ Evento actualizado a in_progress\n';
    echo '   Titulo: ' . \$evento->title . '\n';
    echo '   Status: ' . \$evento->status . '\n';
} else {
    echo '❌ Evento no encontrado\n';
}
"

echo.
pause

cls
echo ================================================
echo   PASO 3/5: ASIGNANDO JUEZ AL EVENTO
echo ================================================
echo.

php artisan tinker --execute="
\$juez = \App\Models\User::where('email', 'maria@juez.com')->first();
\$evento = \App\Models\Event::where('slug', 'hackathon-evaluaciones-2025')->first();

if (\$juez && \$evento) {
    \$exists = \App\Models\EventJudge::where('event_id', \$evento->id)
        ->where('judge_id', \$juez->id)
        ->first();
    
    if (\$exists) {
        \$exists->update(['status' => 'active']);
        echo '✅ Asignación actualizada a activa\n';
    } else {
        \App\Models\EventJudge::create([
            'id' => \Illuminate\Support\Str::uuid(),
            'event_id' => \$evento->id,
            'judge_id' => \$juez->id,
            'status' => 'active',
            'assigned_at' => now(),
            'notes' => 'Asignado automáticamente',
        ]);
        echo '✅ Juez asignado correctamente\n';
    }
    echo '   Juez: ' . \$juez->name . '\n';
    echo '   Evento: ' . \$evento->title . '\n';
} else {
    echo '❌ No se encontro el juez o el evento\n';
}
"

echo.
pause

cls
echo ================================================
echo   PASO 4/5: RESETEANDO EVALUACIONES
echo ================================================
echo.

php artisan db:seed --class=ResetEvaluationsSeeder

echo.
pause

cls
echo ================================================
echo   PASO 5/5: VERIFICACION FINAL
echo ================================================
echo.

php artisan tinker --execute="
\$juez = \App\Models\User::where('email', 'maria@juez.com')->first();
\$evento = \App\Models\Event::where('slug', 'hackathon-evaluaciones-2025')->first();
\$submitted = \App\Models\Project::where('status', 'submitted')->count();
\$evaluations = \App\Models\Evaluation::count();

echo '\n========================================\n';
echo 'RESUMEN FINAL\n';
echo '========================================\n\n';

if (\$juez) {
    echo '✅ Juez: ' . \$juez->name . ' (' . \$juez->email . ')\n';
} else {
    echo '❌ Juez no encontrado\n';
}

if (\$evento) {
    echo '✅ Evento: ' . \$evento->title . '\n';
    echo '   Status: ' . \$evento->status . '\n';
} else {
    echo '❌ Evento no encontrado\n';
}

echo '✅ Proyectos pendientes: ' . \$submitted . '\n';
echo '✅ Evaluaciones existentes: ' . \$evaluations . '\n';

if (\$juez && \$evento) {
    \$assigned = \App\Models\EventJudge::where('event_id', \$evento->id)
        ->where('judge_id', \$juez->id)
        ->where('status', 'active')
        ->exists();
    
    if (\$assigned) {
        echo '✅ Juez asignado al evento: SI\n';
    } else {
        echo '❌ Juez asignado al evento: NO\n';
    }
    
    // Verificar proyectos visibles para el juez
    \$visibleProjects = \App\Models\Project::whereHas('event', function(\$query) use (\$juez) {
        \$query->where('status', 'in_progress')
              ->whereHas('judgeAssignments', function(\$q) use (\$juez) {
                  \$q->where('judge_id', \$juez->id)
                    ->where('status', 'active');
              });
    })
    ->whereDoesntHave('evaluations', function(\$query) use (\$juez) {
        \$query->where('judge_id', \$juez->id)
              ->where('status', 'completed');
    })
    ->where('status', 'submitted')
    ->count();
    
    echo '✅ Proyectos visibles para el juez: ' . \$visibleProjects . '\n';
}

echo '\n========================================\n';

if (\$juez && \$evento && \$submitted > 0) {
    echo '\n🎉 TODO LISTO PARA EVALUAR\n';
    echo '\nPasos siguientes:\n';
    echo '1. Abre tu navegador\n';
    echo '2. Ve a: http://localhost:8000/login\n';
    echo '3. Login con:\n';
    echo '   Email: maria@juez.com\n';
    echo '   Password: password123\n';
    echo '4. Veras ' . \$submitted . ' proyecto(s) pendiente(s)\n';
} else {
    echo '\n⚠️  Aun hay problemas\n';
    echo 'Revisa los mensajes de error arriba\n';
}

echo '\n========================================\n';
"

echo.
echo ================================================
echo   PROCESO COMPLETADO
echo ================================================
echo.
echo Ahora puedes iniciar sesion en el sistema.
echo.
pause
