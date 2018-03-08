<?php

namespace Tests\Helpers;

use App\Appointment;

trait AppointmentTestHelper
{
    /**
     * Saves a new Appointment to the database and returns it
     * @param array $overrides
     *
     * @return Appointment
     */
    protected function createAppointment(array $overrides = [])
    {
        return factory(Appointment::class)->create($overrides);
    }

    /**
     * Saves a collection of new Appointments to the database and returns it
     * @param int $amount
     * @param array $overrides
     *
     * @return Illuminate\Support\Collection
     */
    protected function createAppointments($amount = 2, array $overrides = [])
    {
        return factory(Appointment::class, $amount)->create($overrides);
    }
}
