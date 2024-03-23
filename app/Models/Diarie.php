<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Diarie extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time',
        'end_time',
        'report_status',
        'report',
        'room_status',
        'event_id',
        'user_id',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'ent_time' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
