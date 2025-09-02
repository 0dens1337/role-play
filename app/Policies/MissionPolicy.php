<?php

namespace App\Policies;

use App\Models\Mission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MissionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Mission $mission): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, int $organizationId = null): bool
    {
        if ($user->hasAdminAccess() || $user->hasSuperAdminAccess()) {
            return true;
        }

        if (!$organizationId) {
            return false;
        }

        return $user->characters()
            ->whereHas('organizations', function ($q) use ($organizationId) {
                $q->where('organization_id', $organizationId)
                    ->whereIn('role', [5, 6]);
            })
            ->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Mission $mission): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Mission $mission): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Mission $mission): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Mission $mission): bool
    {
        return false;
    }

    public function manage(User $user, Mission $mission): bool
    {
        if ($user->hasAdminAccess() || $user->hasSuperAdminAccess()) {
            return true;
        }

        return $user->characters()
            ->whereHas('organizations', function ($q) use ($mission) {
                $q->where('organization_id', $mission->organization_id)
                    ->whereIn('role', [5, 6]);
            })
            ->exists();
    }
}
