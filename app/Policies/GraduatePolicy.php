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
    public function change(User $user, Graduate $graduate)
    {
        if ($user->isModerator() || $user->isAdmin()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can restore the graduate.
     *
     * @param  \App\User  $user
     * @param  \App\Graduate  $graduate
     * @return mixed
     */
    public function restore(User $user, Graduate $graduate)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the graduate.
     *
     * @param  \App\User  $user
     * @param  \App\Graduate  $graduate
     * @return mixed
     */
    public function forceDelete(User $user, Graduate $graduate)
    {
        //
    }
}
