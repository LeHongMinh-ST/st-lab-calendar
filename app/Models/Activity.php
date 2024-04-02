<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ActivityType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'type',
        'start_time',
        'end_time',
        'user_id',
        'owner',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'type' => ActivityType::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): HasOne
    {
        return $this->HasOne(Event::class);
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($query): void {
            $query->user_id = auth()->id();
        });
    }
}
