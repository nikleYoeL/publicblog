<?php

namespace App\Policies;

use App\Models\User;

class ProfilePolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $profile):bool
    {
        if ($user->id === $profile->id) {
            return true;
        }

        if ($profile->hasRole('super-admin')) {
            return false;
        }

        if ($user->can('edit profiles')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $profile): bool
    {
        if ($user->id === $profile->id) {
            return true;
        }

        if ($user->can('delete profiles')) {
            return true;
        }

        return false;
    }

    public function deleteAvatar(User $user, User $profile): bool
    {
        return $user->id == $profile->id;
    }
}
