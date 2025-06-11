<?php

namespace App\Enums;

enum RoleUserEnum: int
{
    case USER = 1;
    case MODER = 2;
    case ADMIN = 3;
    case SUPER_ADMIN = 4;

}
