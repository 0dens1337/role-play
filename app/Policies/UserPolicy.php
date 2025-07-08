<?php

namespace App\Policies;

use App\Enums\RoleUserEnum;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function create(User $user): Response
    {
        return $user->hasAdminAccess() || $user->hasSuperAdminAccess()
            ? Response::allow()
            : Response::deny('Access denied');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): Response
    {
        return ($user->hasAdminAccess() || $user->hasSuperAdminAccess())
        && $model->role != RoleUserEnum::SUPER_ADMIN->value
            ? Response::allow()
            : Response::deny('Access denied');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): Response
    {
        return $user->hasSuperAdminAccess()
            ? Response::allow()
            : Response::deny('Access denied');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
