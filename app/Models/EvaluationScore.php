<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationScore extends Model
{
    protected $table = 'evaluation_scores';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'evaluation_id',
        'criterion_id',
        'score',
        'comments',
    ];

    protected $casts = [
        'score' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    public function criterion()
    {
        return $this->belongsTo(RubricCriterion::class, 'criterion_id');
    }
}
