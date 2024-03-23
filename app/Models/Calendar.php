<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Calendar extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'date_of_week',
        'start_time',
        'ent_time',
        'start_day',
        'end_day',
        'week_loop',
        'loop',
        'team_id',
        'user_id',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'ent_time' => 'datetime',
        'start_day' => 'datetime',
        'end_day' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
