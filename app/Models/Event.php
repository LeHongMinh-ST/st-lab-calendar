<?php

namespace App\Models;

use App\Casts\DateTimeStamp;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'team_id',
        'user_id',
        'activity_id',
        'status',
        'day',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'start_day' => DateTimeStamp::class,
        'end_day' => DateTimeStamp::class,
        'day' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    public function calendar(): BelongsTo
    {
        return $this->belongsTo(Calendar::class);
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
