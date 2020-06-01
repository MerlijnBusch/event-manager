<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Base64Validator implements Rule
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
        $decoded = base64_decode($value, true);

        if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $value)) return false;
        if (!$decoded) return false;
        if (base64_encode($decoded) != $value) return false;

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Something went wrong converting the file try again';
    }
}
