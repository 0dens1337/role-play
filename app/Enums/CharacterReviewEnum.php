<?php

namespace App\Enums;

enum CharacterReviewEnum: int
{
    case ON_REVIEW = 1;
    case APPROVED = 2;
    case REJECTED = 3;

    public function name(): string
    {
        return match ($this) {
            self::ON_REVIEW => 'On Review',
            self::APPROVED => 'Approved',
            self::REJECTED => 'Rejected',
        };
    }
}
