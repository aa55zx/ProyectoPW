@echo off
echo Creando backup del controlador...
copy "app\Http\Controllers\Estudiante\ProyectoController.php" "app\Http\Controllers\Estudiante\ProyectoController.php.backup"
echo Backup creado
pause
