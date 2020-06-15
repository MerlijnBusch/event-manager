<?php

namespace App\Http\Requests;

use App\Rules\BlockExistValidator;
use App\Rules\ItemTypeValidator;
use Illuminate\Foundation\Http\FormRequest;

class ItemStoreValidationRequest extends FormRequest
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
            'block_id' => ['required', new BlockExistValidator],
            'date_start' => ['date'],
            'date_end' => ['date'],
            'active' => ['required', 'boolean'],
        ];
    }
}
