<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'quote',
        'header',
        'header_image',
        'header_text',
    ];

    public function topics()
    {
        return $this->morphMany(Topic::class, 'belongable');
    }
}
