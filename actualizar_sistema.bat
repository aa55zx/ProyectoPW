@echo off
chcp 65001 > nul
cls

echo ================================================================
echo   EvenTec - Actualización del Sistema
echo ================================================================
echo.
echo Este script actualizará el sistema con:
echo   - Nuevo diseño de Login
echo   - Nuevo diseño de Registro (solo estudiantes)
echo   - Login con correo electrónico
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
echo ✅ Eliminada

echo.
echo [2/5] Creando nueva base de datos...
type nul > database\database.sqlite
echo ✅ Creada

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
echo [5/5] Creando usuarios de prueba...

REM Admin
php artisan tinker --execute="$admin = new App\Models\User(); $admin->name = 'Administrador'; $admin->email = 'admin@tecnm.mx'; $admin->numero_control = 'ADMIN001'; $admin->password = bcrypt('admin123'); $admin->user_type = 'admin'; $admin->email_verified_at = now(); $admin->save();" >nul 2>&1
echo ✅ Admin creado

REM Maestro
php artisan tinker --execute="$maestro = new App\Models\User(); $maestro->name = 'Prof. Juan Pérez'; $maestro->email = 'maestro@tecnm.mx'; $maestro->numero_control = 'MAESTRO001'; $maestro->password = bcrypt('maestro123'); $maestro->user_type = 'maestro'; $maestro->email_verified_at = now(); $maestro->save();" >nul 2>&1
echo ✅ Maestro creado

REM Juez
php artisan tinker --execute="$juez = new App\Models\User(); $juez->name = 'Dra. María López'; $juez->email = 'juez@tecnm.mx'; $juez->numero_control = 'JUEZ001'; $juez->password = bcrypt('juez123'); $juez->user_type = 'juez'; $juez->email_verified_at = now(); $juez->save();" >nul 2>&1
echo ✅ Juez creado

REM Estudiante
php artisan tinker --execute="$estudiante = new App\Models\User(); $estudiante->name = 'Carlos Ramírez'; $estudiante->email = 'estudiante@tecnm.mx'; $estudiante->numero_control = '20240001'; $estudiante->password = bcrypt('estudiante123'); $estudiante->user_type = 'estudiante'; $estudiante->email_verified_at = now(); $estudiante->save();" >nul 2>&1
echo ✅ Estudiante creado

echo.
echo ================================================================
echo   ¡SISTEMA ACTUALIZADO!
echo ================================================================
echo.
echo 🎨 Nuevo diseño implementado
echo 📧 Login ahora usa correo electrónico
echo 👨‍🎓 Registro solo para estudiantes
echo.
echo Usuarios de prueba:
echo.
echo   ADMIN:
echo      Email: admin@tecnm.mx
echo      Password: admin123
echo.
echo   MAESTRO:
echo      Email: maestro@tecnm.mx
echo      Password: maestro123
echo.
echo   JUEZ:
echo      Email: juez@tecnm.mx
echo      Password: juez123
echo.
echo   ESTUDIANTE:
echo      Email: estudiante@tecnm.mx
echo      Password: estudiante123
echo.
echo ================================================================
echo   Para iniciar: php artisan serve
echo   Luego abre: http://localhost:8000
echo ================================================================
echo.
pause
