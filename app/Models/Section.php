<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
    ];

    public function topics(): MorphMany
    {
        return $this->morphMany(Topic::class, 'belongable');
    }
}
