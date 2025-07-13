<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CharacterMeta extends Model
{
    protected $fillable = [
        'character_id',
        'image',
        'likes',
        'dislikes',
        'text_color',
        'background_color',
        'accent_color',
        'short_description',
    ];

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }
}
