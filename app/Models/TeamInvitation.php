<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamInvitation extends Model
{
    protected $table = 'team_invitations';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'team_id',
        'invited_user_id',
        'invited_by_id',
        'status',
        'message',
        'expires_at',
        'responded_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'responded_at' => 'datetime',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function invitedUser()
    {
        return $this->belongsTo(User::class, 'invited_user_id');
    }

    public function invitedBy()
    {
        return $this->belongsTo(User::class, 'invited_by_id');
    }
}
