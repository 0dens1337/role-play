<?php

namespace App\Enums;

enum CharacterReviewEnum: int
{
    case ON_REVIEW = 1;
    case APPROVED = 2;
    case REJECTED = 3;
}
