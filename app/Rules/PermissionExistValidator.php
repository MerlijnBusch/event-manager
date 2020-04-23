<?php

namespace App\Rules;

use App\Permissions;
use Illuminate\Contracts\Validation\Rule;

class PermissionExistValidator implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $perms = (new Permissions)->getAllPermissions();
        foreach ($value as $a){
            if(!in_array($a, $perms)){
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute contains a not valid permission';
    }
}
