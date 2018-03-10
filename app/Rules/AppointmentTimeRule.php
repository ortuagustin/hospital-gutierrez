<?php

namespace App\Rules;

use App\Appointment;
use Carbon\Carbon;
use Illuminate\Validation\Validator;

/**
 * A Validation Rule that checks that the given time is an allowed Appointment Time
 */
class AppointmentTimeRule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param mixed $attribute
     * @param mixed $value
     * @param mixed $parameters
     * @param Validator $validator
     *
     * @return bool
     */
    public function validate($attribute, $value, $parameters, Validator $validator)
    {
        if (! $value instanceof Carbon) {
            $value = Carbon::parse($value);
        }

        return Appointment::is_allowed_time($value);
    }
}
