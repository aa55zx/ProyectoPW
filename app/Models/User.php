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
            'admin' => 'Administrador',
            'maestro' => 'Maestro (Asesor)',
            'juez' => 'Juez',
            'estudiante' => 'Estudiante',
            default => 'Usuario',
        };
    }

    public function getRoleBadgeClass()
    {
        return match($this->user_type) {
            'admin' => 'bg-red-100 text-red-800',
            'maestro' => 'bg-green-100 text-green-800',
            'juez' => 'bg-purple-100 text-purple-800',
            'estudiante' => 'bg-blue-100 text-blue-800',
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
