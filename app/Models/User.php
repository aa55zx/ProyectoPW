<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'email',
        'numero_control',
        'password',
        'user_type',
        'avatar_url',
        'phone',
        'career',
        'semester',
        'is_active',
        'email_verified_at',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'semester' => 'integer',
        ];
    }

    // Relaciones
    public function leaderOfTeams()
    {
        return $this->hasMany(Team::class, 'leader_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_members', 'user_id', 'team_id')
                    ->withPivot('role', 'joined_at');
    }

    public function advisedProjects()
    {
        return $this->hasMany(Project::class, 'advisor_id');
    }

    /**
     * Relación con proyectos (alias para compatibilidad)
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'advisor_id');
    }

    public function invitations()
    {
        return $this->hasMany(TeamInvitation::class, 'invited_user_id');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'judge_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'user_achievements', 'user_id', 'achievement_id')
                    ->withPivot('earned_at');
    }

    /**
     * Relación con los eventos donde es juez
     */
    public function assignedEvents()
    {
        return $this->belongsToMany(Event::class, 'event_judges', 'judge_id', 'event_id')
            ->withPivot('status', 'assigned_at', 'assigned_by', 'notes')
            ->withTimestamps();
    }

    /**
     * Relación con las asignaciones como juez
     */
    public function judgeAssignments()
    {
        return $this->hasMany(EventJudge::class, 'judge_id');
    }

    // Verificadores de rol
    public function isAdmin()
    {
        return $this->user_type === 'admin';
    }

    public function isMaestro()
    {
        return $this->user_type === 'maestro';
    }

    public function isJuez()
    {
        return $this->user_type === 'juez';
    }

    public function isEstudiante()
    {
        return $this->user_type === 'estudiante';
    }

    public function getRoleName()
    {
        return match($this->user_type) {
            'admin' => 'Admin',
            'maestro' => 'Asesor',
            'juez' => 'Juez',
            'estudiante' => 'Estudiante',
            default => 'Usuario',
        };
    }

    public function getRoleBadgeClass()
    {
        return match($this->user_type) {
            'admin' => 'bg-gray-900 text-white',
            'maestro' => 'bg-gray-700 text-white',
            'juez' => 'bg-gray-600 text-white',
            'estudiante' => 'bg-gray-500 text-white',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('user_type', $type);
    }

    public function updateLastLogin()
    {
        $this->last_login_at = now();
        $this->save();
    }
}
