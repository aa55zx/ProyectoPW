@echo off
cls
color 0A
echo.
echo  ██████╗ ██╗   ██╗██╗ █████╗     ██████╗  █████╗ ███████╗ ██████╗ ███████╗
echo ██╔════╝ ██║   ██║██║██╔══██╗    ██╔══██╗██╔══██╗██╔════╝██╔═══██╗██╔════╝
echo ██║  ███╗██║   ██║██║███████║    ██████╔╝███████║███████╗██║   ██║███████╗
echo ██║   ██║██║   ██║██║██╔══██║    ██╔═══╝ ██╔══██║╚════██║██║   ██║╚════██║
echo ╚██████╔╝╚██████╔╝██║██║  ██║    ██║     ██║  ██║███████║╚██████╔╝███████║
echo  ╚═════╝  ╚═════╝ ╚═╝╚═╝  ╚═╝    ╚═╝     ╚═╝  ╚═╝╚══════╝ ╚═════╝ ╚══════╝
echo.
echo ================================================================================
echo   ERROR 419 - PAGE EXPIRED - SOLUCION PASO A PASO
echo ================================================================================
echo.
color 0F
echo PASO 1: CORRIGE LA CONFIGURACION DE SESIONES
echo ─────────────────────────────────────────────
echo.
echo   Ejecuta: CORREGIR_SESIONES.bat
echo.
echo   Esto cambiara SESSION_DRIVER de 'database' a 'file'
echo.
pause
echo.
echo ================================================================================
echo.
echo PASO 2: LIMPIA EL NAVEGADOR (MUY IMPORTANTE)
echo ──────────────────────────────────────────────
echo.
echo   A) CIERRA todas las ventanas del navegador
echo.
echo   B) ABRE el navegador de nuevo
echo.
echo   C) Presiona: Ctrl + Shift + Delete
echo.
echo   D) Se abrira una ventana "Borrar datos de navegacion"
echo.
echo   E) Configura asi:
echo      ┌─────────────────────────────────────────┐
echo      │ Intervalo de tiempo: [Desde siempre ▼] │
echo      │                                         │
echo      │ [✓] Cookies y otros datos de sitios    │
echo      │ [✓] Imagenes y archivos en cache       │
echo      │                                         │
echo      │         [Borrar datos]                  │
echo      └─────────────────────────────────────────┘
echo.
echo   F) Click en "Borrar datos"
echo.
echo   G) ESPERA a que termine (puede tomar unos segundos)
echo.
pause
echo.
echo ================================================================================
echo.
echo PASO 3: CIERRA COMPLETAMENTE EL NAVEGADOR
echo ──────────────────────────────────────────
echo.
echo   - Cierra TODAS las pestañas
echo   - Cierra TODAS las ventanas
echo   - Verifica en la barra de tareas que no quede abierto
echo.
pause
echo.
echo ================================================================================
echo.
echo PASO 4: REINICIA EL SERVIDOR
echo ─────────────────────────────
echo.
echo   A) Si el servidor esta corriendo:
echo      - Ve a esa ventana
echo      - Presiona: Ctrl + C
echo      - Confirma con: Y
echo.
echo   B) Ejecuta: REINICIAR_SERVIDOR.bat
echo.
echo   C) Espera a ver: "Server started on http://127.0.0.1:8000"
echo.
pause
echo.
echo ================================================================================
echo.
echo PASO 5: ABRE MODO INCOGNITO
echo ────────────────────────────
echo.
echo   Chrome: Ctrl + Shift + N
echo   Edge:   Ctrl + Shift + N
echo.
echo   Se abrira una ventana oscura/morada
echo.
pause
echo.
echo ================================================================================
echo.
echo PASO 6: INICIA SESION
echo ──────────────────────
echo.
echo   A) Ve a: http://127.0.0.1:8000/login
echo.
echo   B) Ingresa credenciales de ASESOR:
echo.
echo      ┌──────────────────────────────────────┐
echo      │ Correo electronico:                  │
echo      │ asesor1@asesor.com                   │
echo      │                                      │
echo      │ Contraseña:                          │
echo      │ password123                          │
echo      │                                      │
echo      │          [Iniciar sesion]            │
echo      └──────────────────────────────────────┘
echo.
echo   C) Click en "Iniciar sesion"
echo.
echo   D) DEBE redirigir a: /asesor/dashboard
echo.
pause
echo.
echo ================================================================================
echo.
echo SI AUN FALLA:
echo ─────────────
echo.
echo 1. Verifica que el servidor este corriendo
echo    (Debe decir: Server started on http://127.0.0.1:8000)
echo.
echo 2. Prueba con OTRO navegador:
echo    - Si usas Chrome, prueba Edge
echo    - Si usas Edge, prueba Firefox
echo    - En modo incognito
echo.
echo 3. Verifica el .env:
echo    SESSION_DRIVER debe ser: file
echo.
echo 4. Comparte conmigo:
echo    - Captura de pantalla del error
echo    - Que navegador estas usando
echo    - Si limpiaste cookies y cache
echo.
echo ================================================================================
echo.
echo RESUMEN RAPIDO:
echo ───────────────
echo   1. CORREGIR_SESIONES.bat
echo   2. Ctrl+Shift+Delete → Borrar todo
echo   3. Cerrar navegador
echo   4. REINICIAR_SERVIDOR.bat  
echo   5. Modo incognito (Ctrl+Shift+N)
echo   6. http://127.0.0.1:8000/login
echo   7. asesor1@asesor.com / password123
echo.
echo ================================================================================
pause
