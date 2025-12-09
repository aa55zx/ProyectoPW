@echo off
echo ============================================
echo   VERIFICAR SOLICITUDES DE ASESORIA
echo ============================================
echo.

php artisan tinker --execute="
echo '\n=== VERIFICANDO TABLA advisor_requests ===\n';
$solicitudes = DB::table('advisor_requests')->get();
echo 'Total solicitudes en BD: ' . $solicitudes->count() . '\n\n';

if ($solicitudes->count() > 0) {
    echo '=== DETALLES DE SOLICITUDES ===\n';
    foreach ($solicitudes as $sol) {
        echo 'ID: ' . $sol->id . '\n';
        echo 'Asesor ID: ' . $sol->advisor_id . '\n';
        echo 'Proyecto ID: ' . $sol->project_id . '\n';
        echo 'Estado: ' . $sol->status . '\n';
        echo 'Solicitado por: ' . $sol->requested_by . '\n';
        echo '---\n';
    }
} else {
    echo 'NO hay solicitudes en la base de datos\n';
}

echo '\n=== VERIFICANDO ASESOR ===\n';
$asesor = App\Models\User::where('email', 'ana.garcia@asesor.com')->first();
if ($asesor) {
    echo 'Asesor encontrado: ' . $asesor->name . '\n';
    echo 'ID del asesor: ' . $asesor->id . '\n';
    
    echo '\n=== SOLICITUDES PARA ESTE ASESOR ===\n';
    $solsAsesor = DB::table('advisor_requests')
        ->where('advisor_id', $asesor->id)
        ->get();
    echo 'Solicitudes para ana.garcia: ' . $solsAsesor->count() . '\n';
    
    if ($solsAsesor->count() > 0) {
        foreach ($solsAsesor as $s) {
            echo '  - Estado: ' . $s->status . ', Proyecto: ' . $s->project_id . '\n';
        }
    }
} else {
    echo 'Asesor NO encontrado\n';
}
"

echo.
echo ============================================
echo    VERIFICACION COMPLETADA
echo ============================================
echo.
pause
