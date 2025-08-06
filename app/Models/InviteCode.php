<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InviteCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'num_of_symbols',
        'max_uses',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function isValid(): bool
    {
        if ($this->expires_at->isPast()) {
            return false;
        }

        return $this->uses > $this->max_uses;
    }

    public function markUsed(): void
    {
        $this->increment('uses');
    }
}
