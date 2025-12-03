<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventSchedule extends Model
{
    protected $table = 'event_schedule';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'event_id',
        'day',
        'title',
        'description',
        'start_time',
        'end_time',
        'location',
        'order_index',
    ];

    protected $casts = [
        'day' => 'integer',
        'order_index' => 'integer',
        'created_at' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
