<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function before(User $user)
    {
        if ($user->hasRole('super-admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Post $post): bool
    {   
        if ($post->published) {
            return true;
        }

        if (!($post->published) && $user === null) {
            return false;
        }

        if ($user->can('view unpublished post')) {
            return true;
        }

        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->isBlocked()) {
            return false;
        }

        if ($user->can('create post')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        if ($user->isBlocked()) {
            return false;
        }

        if ($user->can('edit all posts')) {
            return true;
        }

        if ($user->can('edit own post')) {
            return $user->id === $post->user_id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        if ($user->isBlocked()) {
            return false;
        }

        if ($user->can('delete all posts')) {
            return true;
        }

        if ($user->can('delete own post')) {
            return $user->id === $post->user_id;
        }

        return false;
    }
}
