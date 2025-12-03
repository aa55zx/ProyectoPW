@echo off
chcp 65001 > nul
cls

echo ================================================================
echo   EventTecNM - Configuración Rápida
echo ================================================================
echo.

echo [1/5] Creando base de datos SQLite...
cd /d "%~dp0"
type nul > database\database.sqlite
echo ✅ Base de datos creada
echo.

echo [2/5] Limpiando caché...
php artisan config:clear 2>nul
php artisan cache:clear 2>nul
php artisan route:clear 2>nul
php artisan view:clear 2>nul
echo ✅ Caché limpiado
echo.

echo [3/5] Ejecutando migraciones...
php artisan migrate --force
if errorlevel 1 (
    echo.
    echo ❌ Error al ejecutar migraciones
    echo.
    pause
    exit /b 1
)
echo ✅ Tablas creadas
echo.

echo [4/5] Creando usuarios de prueba...
php artisan tinker --execute="$admin = new App\Models\User(); $admin->name = 'Administrador'; $admin->email = 'admin@tecnm.mx'; $admin->numero_control = 'ADMIN001'; $admin->password = bcrypt('admin123'); $admin->user_type = 'admin'; $admin->email_verified_at = now(); $admin->save(); $docente = new App\Models\User(); $docente->name = 'Profesor Juan Pérez'; $docente->email = 'docente@tecnm.mx'; $docente->numero_control = 'DOC001'; $docente->password = bcrypt('docente123'); $docente->user_type = 'docente'; $docente->email_verified_at = now(); $docente->save(); $estudiante = new App\Models\User(); $estudiante->name = 'María García'; $estudiante->email = 'estudiante@tecnm.mx'; $estudiante->numero_control = '20240001'; $estudiante->password = bcrypt('estudiante123'); $estudiante->user_type = 'estudiante'; $estudiante->email_verified_at = now(); $estudiante->save(); echo '✅ Usuarios creados';"

echo.
echo [5/5] ¡Configuración completada!
echo ================================================================
echo.
echo Usuarios de prueba creados:
echo   👨‍💼 Admin:      ADMIN001 / admin123
echo   👨‍🏫 Docente:    DOC001 / docente123
echo   👨‍🎓 Estudiante: 20240001 / estudiante123
echo.
echo ================================================================
echo   Para iniciar el servidor ejecuta:
echo   php artisan serve
echo ================================================================
echo.
pause
