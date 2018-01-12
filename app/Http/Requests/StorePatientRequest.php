<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * A Request that is sent when we need to persist a Patient model
 */
class StorePatientRequest extends FormRequest
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
          'doc_type_id'          => 'required|numeric',
          'home_type_id'         => 'required|numeric',
          'heating_type_id'      => 'required|numeric',
          'water_type_id'        => 'required|numeric',
          'medical_insurance_id' => 'required|numeric',
          'name'                 => 'required|regex:/[\w\. \-\,]+$/',
          'last_name'            => 'required|regex:/[\w\. \-\,]+$/',
          'dni'                  => 'required|unique:patients',
          'birth_date'           => 'required|',
          'gender'               => 'required|in:male,female,unknown',
          'address'              => 'required|string',
          'phone'                => 'required|regex:/^[\d \-\+]+$/',
          'has_refrigerator'     => 'required|boolean',
          'has_electricity'      => 'required|boolean',
          'has_pet'              => 'required|boolean',
        ];
    }
}
