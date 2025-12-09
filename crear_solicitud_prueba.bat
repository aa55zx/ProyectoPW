@echo off
echo ============================================
echo   CREAR SOLICITUDES DE PRUEBA PARA ASESOR
echo ============================================
echo.

php artisan tinker --execute="
// Obtener tu asesor
$asesor = App\Models\User::where('email', 'ana.garcia@asesor.com')->first();

if (!$asesor) {
    echo 'Asesor no encontrado. Probando con otro email...\n';
    $asesor = App\Models\User::where('user_type', 'maestro')->first();
}

if ($asesor) {
    echo 'Asesor encontrado: ' . $asesor->name . ' (' . $asesor->email . ')\n';
    echo 'ID del asesor: ' . $asesor->id . '\n\n';
    
    // Buscar un proyecto sin asesor
    $proyecto = App\Models\Project::whereNull('advisor_id')->with('team')->first();
    
    if ($proyecto) {
        echo 'Proyecto encontrado: ' . $proyecto->title . '\n';
        echo 'Equipo: ' . $proyecto->team->name . '\n\n';
        
        // Buscar un estudiante del equipo
        $estudiante = DB::table('team_members')
            ->where('team_id', $proyecto->team_id)
            ->first();
        
        if ($estudiante) {
            // Crear solicitud
            DB::table('advisor_requests')->insert([
                'id' => Illuminate\Support\Str::uuid(),
                'team_id' => $proyecto->team_id,
                'project_id' => $proyecto->id,
                'advisor_id' => $asesor->id,
                'requested_by' => $estudiante->user_id,
                'status' => 'pending',
                'message' => 'Por favor sea nuestro asesor',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            echo '✅ Solicitud creada exitosamente!\n';
            echo 'El estudiante ' . $estudiante->user_id . ' solicita al asesor ' . $asesor->name . '\n';
        } else {
            echo '❌ No se encontró estudiante en el equipo\n';
        }
    } else {
        echo '❌ No hay proyectos sin asesor\n';
    }
} else {
    echo '❌ No se encontró ningún asesor\n';
}
"

echo.
echo ============================================
echo    COMPLETADO
echo ============================================
echo.
echo Ahora recarga tu navegador y ve a /asesor/equipos
echo.
pause
