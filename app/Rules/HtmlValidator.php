<?php

namespace App\Rules;

use DOMDocument;
use Illuminate\Contracts\Validation\Rule;

class HtmlValidator implements Rule
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
        libxml_use_internal_errors(true);
        $dom = New DOMDocument();
        $dom->loadHTML($value);

        if (empty(libxml_get_errors())) return true;
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This object is not parsed to correct html';
    }
}
