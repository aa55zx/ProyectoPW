<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'title',
        'slug',
        'description',
        'short_description',
        'category',
        'event_type',
        'status',
        'registration_start_date',
        'registration_end_date',
        'event_start_date',
        'event_end_date',
        'min_team_size',
        'max_team_size',
        'max_teams',
        'location',
        'venue',
        'is_online',
        'meeting_url',
        'requirements',
        'prizes',
        'cover_image_url',
        'banner_image_url',
        'gallery_images',
        'organizer_id',
        'organizer_name',
        'contact_email',
        'contact_phone',
        'views_count',
        'registered_teams_count',
        'tags',
        'is_featured',
        'is_published',
    ];

    protected $casts = [
        'registration_start_date' => 'date',
        'registration_end_date' => 'date',
        'event_start_date' => 'date',
        'event_end_date' => 'date',
        'requirements' => 'array',
        'prizes' => 'array',
        'gallery_images' => 'array',
        'tags' => 'array',
        'is_online' => 'boolean',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'views_count' => 'integer',
        'registered_teams_count' => 'integer',
        'min_team_size' => 'integer',
        'max_team_size' => 'integer',
        'max_teams' => 'integer',
    ];

    // Relaciones
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function rubrics()
    {
        return $this->hasMany(Rubric::class);
    }

    public function schedule()
    {
        return $this->hasMany(EventSchedule::class)->orderBy('day')->orderBy('order_index');
    }

    /**
     * Relación con los jueces asignados al evento
     */
    public function judges()
    {
        return $this->belongsToMany(User::class, 'event_judges', 'event_id', 'judge_id')
            ->withPivot('status', 'assigned_at', 'assigned_by', 'notes')
            ->withTimestamps();
    }

    /**
     * Relación con las asignaciones de jueces
     */
    public function judgeAssignments()
    {
        return $this->hasMany(EventJudge::class, 'event_id');
    }

    /**
     * Relación con los asesores asignados al evento
     */
    public function advisors()
    {
        return $this->belongsToMany(User::class, 'event_advisors', 'event_id', 'advisor_id')
            ->withPivot('status', 'assigned_at', 'assigned_by', 'notes')
            ->withTimestamps();
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeFinished($query)
    {
        return $query->where('status', 'finished');
    }

    // Helpers
    public function isRegistrationOpen()
    {
        $now = now();
        $regStart = $this->registration_start_date ? \Carbon\Carbon::parse($this->registration_start_date)->startOfDay() : null;
        $regEnd = $this->registration_end_date ? \Carbon\Carbon::parse($this->registration_end_date)->endOfDay() : null;
        
        if (!$regStart || !$regEnd) {
            return false;
        }
        
        // Solo se puede registrar si es "upcoming" Y está en el período de inscripciones
        return $this->status === 'upcoming' && $now->between($regStart, $regEnd);
    }

    public function canRegister()
    {
        // Alias más claro para saber si se puede inscribir
        return $this->isRegistrationOpen();
    }

    public function isInProgress()
    {
        return $this->status === 'in_progress';
    }

    public function isFinished()
    {
        return $this->status === 'finished';
    }

    public function incrementViews()
    {
        $this->increment('views_count');
    }

    public function getStatusBadgeClass()
    {
        return match($this->status) {
            'upcoming' => 'bg-blue-100 text-blue-700',
            'in_progress' => 'bg-green-100 text-green-700',
            'finished' => 'bg-gray-100 text-gray-700',
            default => 'bg-gray-100 text-gray-700',
        };
    }

    public function getStatusLabel()
    {
        return match($this->status) {
            'upcoming' => 'Proximamente',
            'in_progress' => 'En Curso',
            'finished' => 'Finalizado',
            default => 'Desconocido',
        };
    }
}
