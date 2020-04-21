<?php

namespace App\Policies;

use App\Permissions;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
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
        return in_array(Permissions::__READ_PROFILE__, json_decode($user->role->permissions, 1));
    }

    /**
     * Determine whether the user can write profile.
     *
     * @param User $user
     * @return mixed
     */
    public function write(User $user) {
        return in_array(Permissions::__WRITE_PROFILE__, json_decode($user->role->permissions, 1));
    }

    /**
     * Determine whether the user can read CV.
     *
     * @param User $user
     * @return mixed
     */
    public function readCV(User $user){
        return in_array(Permissions::__READ_CV__,json_decode($user->role->permissions, 1));
    }

    /**
     * Determine whether the user can write CV.
     *
     * @param User $user
     * @return mixed
     */
    public function writeCV(User $user){
        return in_array(Permissions::__WRITE_CV__,json_decode($user->role->permissions, 1));
    }
}
