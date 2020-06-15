<?php

namespace App\Http\Requests;

use App\Rules\ItemTypeValidator;
use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateValidationRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'type' => ['required', new ItemTypeValidator],
            'description' => ['required'],
            'date_start' => ['date'],
            'date_end' => ['date'],
            'active' => ['required', 'boolean'],
        ];
    }
}
