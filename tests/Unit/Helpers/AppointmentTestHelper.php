<?php

namespace Tests\Unit\Helpers;

use App\Appointment;
use App\Patient;

trait AppointmentTestHelper
{
    /**
     * Saves a new Patient to the database and returns it
     * @param array $overrides
     * @return Patient
     */
    protected function createPatient(array $overrides = [])
    {
        return factory(Patient::class)->create($overrides);
    }

    /**
     * Saves a new Appointment to the database and returns it
     * @param array $overrides
     * @return Appointment
     */
    protected function createAppointment(array $overrides = [])
    {
        return factory(Appointment::class)->create($overrides);
    }
}
