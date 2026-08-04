<?php

namespace App\Policies\Concerns;

use App\Models\User;

trait AdminBypass
{
    /**
     * Allow administrators to perform any ability.
     */
    public function before(User $user, string $ability): ?bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }
}
