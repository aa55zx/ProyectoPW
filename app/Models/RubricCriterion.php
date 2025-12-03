<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RubricCriterion extends Model
{
    protected $table = 'rubric_criteria';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'rubric_id',
        'name',
        'description',
        'max_points',
        'weight',
        'order_index',
    ];

    protected $casts = [
        'max_points' => 'integer',
        'weight' => 'decimal:2',
        'order_index' => 'integer',
        'created_at' => 'datetime',
    ];

    public function rubric()
    {
        return $this->belongsTo(Rubric::class);
    }

    public function scores()
    {
        return $this->hasMany(EvaluationScore::class, 'criterion_id');
    }
}
