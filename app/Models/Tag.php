<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    protected $fillable = [
        'name',
    ];

    public function npcs(): MorphToMany
    {
        return $this->morphedByMany(Npc::class, 'taggable');
    }

    public function scopeFilter($query, array $filters): void
    {
        $query->when(isset($filters['name']), function ($query) use ($filters) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        });
    }
}
