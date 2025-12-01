# 🚀 EventTecNM - Configuración con Supabase

## ⚡ Pasos Rápidos

### 1. Crear Proyecto en Supabase
1. Ve a [https://supabase.com](https://supabase.com)
2. Crea un nuevo proyecto llamado "EventTecNM"
3. **IMPORTANTE**: Guarda la contraseña de la base de datos

### 2. Ejecutar SQL
1. En Supabase, ve a **SQL Editor**
2. Copia y pega el contenido del archivo que descargaste: `supabase_setup.sql`
3. Haz clic en **Run**
4. Verifica en **Table Editor** que se crearon las tablas

### 3. Obtener Credenciales
1. En Supabase: **Settings → Database**
2. Busca **Connection string**
3. Copia estos datos:
   - **Host**: `db.xxxxx.supabase.co`
   - **Password**: La que guardaste en el paso 1

### 4. Actualizar `.env`
Abre el archivo `.env` en la raíz del proyecto y actualiza:

```env
DB_CONNECTION=pgsql
DB_HOST=db.xxxxx.supabase.co          # ← Reemplaza con tu host
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=tu_password_aqui          # ← Reemplaza con tu password
DB_SSLMODE=require
```

### 5. Instalar Extensiones PHP (si no las tienes)

#### Windows (XAMPP/WAMP)
1. Abre `php.ini`
2. Descomenta estas líneas:
   ```ini
   extension=pdo_pgsql
   extension=pgsql
   ```
3. Reinicia Apache

#### Linux (Ubuntu/Debian)
```bash
sudo apt-get install php-pgsql php-pdo-pgsql
sudo systemctl restart apache2
```

### 6. Verificar Conexión
```bash
# Limpia caché
php artisan config:clear
php artisan cache:clear

# Verifica la conexión
php verify_connection.php
```

### 7. Iniciar Servidor
```bash
php artisan serve
```

Abre: http://localhost:8000

## 👥 Usuarios de Prueba

| Tipo | Número Control | Password |
|------|---------------|----------|
| Admin | ADMIN001 | admin123 |
| Docente | DOC001 | docente123 |
| Estudiante | 20240001 | estudiante123 |

## 🔧 Solución de Problemas

### Error: "could not find driver"
```bash
# Verifica si pgsql está instalado
php -m | grep pgsql
```
Si no aparece, instala las extensiones como se indica arriba.

### Error: "SQLSTATE[08006] SSL required"
Asegúrate de tener en `.env`:
```env
DB_SSLMODE=require
```

### Error: "Connection refused"
Verifica que las credenciales en `.env` sean correctas.

## 📚 Archivos Importantes

- **supabase_setup.sql** - Script SQL para crear todas las tablas
- **verify_connection.php** - Script para verificar la conexión
- **.env** - Configuración de la base de datos (YA MODIFICADO)
- **config/database.php** - Configuración de Laravel (YA MODIFICADO)

## 🎯 ¡Listo!

Una vez que todo funcione, puedes:
1. ✅ Hacer login con los usuarios de prueba
2. ✅ Crear más tablas según necesites
3. ✅ Desarrollar tu aplicación

---

**¿Necesitas ayuda?** Consulta los archivos de documentación que descargaste.
