<?php

namespace App\Http\Requests;

use App\Patient;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * A Request that is sent when we need to persist a Patient model
 */
class StorePatientRequest extends FormRequest
{
    /**
     * This will hold the persisted Patient Moel instance only if the saved property is true
     *
     * @var Patient
     */
    private $patient = null;

    /**
     * True if the save method was succesful
     * @var bool
     */
    private $saved = false;

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
          'doc_type_id'          => 'required|numeric|foreign_doc_type',
          'home_type_id'         => 'required|numeric|foreign_home_type',
          'heating_type_id'      => 'required|numeric|foreign_heating_type',
          'water_type_id'        => 'required|numeric|foreign_water_type',
          'medical_insurance_id' => 'required|numeric|foreign_medical_insurance',
          'name'                 => 'required|regex:/[\w\. \-\,]+$/',
          'last_name'            => 'required|regex:/[\w\. \-\,]+$/',
          'dni'                  => 'required|' . Rule::unique('patients')->ignore($this->id),
          'birth_date'           => 'required|',
          'gender'               => 'required|in:male,female,unknown',
          'address'              => 'required|string',
          'phone'                => 'required|regex:/^[\d \-\+]+$/',
          'has_refrigerator'     => 'required|boolean',
          'has_electricity'      => 'required|boolean',
          'has_pet'              => 'required|boolean',
        ];
    }

    /**
     * Saves the Patient to the Database with the inputs from the Request
     *
     * @return bool
     */
    public function save()
    {
        $this->patient = Patient::updateOrCreate(
            ['id' => $this->id],
            $this->except('id')
        );

        $this->saved = true;

        return $this->saved();
    }

    /**
     * True if the save method was succesful
     *
     * @return bool
     */
    public function saved()
    {
        return $this->saved;
    }

    /**
     * The saved Patient instance
     *
     * @return Patient
     */
    public function patient()
    {
        if ($this->saved()) {
            return $this->patient;
        }

        throw new \InvalidArgumentException("Patient is not saved");
    }
}
