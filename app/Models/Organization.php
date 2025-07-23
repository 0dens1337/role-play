<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function characters(): HasMany
    {
        return $this->hasMany(Character::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Organization::class,'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Organization::class,'parent_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when(isset($filters['name']), function ($query) use ($filters) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        });
    }
}
