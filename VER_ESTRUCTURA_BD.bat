@echo off
cls
echo ========================================
echo   VERIFICANDO ESTRUCTURA DE BD
echo ========================================
echo.
echo Consultando usuarios...
echo.
php artisan tinker --execute="echo 'ESTUDIANTE:' . PHP_EOL; $user = \App\Models\User::where('email', 'camila24@estudiante.com')->first(); if($user) { echo 'Campos disponibles: ' . PHP_EOL; print_r($user->getAttributes()); } else { echo 'No encontrado'; } echo PHP_EOL . PHP_EOL;"

php artisan tinker --execute="echo 'MAESTRO:' . PHP_EOL; $user = \App\Models\User::where('email', 'juan@maestro.com')->first(); if($user) { echo 'Campos disponibles: ' . PHP_EOL; print_r($user->getAttributes()); } else { echo 'No encontrado'; } echo PHP_EOL . PHP_EOL;"

php artisan tinker --execute="echo 'JUEZ:' . PHP_EOL; $user = \App\Models\User::where('email', 'maria@juez.com')->first(); if($user) { echo 'Campos disponibles: ' . PHP_EOL; print_r($user->getAttributes()); } else { echo 'No encontrado'; } echo PHP_EOL . PHP_EOL;"

php artisan tinker --execute="echo 'ADMIN:' . PHP_EOL; $user = \App\Models\User::where('email', 'admin@eventec.com')->first(); if($user) { echo 'Campos disponibles: ' . PHP_EOL; print_r($user->getAttributes()); } else { echo 'No encontrado'; } echo PHP_EOL . PHP_EOL;"

echo.
echo ========================================
echo   ANALISIS:
echo ========================================
echo.
echo Busca en la salida anterior cual campo tiene el rol:
echo   - role
echo   - rol  
echo   - user_type
echo   - type
echo.
echo Y que valor tiene cada usuario:
echo   - estudiante
echo   - maestro o asesor
echo   - juez
echo   - admin o administrador
echo.
echo ========================================
pause
