<?php

namespace App\Policies;

use App\Models\User;

class DatasetPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function resetDataset(User $user)
    {
        return $user->isAdmin();
    }
}
