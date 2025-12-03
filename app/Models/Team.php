<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'description',
        'event_id',
        'status',
        'leader_id',
        'invitation_code',
        'members_count',
        'logo_url',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array',
        'members_count' => 'integer',
    ];

    // Relaciones
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'team_members', 'team_id', 'user_id')
                    ->withPivot('role', 'joined_at');
    }

    public function invitations()
    {
        return $this->hasMany(TeamInvitation::class);
    }

    public function project()
    {
        return $this->hasOne(Project::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByEvent($query, $eventId)
    {
        return $query->where('event_id', $eventId);
    }

    // Helpers
    public function isLeader($userId)
    {
        return $this->leader_id === $userId;
    }

    public function isMember($userId)
    {
        return $this->members()->where('user_id', $userId)->exists();
    }

    public function canAddMembers()
    {
        return $this->members_count < $this->event->max_team_size;
    }

    public function hasMinimumMembers()
    {
        return $this->members_count >= $this->event->min_team_size;
    }
}
