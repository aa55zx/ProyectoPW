<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $table = 'achievements';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'description',
        'icon',
        'category',
        'points',
    ];

    protected $casts = [
        'points' => 'integer',
        'created_at' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_achievements', 'achievement_id', 'user_id')
                    ->withPivot('earned_at');
    }
}
