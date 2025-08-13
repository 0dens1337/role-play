<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'required_exp',
        'title',
        'level'
    ];

    public function characters(): HasMany
    {
        return $this->hasMany(Character::class);
    }
}
