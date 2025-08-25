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

    public function requiredExp(): int
    {
        return match ($this) {
            self::ERRAND_BOY => 50,
            self::EXPERIENCED_MEMBER => 200,
            self::COMMANDER => 400,
            self::ADVISOR => 800,
            self::LEADER, self::RIGHT_HAND => throw new \Exception('Ручное повышение, для этого уровня влияния'),
        };
    }
}
