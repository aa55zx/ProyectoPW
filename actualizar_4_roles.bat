@echo off
chcp 65001 > nul
cls

echo ================================================================
echo   EventTecNM - Actualización a 4 Roles
echo ================================================================
echo.
echo Este script actualizará tu base de datos con los 4 roles:
echo   - Estudiante
echo   - Maestro (Asesor)
echo   - Juez
echo   - Admin
echo.
echo ADVERTENCIA: Esto eliminará todos los datos actuales.
echo.
set /p CONFIRM="¿Deseas continuar? (S/N): "
if /i not "%CONFIRM%"=="S" (
    echo.
    echo Operación cancelada.
    pause
    exit /b 0
)

echo.
echo [1/5] Eliminando base de datos anterior...
del database\database.sqlite 2>nul
echo ✅ Base de datos eliminada

echo.
echo [2/5] Creando nueva base de datos...
type nul > database\database.sqlite
echo ✅ Base de datos creada

echo.
echo [3/5] Limpiando caché...
php artisan config:clear >nul 2>&1
php artisan cache:clear >nul 2>&1
php artisan route:clear >nul 2>&1
php artisan view:clear >nul 2>&1
echo ✅ Caché limpiado

echo.
echo [4/5] Ejecutando migraciones...
php artisan migrate --force
if errorlevel 1 (
    echo.
    echo ❌ Error al ejecutar migraciones
    pause
    exit /b 1
)
echo ✅ Tablas creadas

echo.
echo [5/5] Creando usuarios de prueba (4 roles)...

php artisan tinker --execute="$admin = new App\Models\User(); $admin->name = 'Administrador del Sistema'; $admin->email = 'admin@tecnm.mx'; $admin->numero_control = 'ADMIN001'; $admin->password = bcrypt('admin123'); $admin->user_type = 'admin'; $admin->email_verified_at = now(); $admin->save(); echo '✅ Admin creado\n';"

php artisan tinker --execute="$maestro = new App\Models\User(); $maestro->name = 'Prof. Juan Pérez García'; $maestro->email = 'maestro@tecnm.mx'; $maestro->numero_control = 'MAESTRO001'; $maestro->password = bcrypt('maestro123'); $maestro->user_type = 'maestro'; $maestro->email_verified_at = now(); $maestro->save(); echo '✅ Maestro creado\n';"

php artisan tinker --execute="$juez = new App\Models\User(); $juez->name = 'Dr. María López Rodríguez'; $juez->email = 'juez@tecnm.mx'; $juez->numero_control = 'JUEZ001'; $juez->password = bcrypt('juez123'); $juez->user_type = 'juez'; $juez->email_verified_at = now(); $juez->save(); echo '✅ Juez creado\n';"

php artisan tinker --execute="$estudiante = new App\Models\User(); $estudiante->name = 'Carlos Ramírez Sánchez'; $estudiante->email = 'estudiante@tecnm.mx'; $estudiante->numero_control = '20240001'; $estudiante->password = bcrypt('estudiante123'); $estudiante->user_type = 'estudiante'; $estudiante->email_verified_at = now(); $estudiante->save(); echo '✅ Estudiante creado\n';"

echo.
echo ================================================================
echo   ¡ACTUALIZACIÓN COMPLETADA!
echo ================================================================
echo.
echo Usuarios creados:
echo.
echo   👨‍💼 ADMIN:
echo      Usuario: ADMIN001
echo      Password: admin123
echo.
echo   👨‍🏫 MAESTRO (Asesor):
echo      Usuario: MAESTRO001
echo      Password: maestro123
echo.
echo   👨‍⚖️ JUEZ:
echo      Usuario: JUEZ001
echo      Password: juez123
echo.
echo   👨‍🎓 ESTUDIANTE:
echo      Usuario: 20240001
echo      Password: estudiante123
echo.
echo ================================================================
echo   Para iniciar el servidor:
echo   php artisan serve
echo ================================================================
echo.
pause
