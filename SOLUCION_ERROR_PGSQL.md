# 🔧 Solución al Error: "could not find driver (Connection: pgsql)"

## ❌ Problema
Laravel no puede conectarse a PostgreSQL porque falta la extensión PHP necesaria.

## ✅ Solución

### OPCIÓN 1: Habilitar extensión PostgreSQL en PHP (RECOMENDADO)

#### Para XAMPP:
1. Ve a la carpeta de PHP: `C:\xampp\php\`
2. Abre el archivo `php.ini` con un editor de texto
3. Busca esta línea (Ctrl + F): `;extension=pdo_pgsql`
4. Elimina el punto y coma (`;`) al inicio:
   ```ini
   extension=pdo_pgsql
   extension=pgsql
   ```
5. Guarda el archivo
6. Reinicia Apache desde XAMPP Control Panel
7. Ejecuta: `php -m | findstr pgsql` para verificar

#### Para Laragon:
1. Menu → PHP → Quick settings
2. Marca: `pdo_pgsql` y `pgsql`
3. Reinicia servicios

### OPCIÓN 2: Usar SQLite temporalmente (MÁS RÁPIDO)

Si solo quieres probar rápido, usa SQLite en lugar de PostgreSQL:

#### Paso 1: Cambiar `.env`
Reemplaza las líneas de base de datos con:

```env
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=lara
# DB_USERNAME=root
# DB_PASSWORD=
```

#### Paso 2: Crear base de datos SQLite
```bash
type nul > database/database.sqlite
```

#### Paso 3: Crear script de migración desde Supabase
Ejecuta este comando en tu proyecto:

```bash
php artisan make:command ImportSupabaseData
```

Voy a crear los archivos necesarios...
