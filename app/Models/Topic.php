<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Topic extends Model
{
    protected $fillable = [
        'title',
        'description',
        'for_everyone',
        'has_character',
        'user_id',
        'belongable_type',
        'belongable_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function belongable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeVisibleToEveryone($query)
    {
        return $query->where('for_everyone', true);
    }

    public function scopeVisibleToAuthOnly($query)
    {
        return $query->where('has_character', false);
    }

    public function scopeFilter($query, array $filters): void
    {
        $query->when(isset($filters['title']), function ($query) use ($filters) {
            $query->where('title', 'like', '%' . $filters['title'] . '%');
        });
    }

    public function visibilityLevel(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->for_everyone) {
                    return 'For everyone';
                }

                if ($this->has_character) {
                    return 'Only with character(s)';
                }

                return 'Only for Auth users';
            }
        );
    }
}
