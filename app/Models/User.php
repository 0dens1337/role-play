<?php

namespace App\Models;

use App\Enums\RoleUserEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'login',
        'email',
        'password',
        'role',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function characters(): HasMany
    {
        return $this->hasMany(Character::class);
    }

    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class);
    }

    public function scopeFilter($query, array $filters): void
    {
        $query->when(isset($filters['login']), function ($query) use ($filters) {
            $query->where('login', 'like', '%' . $filters['login'] . '%');
        });
    }

    public function hasAdminAccess(): bool
    {
        return in_array($this->role, [RoleUserEnum::ADMIN->value, RoleUserEnum::SUPER_ADMIN->value]);
    }

    public function hasSuperAdminAccess(): bool
    {
        return $this->role == RoleUserEnum::SUPER_ADMIN->value;
    }

    public function hasCharacter()
    {
        return $this->characters()->exists();
    }

    public function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->avatar ? Storage::disk('public')->url($this->avatar) : null,
        );
    }

    public function resizedAvatarUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->avatar
                ? Storage::disk('public')->url(str_replace('original.', 'resized.', $this->avatar))
                : null,
        );
    }

    public function roleName(): Attribute
    {
        return Attribute::make(
            get: fn () => RoleUserEnum::tryFrom($this->role)->name() ?? 'Unknown',
        );
    }
}
