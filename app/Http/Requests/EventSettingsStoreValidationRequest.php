<?php

namespace App\Http\Requests;

use App\Rules\ColorValidator;
use App\Rules\EventExistValidator;
use Illuminate\Foundation\Http\FormRequest;

class EventSettingsStoreValidationRequest extends FormRequest
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
            'visible_registrations' => ['required', 'integer'],
            'max_registrations' => ['required', 'gt:visible_registrations', 'integer'],
            'date_start' => ['required', 'date'],
            'date_end' => ['required', 'date'],
            'color' => ['required', new ColorValidator],
            'location' => ['required', 'string'],
            'light_theme' => ['required', 'boolean'],
        ];
    }
}
