<?php

namespace App\Models;

use App\Common\Constants;
use App\Enums\Status;
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
        return $value ? asset('storage/' . $value) : asset(Constants::TEAM_IMAGE_DEFAULT);
    }

    public function getStatusAttribute($key): string
    {
        if($this->status == NULL) return '<span class="badge bg-success bg-opacity-20 text-success">Hoạt động</span>';
        return match ($this->status) {
            Status::Active => '<span class="badge bg-success bg-opacity-20 text-success">Hoạt động</span>',
            Status::Inactive => '<span class="badge bg-danger bg-opacity-20 text-info">Tạm khóa</span>',
            Status::Deleted => '<span class="badge bg-danger bg-opacity-20 text-danger">Đã xóa</span>',
        };
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->where(function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($query) use ($search) {
                        $query->where('username', 'like', '%' . $search . '%');
                    });
            });
        }

        return $query;
    }
}
