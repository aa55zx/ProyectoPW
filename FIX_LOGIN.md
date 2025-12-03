# Solución al Problema de Login

## 🔴 Problema
No puedes iniciar sesión porque no hay usuarios en la base de datos.

## ✅ Solución

### Opción 1: Ejecutar el archivo .bat (MÁS FÁCIL)

1. Busca y ejecuta el archivo `reset_db_with_users.bat` en la raíz del proyecto
2. Esto creará automáticamente 5 usuarios de prueba
3. Espera a que termine y cierra la ventana

### Opción 2: Comandos manuales

Abre tu terminal en la carpeta del proyecto y ejecuta:

```bash
php artisan migrate:fresh
php artisan db:seed
```

## 👥 Usuarios Creados

Después de ejecutar los seeders, tendrás estos usuarios disponibles:

### ESTUDIANTE 1
- **Email:** `carlos@estudiante.com`
- **Password:** `password123`

### ESTUDIANTE 2 (Tu email)
- **Email:** `cheluisruiz8@gmail.com`
- **Password:** `password`

### MAESTRO
- **Email:** `juan@maestro.com`
- **Password:** `password123`

### JUEZ
- **Email:** `maria@juez.com`
- **Password:** `password123`

### ADMIN
- **Email:** `admin@eventec.com`
- **Password:** `admin123`

## 🎯 Cómo usar el Modo Demo en el Login

1. Ve a la página de login: `http://127.0.0.1:8000/login`
2. Haz clic en el tab "Modo Demo"
3. Selecciona el tipo de usuario que quieres probar
4. Haz clic en el botón correspondiente
5. ¡Listo! Ingresarás automáticamente

## 🔧 Si aún tienes problemas

1. **Verifica la conexión a la base de datos:**
   - Revisa tu archivo `.env`
   - Asegúrate de que la base de datos existe
   - Para SQLite: El archivo debe estar en `database/database.sqlite`

2. **Limpia la caché:**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan route:clear
   ```

3. **Verifica que las migraciones se ejecutaron:**
   ```bash
   php artisan migrate:status
   ```

4. **Si usas SQLite y no existe el archivo:**
   ```bash
   # Windows
   type nul > database/database.sqlite
   
   # Linux/Mac
   touch database/database.sqlite
   ```

## 📝 Nota Importante

La nueva página de login incluye:
- ✅ Tab "Iniciar sesión" - Login tradicional
- ✅ Tab "Modo Demo" - Botones de acceso rápido para cada rol
- ✅ Mensajes de error mejorados
- ✅ Diseño actualizado y moderno

## 🚀 Próximos Pasos

Una vez que inicies sesión correctamente:
- **Estudiante** → Dashboard con eventos, equipos, proyectos
- **Maestro** → Panel de asesor
- **Juez** → Panel de evaluación
- **Admin** → Panel de administración

---

**¿Problemas?** Asegúrate de ejecutar `reset_db_with_users.bat` primero.
