<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    public function show(User $authUser, User $showUser)
    {
        return true;
    }

    public function update(User $authUser, User $showUser)
    {
        return $authUser->id === $showUser->id;
    }

    public function delete(User $authUser, User $showUser)
    {
        return $authUser->id === $showUser->id;
    }
}
