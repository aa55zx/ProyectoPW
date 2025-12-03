@echo off
cls
echo ========================================
echo   LIMPIANDO MIGRACIONES DUPLICADAS
echo ========================================
echo.

cd /d "%~dp0"

echo Eliminando migraciones duplicadas...

REM Eliminar nuestras migraciones personalizadas que duplican las de Laravel
if exist "database\migrations\2024_12_01_000000_create_sessions_table.php" (
    del /F /Q "database\migrations\2024_12_01_000000_create_sessions_table.php"
    echo ✓ Eliminada: create_sessions_table.php
)

if exist "database\migrations\2024_12_01_000002_create_cache_table.php" (
    del /F /Q "database\migrations\2024_12_01_000002_create_cache_table.php"
    echo ✓ Eliminada: create_cache_table.php (duplicada)
)

if exist "database\migrations\2024_12_01_000003_create_jobs_table.php" (
    del /F /Q "database\migrations\2024_12_01_000003_create_jobs_table.php"
    echo ✓ Eliminada: create_jobs_table.php (duplicada)
)

if exist "database\migrations\2025_11_26_053919_add_numero_control_to_users_table.php" (
    del /F /Q "database\migrations\2025_11_26_053919_add_numero_control_to_users_table.php"
    echo ✓ Eliminada: add_numero_control_to_users_table.php (no necesaria)
)

echo.
echo ✓ Migraciones limpiadas
echo.
echo Migraciones que quedaron:
echo   - 0001_01_01_000000_create_users_table.php (Laravel)
echo   - 0001_01_01_000001_create_cache_table.php (Laravel)
echo   - 0001_01_01_000002_create_jobs_table.php (Laravel)
echo   - 2024_12_01_000001_create_eventtec_tables.php (EventTec)
echo.
echo ========================================
echo   LISTO PARA INICIAR
echo ========================================
echo.
echo Ahora ejecuta: INICIAR.bat
echo.
pause
