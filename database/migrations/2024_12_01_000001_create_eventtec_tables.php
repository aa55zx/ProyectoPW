<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabla events
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->string('category', 100);
            $table->string('event_type', 50);
            $table->string('status', 20)->default('draft');
            $table->date('registration_start_date');
            $table->date('registration_end_date');
            $table->date('event_start_date');
            $table->date('event_end_date');
            $table->integer('min_team_size')->default(1);
            $table->integer('max_team_size')->default(5);
            $table->integer('max_teams')->nullable();
            $table->string('location')->nullable();
            $table->text('venue')->nullable();
            $table->boolean('is_online')->default(false);
            $table->text('meeting_url')->nullable();
            $table->json('requirements')->nullable();
            $table->json('prizes')->nullable();
            $table->text('cover_image_url')->nullable();
            $table->text('banner_image_url')->nullable();
            $table->json('gallery_images')->nullable();
            $table->string('organizer_id')->nullable();
            $table->string('organizer_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone', 20)->nullable();
            $table->integer('views_count')->default(0);
            $table->integer('registered_teams_count')->default(0);
            $table->json('tags')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabla teams
        Schema::create('teams', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('event_id');
            $table->string('status', 20)->default('active');
            $table->string('leader_id')->nullable();
            $table->string('invitation_code', 10)->unique()->nullable();
            $table->integer('members_count')->default(1);
            $table->text('logo_url')->nullable();
            $table->json('tags')->nullable();
            $table->timestamps();
        });

        // Tabla team_members
        Schema::create('team_members', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('team_id');
            $table->string('user_id');
            $table->string('role', 20)->default('member');
            $table->timestamp('joined_at')->useCurrent();
            $table->unique(['team_id', 'user_id']);
        });

        // Tabla team_invitations
        Schema::create('team_invitations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('team_id');
            $table->string('invited_user_id');
            $table->string('invited_by_id')->nullable();
            $table->string('status', 20)->default('pending');
            $table->text('message')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->unique(['team_id', 'invited_user_id']);
        });

        // Tabla projects
        Schema::create('projects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('team_id');
            $table->string('event_id');
            $table->string('title');
            $table->text('description');
            $table->string('status', 20)->default('draft');
            $table->text('repository_url')->nullable();
            $table->text('demo_url')->nullable();
            $table->text('presentation_url')->nullable();
            $table->text('video_url')->nullable();
            $table->json('documents')->nullable();
            $table->decimal('final_score', 5, 2)->nullable();
            $table->integer('rank')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('evaluated_at')->nullable();
            $table->timestamps();
        });

        // Tabla notifications
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('user_id');
            $table->string('type', 50);
            $table->string('title');
            $table->text('message');
            $table->json('data')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        // Tabla rubrics
        Schema::create('rubrics', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('event_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('total_points')->default(100);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tabla rubric_criteria
        Schema::create('rubric_criteria', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('rubric_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('max_points');
            $table->decimal('weight', 5, 2)->default(1.0);
            $table->integer('order_index')->default(0);
            $table->timestamp('created_at')->useCurrent();
        });

        // Tabla evaluations
        Schema::create('evaluations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('project_id');
            $table->string('judge_id')->nullable();
            $table->string('rubric_id')->nullable();
            $table->decimal('total_score', 5, 2)->nullable();
            $table->text('comments')->nullable();
            $table->string('status', 20)->default('pending');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        // Tabla evaluation_scores
        Schema::create('evaluation_scores', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('evaluation_id');
            $table->string('criterion_id');
            $table->decimal('score', 5, 2);
            $table->text('comments')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        // Tabla event_schedule
        Schema::create('event_schedule', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('event_id');
            $table->integer('day');
            $table->string('title');
            $table->text('description')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('location')->nullable();
            $table->integer('order_index')->default(0);
            $table->timestamp('created_at')->useCurrent();
        });

        // Tabla achievements
        Schema::create('achievements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('icon', 50)->nullable();
            $table->string('category', 50)->nullable();
            $table->integer('points')->default(0);
            $table->timestamp('created_at')->useCurrent();
        });

        // Tabla user_achievements
        Schema::create('user_achievements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('user_id');
            $table->string('achievement_id');
            $table->timestamp('earned_at')->useCurrent();
        });

        // Tabla activity_log
        Schema::create('activity_log', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('user_id')->nullable();
            $table->string('action', 100);
            $table->string('entity_type', 50)->nullable();
            $table->string('entity_id')->nullable();
            $table->text('description')->nullable();
            $table->json('metadata')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_log');
        Schema::dropIfExists('user_achievements');
        Schema::dropIfExists('achievements');
        Schema::dropIfExists('event_schedule');
        Schema::dropIfExists('evaluation_scores');
        Schema::dropIfExists('evaluations');
        Schema::dropIfExists('rubric_criteria');
        Schema::dropIfExists('rubrics');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('team_invitations');
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('teams');
        Schema::dropIfExists('events');
    }
};
