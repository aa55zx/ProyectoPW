<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = 'evaluations';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'project_id',
        'judge_id',
        'rubric_id',
        'total_score',
        'comments',
        'status',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'total_score' => 'decimal:2',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function judge()
    {
        return $this->belongsTo(User::class, 'judge_id');
    }

    public function rubric()
    {
        return $this->belongsTo(Rubric::class);
    }

    public function scores()
    {
        return $this->hasMany(EvaluationScore::class);
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }
}
