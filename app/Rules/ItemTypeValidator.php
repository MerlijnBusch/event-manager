<?php

namespace App\Rules;

use App\Item;
use Illuminate\Contracts\Validation\Rule;

class ItemTypeValidator implements Rule
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
        if(Item::where('type', $value) == "keynotes" || Item::where('type', $value) == "congress_speakers" ){
            return false;
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
        return "Item type doesn't exist";
    }
}
