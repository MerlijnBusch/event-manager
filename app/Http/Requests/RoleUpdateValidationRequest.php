<?php

namespace App\Http\Requests;

use App\Rules\ColorValidator;
use App\Rules\PermissionExistValidator;
use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateValidationRequest extends FormRequest
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
            'role_name' => ['string', 'required', 'max:100'],
            'color' => ['string', new ColorValidator],
            'permissions' => [new PermissionExistValidator],
        ];
    }
}
