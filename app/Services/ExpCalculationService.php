<?php

namespace App\Services;

class ExpCalculationService
{
    public static function addExp($mission, array $validated): void
    {
        $characterId = $validated['character_id'];
        $expToAdd = $mission->reward;

        $organization = $mission->organization;

        $character = $organization->characters->firstWhere('id', $characterId);

        if (!$character || !$character->pivot) {
            throw new \Exception('Character not found in organization.');
        }

        $newExp = $character->pivot->exp + $expToAdd;

        $newRole = OrganizationRoleService::getNewRoleByExp($newExp, $character);

        $pivotData = [
            'exp' => $newExp,
        ];

        if ($newRole !== null) {
            $pivotData['role'] = $newRole->value;
        }

        $organization->characters()->updateExistingPivot($characterId, $pivotData);
    }


}
