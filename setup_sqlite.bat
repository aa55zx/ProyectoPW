@echo off
echo =============================================
echo   EventTecNM - Configuracion SQLite
echo =============================================
echo.

echo [1/4] Limpiando cache...
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo.
echo [2/4] Creando base de datos SQLite...
type nul > database\database.sqlite

echo.
echo [3/4] Ejecutando migraciones...
php artisan migrate --force

echo.
echo [4/4] Creando usuarios de prueba...
php artisan tinker --execute="
$admin = new App\Models\User();
$admin->name = 'Administrador';
$admin->email = 'admin@tecnm.mx';
$admin->numero_control = 'ADMIN001';
$admin->password = bcrypt('admin123');
$admin->user_type = 'admin';
$admin->email_verified_at = now();
$admin->save();

$docente = new App\Models\User();
$docente->name = 'Profesor Juan Perez';
$docente->email = 'docente@tecnm.mx';
$docente->numero_control = 'DOC001';
$docente->password = bcrypt('docente123');
$docente->user_type = 'docente';
$docente->email_verified_at = now();
$docente->save();

$estudiante = new App\Models\User();
$estudiante->name = 'Maria Garcia Lopez';
$estudiante->email = 'estudiante@tecnm.mx';
$estudiante->numero_control = '20240001';
$estudiante->password = bcrypt('estudiante123');
$estudiante->user_type = 'estudiante';
$estudiante->email_verified_at = now();
$estudiante->save();

echo 'Usuarios creados exitosamente!';
"

echo.
echo =============================================
echo   CONFIGURACION COMPLETADA!
echo =============================================
echo.
echo Usuarios de prueba:
echo   Admin:      ADMIN001 / admin123
echo   Docente:    DOC001 / docente123
echo   Estudiante: 20240001 / estudiante123
echo.
echo Inicia el servidor con: php artisan serve
echo.
pause
