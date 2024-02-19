<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Post $post): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Post $post): bool
    {
        if ($user->isAdmin === 1) {
            return true;
        }
        return $user->id === $post->user_id;
    }

    public function delete(User $user, Post $post): bool
    {
        if ($user->isAdmin === 1) {
            return true;
        }
        return $user->id === $post->user_id;
    }

    public function restore(User $user, Post $post): bool
    {
    }

    public function forceDelete(User $user, Post $post): bool
    {
    }
}
