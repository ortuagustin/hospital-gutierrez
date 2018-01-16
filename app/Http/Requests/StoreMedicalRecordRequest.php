<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * A Request that is sent when we need to persist a Medical Record model
 */
class StoreMedicalRecordRequest extends FormRequest
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
            'patient_id'                    => 'required|exists:patients,id',
            'user_id'                       => 'required|exists:users,id',
            'fecha'                         => 'required',
            'peso'                          => 'required|numeric',
            'talla'                         => 'required|numeric',
            'percentilo_cefalico'           => 'required|numeric',
            'percentilo_perimetro_cefalico' => 'required|numeric',
            'alimentacion_observaciones'    => 'required|string',
            'vacunas_completas'             => 'required|boolean',
            'vacunas_observaciones'         => 'required|string',
            'maduracion_acorde'             => 'required|boolean',
            'maduracion_observaciones'      => 'required|string',
            'examen_fisico_normal'          => 'required|boolean',
            'examen_fisico_observaciones'   => 'required|string',
            'observaciones'                 => 'required|string',
        ];
    }
}
