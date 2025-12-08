@echo off
echo APLICANDO AsesorController modificado...
echo.
echo Descarga este archivo y copialo manualmente:
echo https://pastebin.com/raw/XXXXX
echo.
echo O ejecuta estos comandos:
echo.
echo OPCION 1: Agregar manualmente los metodos
echo Abre: app\Http\Controllers\AsesorController.php
echo.
echo En el metodo equipos (linea 108):
echo Agrega ANTES del return:
echo.
type << 'EOF'
        $solicitudesPendientes = DB::table('advisor_requests')
            ->where('advisor_id', $user->id)
            ->where('status', 'pending')
            ->join('projects', 'advisor_requests.project_id', '=', 'projects.id')
            ->join('teams', 'advisor_requests.team_id', '=', 'teams.id')
            ->join('users', 'advisor_requests.requested_by', '=', 'users.id')
            ->select(
                'advisor_requests.*',
                'projects.title as project_title',
                'teams.name as team_name',
                'users.name as requester_name'
            )
            ->orderBy('advisor_requests.created_at', 'desc')
            ->get();
EOF
echo.
echo Y cambia el return por:
echo return view('asesor.equipos', compact('equipos', 'proyectos', 'solicitudesPendientes'));
echo.
pause
echo.
echo En el metodo proyectos (linea 201):
echo Agrega lo mismo ANTES del return
echo Y cambia el compact agregando 'solicitudesPendientes'
echo.
pause
