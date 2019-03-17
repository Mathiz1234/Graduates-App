<?php

namespace App\Policies;

use App\User;
use App\Graduate;
use Illuminate\Auth\Access\HandlesAuthorization;

class GraduatePolicy
{
    use HandlesAuthorization;

    // /**
    //  * Determine whether the user can view the graduate.
    //  *
    //  * @param  \App\User  $user
    //  * @param  \App\Graduate  $graduate
    //  * @return mixed
    //  */
    // public function view(User $user)
    // {
    // }

    /**
     * Determine whether the user can create graduates.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the graduate.
     *
     * @param  \App\User  $user
     * @param  \App\Graduate  $graduate
     * @return mixed
     */
    public function update(User $user, Graduate $graduate)
    {
        //
    }

    /**
     * Determine whether the user can delete the graduate.
     *
     * @param  \App\User  $user
     * @param  \App\Graduate  $graduate
     * @return mixed
     */
    public function delete(User $user, Graduate $graduate)
    {
        //
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
