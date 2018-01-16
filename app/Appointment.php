<?php

namespace App;

use App\Patient;
use Illuminate\Database\Eloquent\Model;

/**
 * A Model that represents an Appointment
 */
class Appointment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'patient_id', 'date',
        ];

    /**
     * The attributes that should be parsed as Carbon Dates
     *
     * @var array
     */
    protected $dates = [
            'date', 'created_at', 'updated_at',
        ];

    /**
     * Returns the time portion of the Appointment
     * @return string
     */
    public function getTimeAttribute()
    {
        return $this->date->toTimeString();
    }

    /**
     * Get the Patient record associated with the Appointment.
     * @return Patient
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
