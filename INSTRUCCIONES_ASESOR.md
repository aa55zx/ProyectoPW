# 🚀 INSTRUCCIONES RÁPIDAS - ROL ASESOR

## ✅ Archivos Creados

1. ✅ **AsesorController.php** - Controlador con 7 métodos
2. ✅ **User.php actualizado** - Método `isAsesor()` agregado
3. ✅ **web.php actualizado** - Rutas del asesor agregadas
4. ✅ **AsesorSeeder.php** - Seeder para crear usuarios asesor
5. ✅ **crear_usuarios_asesor.bat** - Script para ejecutar el seeder fácilmente

## 📝 PASO A PASO

### Opción 1: Usar el Script Automático (RECOMENDADO) ⚡

1. Haz doble clic en el archivo: `crear_usuarios_asesor.bat`
2. El script creará los usuarios automáticamente
3. ¡Listo! Ya puedes iniciar sesión

### Opción 2: Manual

1. Abre tu terminal en la carpeta del proyecto
2. Ejecuta:
```bash
php artisan db:seed --class=AsesorSeeder
```

## 🔐 Credenciales de Acceso

### Usuario Asesor 1 (Ana García)
- **Email:** ana.garcia@asesor.com
- **Password:** password123
- **Tipo:** asesor

### Usuario Asesor 2 (Carlos Mendoza)
- **Email:** carlos.mendoza@asesor.com
- **Password:** password123
- **Tipo:** asesor

### Usuario Maestro (María López)
- **Email:** maria.lopez@maestro.com
- **Password:** password123
- **Tipo:** maestro (también funciona como asesor)

## 🌐 Cómo Acceder

1. Inicia tu servidor:
```bash
php artisan serve
```

2. Ve a: http://localhost:8000/login

3. Inicia sesión con cualquiera de los usuarios de arriba

4. Después del login, accede a: http://localhost:8000/asesor/dashboard

## 🎯 URLs Disponibles

Una vez que inicies sesión como asesor, puedes acceder a:

- **Dashboard:** http://localhost:8000/asesor/dashboard
- **Eventos:** http://localhost:8000/asesor/eventos
- **Equipos:** http://localhost:8000/asesor/equipos
- **Proyectos:** http://localhost:8000/asesor/proyectos
- **Rankings:** http://localhost:8000/asesor/rankings
- **Mi Perfil:** http://localhost:8000/asesor/mi-perfil

## 🔧 Troubleshooting

### Si el seeder falla:

1. Verifica que la base de datos esté configurada:
```bash
php artisan migrate
```

2. Si hay error de "tabla no existe", corre las migraciones:
```bash
php artisan migrate:fresh
```

3. Luego ejecuta el seeder de nuevo:
```bash
php artisan db:seed --class=AsesorSeeder
```

### Si no puedes acceder a las rutas:

1. Limpia el cache de rutas:
```bash
php artisan route:clear
php artisan config:clear
php artisan cache:clear
```

2. Verifica que el servidor esté corriendo:
```bash
php artisan serve
```

## 📱 Navegación en el Dashboard

El sidebar del dashboard debería mostrar automáticamente las opciones del asesor:
- Dashboard
- Eventos
- Equipos
- Proyectos
- Rankings
- Mi Perfil

## ⚠️ Importante

- Los usuarios se crean con el tipo `asesor` o `maestro`
- Ambos tipos pueden acceder a las vistas de asesor
- La contraseña por defecto es: `password123`
- Cambia las contraseñas en producción

## 🎨 Características Implementadas

✅ Dashboard con estadísticas y gráficas
✅ Lista de eventos con filtros y búsqueda
✅ Detalle completo de eventos
✅ Gestión de equipos con modal de creación
✅ Gestión de proyectos con estados
✅ Rankings con podio visual
✅ Perfil del asesor con historial

## 📞 ¿Necesitas Ayuda?

Si algo no funciona, verifica:
1. ✅ Servidor corriendo (`php artisan serve`)
2. ✅ Base de datos conectada
3. ✅ Migraciones ejecutadas
4. ✅ Seeder ejecutado
5. ✅ Cache limpio

---

**¡Todo listo para usar el rol de Asesor! 🎉**
