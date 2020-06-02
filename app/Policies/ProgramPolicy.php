<?php

namespace App\Policies;

use App\Permissions;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProgramPolicy
{
    use HandlesAuthorization;

    /**
     * @param $user
     * @param $ability
     * @return bool
     */
    public function before($user, $ability) {
        if(in_array(Permissions::__ADMIN__, json_decode($user->role->permissions, 1))){
            return true;
        }
    }

    /**
     * Determine whether the user can read Profile.
     *
     * @param User $user
     * @return mixed
     */
    public function read(User $user) {
        return in_array(Permissions::__READ_PROGRAMS__, json_decode($user->role->permissions, 1));
    }

    /**
     * Determine whether the user can write profile.
     *
     * @param User $user
     * @return mixed
     */
    public function write(User $user) {
        return in_array(Permissions::__WRITE_PROGRAMS__, json_decode($user->role->permissions, 1));
    }
}
