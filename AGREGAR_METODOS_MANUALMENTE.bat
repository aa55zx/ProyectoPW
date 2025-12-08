@echo off
cls
echo ========================================
echo   SOLUCION RAPIDA - ProyectoController
echo ========================================
echo.
echo NECESITO QUE COPIES MANUALMENTE 2 METODOS
echo.
echo ========================================
echo   PASO 1: ABRE TU ProyectoController
echo ========================================
echo.
echo Ubicacion:
echo   app\Http\Controllers\Estudiante\ProyectoController.php
echo.
pause
echo.
echo ========================================
echo   PASO 2: BUSCA EL METODO assignAdvisor
echo ========================================
echo.
echo Esta en la linea 249 aproximadamente
echo Busca: public function assignAdvisor
echo.
echo BORRA TODO ese metodo (desde linea 249 hasta 284)
echo.
pause
echo.
echo ========================================
echo   PASO 3: PEGA ESTOS 2 METODOS
echo ========================================
echo.
echo En el lugar donde borraste assignAdvisor, pega:
echo.
type << 'ENDCODE'
    /**
     * Solicitar asesor (envía solicitud en lugar de asignar directamente)
     */
    public function solicitarAsesor(Request $request, $id)
    {
        $request->validate([
            'advisor_id' => 'required|exists:users,id',
            'mensaje' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        $proyecto = Project::with('team')->findOrFail($id);

        if (!$proyecto->team->isLeader($user->id)) {
            return response()->json(['success' => false, 'message' => 'Solo el líder puede solicitar asesor'], 403);
        }

        $solicitudExistente = DB::table('advisor_requests')
            ->where('project_id', $proyecto->id)
            ->where('status', 'pending')
            ->exists();

        if ($solicitudExistente) {
            return response()->json(['success' => false, 'message' => 'Ya tienes una solicitud pendiente para este proyecto'], 422);
        }

        if ($proyecto->advisor_id) {
            return response()->json(['success' => false, 'message' => 'Este proyecto ya tiene un asesor asignado'], 422);
        }

        try {
            $requestId = Str::uuid();
            DB::table('advisor_requests')->insert([
                'id' => $requestId,
                'project_id' => $proyecto->id,
                'team_id' => $proyecto->team_id,
                'advisor_id' => $request->advisor_id,
                'requested_by' => $user->id,
                'status' => 'pending',
                'message' => $request->mensaje,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $asesor = User::find($request->advisor_id);
            \App\Models\Notification::create([
                'id' => Str::uuid(),
                'user_id' => $request->advisor_id,
                'type' => 'advisor_request',
                'title' => 'Nueva Solicitud de Asesoría',
                'message' => $user->name . ' solicita que seas asesor de su proyecto "' . $proyecto->title . '"',
                'data' => json_encode([
                    'project_id' => $proyecto->id,
                    'team_id' => $proyecto->team_id,
                    'request_id' => $requestId,
                ]),
                'is_read' => false,
            ]);

            return response()->json([
                'success' => true, 
                'message' => 'Solicitud enviada a ' . $asesor->name . ' exitosamente'
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Cancelar solicitud de asesor
     */
    public function cancelarSolicitudAsesor($id)
    {
        $user = Auth::user();
        $proyecto = Project::with('team')->findOrFail($id);

        if (!$proyecto->team->isLeader($user->id)) {
            return response()->json(['success' => false, 'message' => 'Solo el líder puede cancelar la solicitud'], 403);
        }

        try {
            $deleted = DB::table('advisor_requests')
                ->where('project_id', $proyecto->id)
                ->where('status', 'pending')
                ->delete();

            if ($deleted) {
                return response()->json(['success' => true, 'message' => 'Solicitud cancelada']);
            } else {
                return response()->json(['success' => false, 'message' => 'No hay solicitud pendiente'], 404);
            }

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
ENDCODE
echo.
echo ========================================
pause
echo.
echo ========================================
echo   PASO 4: MODIFICAR METODO show()
echo ========================================
echo.
echo Busca el metodo show() (linea 54)
echo.
echo Busca esta linea (alrededor de linea 95):
echo   return view('estudiante.proyecto-detalle', compact('proyecto', 'asesoresDisponibles', 'esLider'));
echo.
echo REEMPLAZALA con estas lineas:
echo.
type << 'ENDSHOW'
        // Verificar estado de solicitud de asesor
        $solicitudAsesor = DB::table('advisor_requests')
            ->where('project_id', $proyecto->id)
            ->whereIn('status', ['pending', 'accepted', 'rejected'])
            ->orderBy('created_at', 'desc')
            ->first();
        
        return view('estudiante.proyecto-detalle', compact('proyecto', 'asesoresDisponibles', 'esLider', 'solicitudAsesor'));
ENDSHOW
echo.
echo ========================================
pause
echo.
echo ========================================
echo   PASO 5: GUARDAR Y LIMPIAR CACHE
echo ========================================
echo.
echo Guardaste el archivo? Presiona cualquier tecla
pause >nul
echo.
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
echo.
echo ✓ Cache limpiado
echo.
echo ========================================
echo   PASO 6: PROBAR
echo ========================================
echo.
echo Recarga la pagina del proyecto
echo Click en "Solicitar asesor"
echo DEBE funcionar sin error
echo.
echo ========================================
pause
