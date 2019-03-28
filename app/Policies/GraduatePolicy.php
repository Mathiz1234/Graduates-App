<?php

namespace App\Policies;

use App\User;
use App\Graduate;
use Illuminate\Auth\Access\HandlesAuthorization;

class GraduatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the graduate.
     *
     * @param  \App\User  $user
     * @param  \App\Graduate  $graduate
     * @return mixed
     */
    public function show(?User $user, $graduate)
    {
        if (auth()->check()) {
            return true;
        } else {
            return $graduate->isShared();
        }
    }

    /**
     * Determine whether the user can change the graduate.
     *
     * @param  \App\User  $user
     * @param  \App\Graduate  $graduate
     * @return mixed
     */
    public function change(User $user)
    {
        if ($user->isModerator() || $user->isAdmin()) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Determine whether the user can permanently delete the graduate.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function forceDeleted(User $user)
    {
        return $user->isAdmin();
    }
}
