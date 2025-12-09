@echo off
echo ============================================
echo   CREAR TABLA DE COMENTARIOS
echo ============================================
echo.

php artisan tinker --execute="
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

// Verificar si la tabla existe
if (!Schema::hasTable('project_comments')) {
    Schema::create('project_comments', function (Blueprint \$table) {
        \$table->uuid('id')->primary();
        \$table->uuid('project_id');
        \$table->uuid('user_id');
        \$table->text('comment');
        \$table->timestamp('created_at');
        
        \$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        \$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
    echo 'Tabla project_comments creada exitosamente';
} else {
    echo 'La tabla project_comments ya existe';
}
"

echo.
echo ============================================
echo    TABLA CREADA
echo ============================================
pause
