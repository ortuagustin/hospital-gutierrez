<?php

namespace Tests\Helpers;

use App\Appointment;

trait AppointmentTestHelper
{
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
