<?php

namespace App\Models;

use App\Casts\DateTimeStamp;
use App\Enums\CalendarLoop;
use App\Enums\Status;
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
        'end_time',
        'start_day',
        'end_day',
        'week_loop',
        'loop',
        'team_id',
        'user_id',
    ];

    protected $casts = [
        'date_of_week' => 'array',
        'loop' => CalendarLoop::class,
        'status' => Status::class,
        'start_day' => DateTimeStamp::class,
        'end_day' => DateTimeStamp::class,
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

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($query) {
            $query->user_id = auth()->id();
            $query->status = Status::Active;
        });
    }
}
