<?php

namespace App\Http\Requests;

use App\Rules\EventExistValidator;
use Illuminate\Foundation\Http\FormRequest;

class ProgramStoreValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'event_id' => ['required', new EventExistValidator],
            'name' => ['string'],
            'description' => ['string'],
            'active' => ['boolean'],
        ];
    }
}
