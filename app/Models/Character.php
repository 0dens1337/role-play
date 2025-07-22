<?php

namespace App\Models;

use App\Enums\CharacterReviewEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Character extends Model
{
    protected $fillable = [
        'name',
        'description',
        'occupation',
        'age',
        'race',
        'gender',
        'biography',
        'personality',
        'appearance',
        'contracts',
        'artifacts',
        'magic_skills',
        'non_magic_skills',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function characterMeta(): HasOne
    {
        return $this->hasOne(CharacterMeta::class);
    }

    public function scopeFilter($query, array $filters): void
    {
        $query->when(isset($filters['name']), function ($query) use ($filters) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        });
    }

    public function diffs(): HasMany
    {
        return $this->hasMany(Diff::class);
    }
}
