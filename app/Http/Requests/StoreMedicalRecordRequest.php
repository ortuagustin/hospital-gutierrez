<?php

namespace App\Http\Requests;

use App\MedicalRecord;
use Illuminate\Foundation\Http\FormRequest;

/**
 * A Request that is sent when we need to persist a Medical Record model
 */
class StoreMedicalRecordRequest extends FormRequest
{
    /**
     * This will hold the persisted MedicalRecord Moel instance only if the saved property is true
     * @var MedicalRecord
     */
    private $medicalRecord = null;

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
            'patient_id'                    => 'required|exists:patients,id',
            'user_id'                       => 'required|exists:users,id',
            'fecha'                         => 'required',
            'peso'                          => 'required|numeric',
            'talla'                         => 'required|numeric',
            'percentilo_cefalico'           => 'required|numeric',
            'percentilo_perimetro_cefalico' => 'required|numeric',
            'alimentacion_observaciones'    => 'present',
            'vacunas_completas'             => 'required|boolean',
            'vacunas_observaciones'         => 'present',
            'maduracion_acorde'             => 'required|boolean',
            'maduracion_observaciones'      => 'present',
            'examen_fisico_normal'          => 'required|boolean',
            'examen_fisico_observaciones'   => 'present',
            'observaciones'                 => 'present',
        ];
    }

    /**
     * Saves the MedicalRecord to the Database with the inputs from the Request
     *
     * @return bool
     */
    public function save()
    {
        $this->medicalRecord = MedicalRecord::updateOrCreate(
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
     * The saved MedicalRecord instance
     *
     * @return MedicalRecord
     */
    public function medicalRecord()
    {
        if ($this->saved()) {
            return $this->medicalRecord;
        }

        throw new \InvalidArgumentException("MedicalRecord is not saved");
    }
}
