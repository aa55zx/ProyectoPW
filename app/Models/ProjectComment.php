<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ProjectComment extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'project_comments';
    
    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'user_id',
        'comment',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Relación con el proyecto
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Relación con el usuario (quien comentó)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
