<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

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

    public function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image ? Storage::disk('public')->url($this->image) : null,
        );
    }

    public function resizedAvatarUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->image
                ? Storage::disk('public')->url(str_replace('original.', 'resized.', $this->image))
                : null,
        );
    }
}
