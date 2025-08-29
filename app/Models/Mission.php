<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Mission extends Model
{
    protected $fillable = [
        'title',
        'description',
        'reward',
        'duration',
        'organization_id',
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class, 'character_missions')
            ->withPivot(['status', 'image_proof', 'description_proof', 'deadline'])
            ->withTimestamps();
    }

    public function scopeFilter($query, array $filters): void
    {
        $query->when(isset($filters['title']), function ($query) use ($filters) {
            $query->where('title', 'like', '%' . $filters['title'] . '%');
        });

        $query->when(isset($filters['by_organization']), function ($query) use ($filters) {
            $query->where('organization_id', $filters['by_organization']);
        });
    }
}
