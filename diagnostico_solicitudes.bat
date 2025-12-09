@echo off
echo ============================================
echo   DIAGNOSTICO COMPLETO - SOLICITUDES
echo ============================================
echo.

php artisan tinker --execute="
echo '=== PASO 1: VERIFICAR ASESOR ===\n';
$gabriela = App\Models\User::where('name', 'LIKE', '%%Gabriela%%')->first();

if (!$gabriela) {
    echo 'Gabriela no encontrada. Buscando todos los asesores...\n';
    $asesores = App\Models\User::where('user_type', 'maestro')->get();
    echo 'Asesores encontrados: ' . $asesores->count() . '\n';
    foreach($asesores as $a) {
        echo '  - ' . $a->name . ' (' . $a->email . ') ID: ' . $a->id . '\n';
    }
    $gabriela = $asesores->first();
}

if ($gabriela) {
    echo '\nAsesor seleccionado: ' . $gabriela->name . '\n';
    echo 'ID: ' . $gabriela->id . '\n';
    echo 'Email: ' . $gabriela->email . '\n\n';
    
    echo '=== PASO 2: VERIFICAR SOLICITUDES EXISTENTES ===\n';
    $solicitudes = DB::table('advisor_requests')
        ->where('advisor_id', $gabriela->id)
        ->get();
    echo 'Solicitudes para ' . $gabriela->name . ': ' . $solicitudes->count() . '\n\n';
    
    if ($solicitudes->count() > 0) {
        foreach($solicitudes as $sol) {
            echo 'Solicitud ID: ' . $sol->id . '\n';
            echo '  Estado: ' . $sol->status . '\n';
            echo '  Solicitado por: ' . $sol->requested_by . '\n';
            echo '  Proyecto ID: ' . $sol->project_id . '\n---\n';
        }
    } else {
        echo 'NO HAY SOLICITUDES. Creando una de prueba...\n\n';
        
        echo '=== PASO 3: BUSCAR PROYECTO SIN ASESOR ===\n';
        $proyecto = App\Models\Project::whereNull('advisor_id')
            ->with(['team', 'event'])
            ->first();
        
        if ($proyecto) {
            echo 'Proyecto encontrado: ' . $proyecto->title . '\n';
            echo 'Equipo: ' . $proyecto->team->name . '\n';
            echo 'Evento: ' . $proyecto->event->title . '\n\n';
            
            echo '=== PASO 4: BUSCAR ESTUDIANTE DEL EQUIPO ===\n';
            $miembro = DB::table('team_members')
                ->where('team_id', $proyecto->team_id)
                ->first();
            
            if ($miembro) {
                $estudiante = App\Models\User::find($miembro->user_id);
                echo 'Estudiante encontrado: ' . $estudiante->name . '\n';
                echo 'ID estudiante: ' . $estudiante->id . '\n\n';
                
                echo '=== PASO 5: CREAR SOLICITUD ===\n';
                $solicitudId = Illuminate\Support\Str::uuid();
                
                DB::table('advisor_requests')->insert([
                    'id' => $solicitudId,
                    'team_id' => $proyecto->team_id,
                    'project_id' => $proyecto->id,
                    'advisor_id' => $gabriela->id,
                    'requested_by' => $estudiante->id,
                    'status' => 'pending',
                    'message' => 'Por favor sea nuestro asesor para el proyecto ' . $proyecto->title,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                
                echo '✅ SOLICITUD CREADA EXITOSAMENTE!\n';
                echo 'ID Solicitud: ' . $solicitudId . '\n';
                echo 'Estudiante ' . $estudiante->name . ' solicita a ' . $gabriela->name . '\n';
                
                echo '\n=== VERIFICACION FINAL ===\n';
                $verificar = DB::table('advisor_requests')
                    ->where('id', $solicitudId)
                    ->first();
                
                if ($verificar) {
                    echo '✅ Solicitud verificada en BD\n';
                    echo 'Estado: ' . $verificar->status . '\n';
                } else {
                    echo '❌ ERROR: Solicitud no se guardó\n';
                }
            } else {
                echo '❌ No se encontró miembro del equipo\n';
            }
        } else {
            echo '❌ No hay proyectos sin asesor\n';
            echo 'Intentando con cualquier proyecto...\n';
            
            $proyecto = App\Models\Project::with(['team', 'event'])->first();
            if ($proyecto) {
                echo 'Proyecto (con asesor): ' . $proyecto->title . '\n';
                echo 'Advisor actual: ' . $proyecto->advisor_id . '\n';
            }
        }
    }
} else {
    echo '❌ NO SE ENCONTRO NINGUN ASESOR\n';
}
"

echo.
echo ============================================
echo    DIAGNOSTICO COMPLETADO
echo ============================================
echo.
echo Si la solicitud fue creada, recarga: http://127.0.0.1:8000/asesor/equipos
echo.
pause
