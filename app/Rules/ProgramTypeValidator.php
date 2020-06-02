<?php

namespace App\Rules;

use App\Program;
use Illuminate\Contracts\Validation\Rule;

class ProgramTypeValidator implements Rule
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
        $program = new Program();
        $allTypes = $program->getAllItemTypes();
        return  in_array($value, $allTypes);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Program type doesnt exist';
    }
}
