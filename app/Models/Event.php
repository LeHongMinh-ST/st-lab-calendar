<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\DateTimeStamp;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'day' => DateTimeStamp::class,
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

        static::creating(function ($query): void {
            $query->user_id = auth()->id();
            $query->status = Status::Active;
        });
    }
}
