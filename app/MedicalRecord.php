<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id', 'user_id', 'fecha', 'peso', 'talla',
        'percentilo_cefalico', 'percentilo_perimetro_cefalico',
        'alimentacion_observaciones', 'vacunas_completas',
        'vacunas_observaciones', 'maduracion_acorde',
        'maduracion_observaciones', 'examen_fisico_normal',
        'examen_fisico_observaciones', 'observaciones',
    ];

    /**
     * The User that created this Medical Record
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The Patient that is the owner of this Medical Record
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
