<?php

namespace App\Models;

use App\Enums\TopicTypeEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Topic extends Model
{
    protected $fillable = [
        'title',
        'description',
        'section_id',
        'for_everyone',
        'has_character',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function scopeVisibleToEveryone($query)
    {
        return $query->where('for_everyone', true);
    }

    public function scopeVisibleToAuthOnly($query)
    {
        return $query->where('has_character', false);
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
