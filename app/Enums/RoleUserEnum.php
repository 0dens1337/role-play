<?php

namespace App\Enums;

enum RoleUserEnum: int
{
    case USER = 1;
    case MODER = 2;
    case ADMIN = 3;
    case SUPER_ADMIN = 4;

    public function name(): string
    {
        return match ($this) {
            self::USER => 'User',
            self::MODER => 'Moderator',
            self::ADMIN => 'Admin',
            self::SUPER_ADMIN => 'Super Admin',
        };
    }

}
