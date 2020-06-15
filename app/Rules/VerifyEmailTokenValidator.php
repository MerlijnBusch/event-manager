<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class VerifyEmailTokenValidator implements Rule
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
        $token = DB::table('verify_token')->where('token', $value)->first();
        if($token == NULL){
            return false;
        }
        $now = Carbon::create($token->date);
        $oneDay = $now->copy()->addHour();

        if (Carbon::now()->between($now, $oneDay)) {

            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The token is invalid';
    }
}
