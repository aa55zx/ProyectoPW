@echo off
echo Buscando linea 866...
type "app\Http\Controllers\Estudiante\ProyectoController.php" | find /n /i "public function descargarConstancia"
echo.
echo Las lineas encontradas arriba muestran TODAS las declaraciones del metodo
echo Debe aparecer SOLO UNA VEZ
echo.
pause
