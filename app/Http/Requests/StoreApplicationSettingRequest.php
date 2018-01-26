<?php

namespace App\Http\Requests;

use App\ApplicationSetting;
use Illuminate\Foundation\Http\FormRequest;

/**
 * A Request that is sent when we need to persist an ApplicationSetting model
 */
class StoreApplicationSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'key'         => 'required|string|unique:application_settings',
            'value'       => 'required|string',
        ];
    }

    /**
     * Saves the ApplicationSetting to the Database with the inputs from the Request
     *
     * @return ApplicationSetting
     */
    public function save()
    {
        return ApplicationSetting::put($this->key, $this->value);
    }
}
