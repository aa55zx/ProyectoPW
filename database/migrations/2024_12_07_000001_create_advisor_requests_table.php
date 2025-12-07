<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('advisor_requests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('team_id'); // Equipo que solicita
            $table->string('project_id'); // Proyecto asociado
            $table->string('advisor_id'); // Asesor solicitado
            $table->string('requested_by'); // Usuario que hizo la solicitud (líder)
            $table->string('status', 20)->default('pending'); // pending, accepted, rejected
            $table->text('message')->nullable(); // Mensaje del equipo
            $table->text('response_message')->nullable(); // Respuesta del asesor
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();
            
            // Índices
            $table->index('team_id');
            $table->index('project_id');
            $table->index('advisor_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('advisor_requests');
    }
};
