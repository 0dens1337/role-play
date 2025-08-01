<?php

namespace App\Policies;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TopicPolicy
{
    public function index(User $user): bool
    {
        if ($user->hasAdminAccess() || $user->hasSuperAdminAccess()) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Topic $topic)
    {
        if (is_null($user)) {
            return $topic->for_everyone;
        }

        return $topic->for_everyone || $topic->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->hasAdminAccess() || $user->hasSuperAdminAccess()) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Topic $topic): bool
    {
        if ($user->hasAdminAccess() || $user->hasSuperAdminAccess()) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Topic $topic): bool
    {
        if ($user->hasAdminAccess() || $user->hasSuperAdminAccess()) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Topic $topic): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Topic $topic): bool
    {
        return false;
    }
}
