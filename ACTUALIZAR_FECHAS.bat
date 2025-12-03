@echo off
echo ====================================
echo   ACTUALIZAR FECHAS DE EVENTOS
echo ====================================
echo.
echo Ejecutando actualizacion...
echo.

sqlite3 database\database.sqlite < ACTUALIZAR_EVENTOS.sql

echo.
echo ✓ Fechas actualizadas correctamente
echo.
echo Presiona cualquier tecla para continuar...
pause > nul
