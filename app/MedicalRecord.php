<?php

namespace App;

use App\Helpers\CalculatesAge;
use Illuminate\Database\Eloquent\Model;

/**
 * A Model that represents a Medical History Record of a Patient
 */
class MedicalRecord extends Model
{
    use CalculatesAge;

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
     * The attributes that should be parsed as Carbon Dates
     *
     * @var array
     */
    protected $dates = [
        'fecha', 'created_at', 'updated_at',
    ];

    /**
     * The User that created this Medical Record
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The Patient that is the owner of this Medical Record
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Returns the name of the User who created the record
     *
     * @return string
     */
    public function user_name()
    {
        return ucfirst($this->user->name);
    }

    /**
     * Returns the name of the User who created the record
     *
     * @return string
     */
    public function getUserNameAttribute()
    {
        return $this->user_name();
    }

    /**
     * Returns the age of the Patient when the control took place
     *
     * @return int
     */
    public function patient_age()
    {
        return $this->age($this->patient->birth_date, $this->fecha);
    }

    /**
     * Returns the age of the Patient when the control took place
     *
     * @return int
     */
    public function getPatientAgeAttribute()
    {
        return $this->patient_age();
    }
}
