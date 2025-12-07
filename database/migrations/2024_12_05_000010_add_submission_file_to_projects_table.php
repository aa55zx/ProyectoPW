<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Solo agregar las columnas que NO existen
            if (!Schema::hasColumn('projects', 'submission_file_path')) {
                $table->string('submission_file_path')->nullable()->after('demo_url');
            }
            if (!Schema::hasColumn('projects', 'submission_file_name')) {
                $table->string('submission_file_name')->nullable()->after('submission_file_path');
            }
            // submitted_at ya existe, no la agregamos
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['submission_file_path', 'submission_file_name']);
            // No eliminamos submitted_at porque es parte de la tabla original
        });
    }
};
