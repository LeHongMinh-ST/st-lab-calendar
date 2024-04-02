<?php

namespace App\Models;

use App\Common\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'color',
        'thumbnail',
        'description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function getThumbnailAttribute($value): string
    {
        return $value ? asset('storage/'.$value) : asset(Constants::TEAM_IMAGE_DEFAULT);
    }
}
