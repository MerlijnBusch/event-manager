<?php

namespace App\Http\Requests;

use App\Rules\CongressExistValidator;
use Illuminate\Foundation\Http\FormRequest;

class BlockStoreValidationRequest extends FormRequest
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
            'congress_id' => ['required', new CongressExistValidator],
            'date_start' => ['required', 'date'],
            'date_end' => ['required', 'date'],
        ];
    }
}
