@echo off
cls
echo ========================================
echo   PROBLEMA ENCONTRADO!
echo   Campo de rol incorrecto
echo ========================================
echo.
echo El problema esta en el LoginController
echo.
echo Linea 55:
echo   $rol = $user-^>rol ?? $user-^>user_type ?? 'estudiante';
echo.
echo Debe ser:
echo   $rol = $user-^>role ?? $user-^>rol ?? $user-^>user_type ?? 'estudiante';
echo.
echo ========================================
echo   VERIFICANDO ESTRUCTURA DE BD:
echo ========================================
echo.
echo Consultando usuario asesor...
php artisan tinker --execute="$user = \App\Models\User::where('email', 'asesor1@asesor.com')->first(); if($user) { echo 'ID: ' . $user->id . PHP_EOL; echo 'Nombre: ' . $user->name . PHP_EOL; echo 'Email: ' . $user->email . PHP_EOL; echo 'Role: ' . ($user->role ?? 'NO EXISTE') . PHP_EOL; echo 'Rol: ' . ($user->rol ?? 'NO EXISTE') . PHP_EOL; echo 'User_type: ' . ($user->user_type ?? 'NO EXISTE') . PHP_EOL; } else { echo 'Usuario NO encontrado'; }"
echo.
echo ========================================
echo   SOLUCION AUTOMATICA:
echo ========================================
echo.
echo Voy a aplicar el parche...
echo.

REM Crear backup
copy "app\Http\Controllers\Auth\LoginController.php" "app\Http\Controllers\Auth\LoginController.php.backup" >nul

REM Aplicar parche (usando PowerShell)
powershell -Command "(Get-Content 'app\Http\Controllers\Auth\LoginController.php') -replace '\$rol = \$user-\>rol \?\? \$user-\>user_type', '$rol = $user->role ?? $user->rol ?? $user->user_type' | Set-Content 'app\Http\Controllers\Auth\LoginController.php'"

echo.
echo ✓ Parche aplicado
echo ✓ Backup guardado en LoginController.php.backup
echo.
echo ========================================
echo   LIMPIANDO CACHE:
echo ========================================
echo.
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
echo.
echo ✓ Cache limpiado
echo.
echo ========================================
echo   AHORA PRUEBA ESTO:
echo ========================================
echo.
echo 1. Cierra TODAS las ventanas del navegador
echo 2. Abre modo incognito (Ctrl + Shift + N)
echo 3. Ve a: http://127.0.0.1:8000/login
echo 4. Inicia sesion con:
echo.
echo    ASESOR:
echo    Email:    asesor1@asesor.com  
echo    Password: password123
echo.
echo 5. Debe redirigir a: /asesor/dashboard
echo.
echo ========================================
echo   SI AUN NO FUNCIONA:
echo ========================================
echo.
echo Ejecuta este SQL para ver el valor real:
echo.
echo SELECT id, name, email, role, rol, user_type 
echo FROM users 
echo WHERE email = 'asesor1@asesor.com';
echo.
echo Y comparte el resultado conmigo
echo.
echo ========================================
pause
