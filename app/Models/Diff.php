<?php

namespace App\Models;

use App\Observers\DiffObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([DiffObserver::class])]
class Diff extends Model
{
    protected $fillable = [
        'character_id',
        'column',
        'old_value',
        'new_value',
        'status',
    ];

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }

    public function scopeForReview($query, $diff)
    {
        return $query
            ->where('character_id', $diff['character_id'])
            ->where('column', $diff['column'])
            ->where('new_value', $diff['new_value'])
            ->where('status', $diff['status']);
    }
}
