<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    protected $fillable = [
        'name',
        'description',
        'logo',
        'open',
        'parent_id',
    ];

    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class)
            ->withPivot(['role', 'exp', 'created_at', 'updated_at']);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Organization::class,'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Organization::class,'parent_id');
    }

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when(isset($filters['name']), function ($query) use ($filters) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        });
    }
}
