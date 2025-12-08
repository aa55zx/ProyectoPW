@echo off
cls
echo ========================================
echo   PRUEBA DIRECTA - LOGIN ASESOR
echo ========================================
echo.
echo Vamos a probar el login paso a paso
echo.
pause
echo.
echo ========================================
echo   PASO 1: Limpiando sesiones
echo ========================================
echo.
php artisan optimize:clear
del /f /q "storage\framework\sessions\*" 2>nul
echo ✓ Sesiones eliminadas
echo.
echo ========================================
echo   PASO 2: Verificando usuario asesor
echo ========================================
echo.
php artisan tinker --execute="$user = \App\Models\User::where('email', 'asesor1@asesor.com')->first(); if($user) { echo 'Usuario encontrado: ' . $user->name . ' - Rol: ' . $user->role; } else { echo 'ERROR: Usuario NO existe'; }"
echo.
echo ========================================
echo   PASO 3: Verificando ruta de asesor
echo ========================================
echo.
php artisan route:list | findstr "asesor.dashboard"
echo.
echo Si NO aparece nada arriba:
echo   → PROBLEMA: La ruta /asesor/dashboard NO existe
echo   → SOLUCION: Necesitas agregarla en web.php
echo.
echo Si SI aparece:
echo   → Las rutas estan bien configuradas
echo.
echo ========================================
echo   PASO 4: Probando autenticacion
echo ========================================
echo.
echo Intenta iniciar sesion con:
echo   Email:    asesor1@asesor.com
echo   Password: password123
echo.
echo Que sucede? (anota el resultado):
echo.
echo A) Login exitoso pero redirige a /estudiante
echo    → Problema: Middleware o AuthController
echo.
echo B) Login falla - credenciales incorrectas
echo    → Problema: Usuario no existe o password mal
echo.
echo C) Login exitoso pero error 404
echo    → Problema: Ruta /asesor/dashboard no existe
echo.
echo D) Login exitoso pero error 403
echo    → Problema: Middleware bloqueando acceso
echo.
echo E) Login exitoso y funciona!
echo    → Todo bien ✓
echo.
echo ========================================
echo   CUAL ES TU CASO? (A, B, C, D o E)
echo ========================================
echo.
echo Comparte conmigo cual letra es tu caso
echo para darte la solucion exacta
echo.
echo ========================================
pause
