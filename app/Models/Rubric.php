<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{
    protected $table = 'rubrics';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'event_id',
        'name',
        'description',
        'total_points',
        'is_active',
    ];

    protected $casts = [
        'total_points' => 'integer',
        'is_active' => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function criteria()
    {
        return $this->hasMany(RubricCriterion::class)->orderBy('order_index');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}
