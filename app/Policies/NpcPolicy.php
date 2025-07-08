<?php

namespace App\Policies;

use App\Models\Npc;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NpcPolicy
{
    public function tag(User $user, Npc $npc): bool
    {
        return $user->hasAdminAccess() || $user->hasSuperAdminAccess();
    }
}
