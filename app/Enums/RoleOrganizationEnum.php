<?php

namespace App\Enums;

enum RoleOrganizationEnum: int
{
    case LEADER = 6;
    case RIGHT_HAND = 5;
    case ADVISOR = 4;
    case COMMANDER = 3;
    case EXPERIENCED_MEMBER = 2;
    case ERRAND_BOY = 1;
}
