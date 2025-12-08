@echo off
cls
echo ========================================
echo   CONSULTA RAPIDA - USUARIOS EN BD
echo ========================================
echo.
echo Consultando usuarios de tu captura...
echo.

php artisan tinker --execute="$users = [ 'camila24@estudiante.com', 'javier25@estudiante.com', 'juan@maestro.com', 'roberto@maestro.com', 'gabriela@maestro.com', 'maria@juez.com', 'fernando@juez.com', 'patricia@juez.com', 'admin@eventec.com' ]; foreach($users as $email) { $user = \App\Models\User::where('email', $email)->first(); if($user) { echo str_pad($email, 30) . ' | user_type: ' . str_pad($user->user_type ?? 'NULL', 15) . ' | activo: ' . ($user->is_active ? 'SI' : 'NO') . PHP_EOL; } else { echo str_pad($email, 30) . ' | NO EXISTE EN BD' . PHP_EOL; } }"

echo.
echo ========================================
echo   ANALISIS:
echo ========================================
echo.
echo La columna "user_type" debe tener:
echo   - estudiante (para @estudiante.com)
echo   - maestro    (para @maestro.com)
echo   - juez       (para @juez.com)
echo   - admin      (para @eventec.com)
echo.
echo Si dice "NULL", ese es el problema
echo.
echo ========================================
pause
