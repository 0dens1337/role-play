<?php

namespace App\Services;

use App\Enums\RoleOrganizationEnum;

class OrganizationRoleService
{
    public static function getNewRoleByExp($newExp, $character): ?RoleOrganizationEnum
    {
        $eligibleRoles = array_filter(RoleOrganizationEnum::cases(), function ($role) use ($newExp) {
            return !in_array($role, [RoleOrganizationEnum::RIGHT_HAND, RoleOrganizationEnum::LEADER])
                && $newExp >= $role->requiredExp();
        });

        if (empty($eligibleRoles)) return null;

        $newRole = collect($eligibleRoles)->sortByDesc(fn($role) => $role->value)->first();

        $currentRole = RoleOrganizationEnum::tryFrom($character->role);

        return (!$currentRole || $newRole->value > $currentRole->value) ? $newRole : null;
    }
}
