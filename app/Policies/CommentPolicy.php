<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function before(User $user)
    {
        if ($user->hasRole('super-admin')) {
            return true;
        }

        if ($user->isBlocked()) {
            return false;
        }
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->can('write comment')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Comment $comment): bool
    {   
        if ($user->can('delete all comments')) {
            return true;
        }
        
        if ($user->can('delete own comment')) {
            return $user->id === $comment->user_id;
        }

        return false;
    }
}
