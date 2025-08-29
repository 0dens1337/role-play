<?php

namespace App\Enums;

enum MissionStatusEnum: int
{
    case ACTIVE = 1;
    case ON_REVIEW = 2;
    case REJECTED = 3;
    case CANCELLED = 4;
    case ACCEPTED = 5;
}
