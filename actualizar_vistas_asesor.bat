@echo off
echo ============================================
echo    ACTUALIZANDO VISTAS DE ASESOR
echo ============================================
echo.

echo Copiando dashboard actualizado...
copy /Y "%~dp0dashboard.blade.php" "%~dp0resources\views\asesor\dashboard.blade.php"

echo.
echo ============================================
echo    VISTAS ACTUALIZADAS EXITOSAMENTE
echo ============================================
echo.
echo Ahora recarga la pagina en tu navegador:
echo http://127.0.0.1:8000/asesor/dashboard
echo.
pause
