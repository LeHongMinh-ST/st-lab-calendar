<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Role;
use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'phone_number',
        'email',
        'password',
        'thumbnail',
        'status',
        'role',
        'is_admin',
        'full_name',
        'thumbnail',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
        'role' => Role::class,
        'status' => UserStatus::class,
    ];

    public function setPasswordAttribute($password): void
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->where('full_name', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%')
                ->orWhere('phone_number', 'like', '%'.$search.'%');
        }

        return $query;
    }

    public function scopeFilterRole($query, $role)
    {
        if (boolval(trim($role))) {
            $query->where('role', $role);
        }

        return $query;
    }

    public function scopeFilterStatus($query, $status)
    {
        if (boolval(trim($status))) {
            $query->where('status', $status);
        }

        return $query;
    }

    public function getStatusTextAttribute(): string
    {
        if ($this->status == null) {
            return '<span class="badge bg-success bg-opacity-20 text-success">Hoạt động</span>';
        }

        return match ($this->status) {
            UserStatus::Active => '<span class="badge bg-success bg-opacity-20 text-success">Hoạt động</span>',
            UserStatus::Inactive => '<span class="badge bg-danger bg-opacity-20 text-danger">Tạm khóa</span>',
        };
    }

    public function getRoleTextAttribute()
    {
        if ($this->is_admin) {
            return ' <span class="badge bg-info bg-opacity-10 text-info">Siêu quản trị</span>';
        }

        return '<span class="badge bg-info bg-opacity-10 text-info">'.$this->role?->name().'</span>';
    }

    public function getIsAdminTextAttribute()
    {
        if ($this->is_admin) {
            return ' <span class="badge bg-success bg-opacity-20 text-success"><i class="ph-check"></i></span>';
        }

        return '';
    }

    public function team(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }
}
