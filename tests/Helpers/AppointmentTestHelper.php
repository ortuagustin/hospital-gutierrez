<?php

namespace Tests\Helpers;

use App\Appointment;
use Carbon\Carbon;

trait AppointmentTestHelper
{
    /**
     * Saves a new Appointment to the database and returns it
     *
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
     *
     * @param int $amount
     * @param array $overrides
     *
     * @return Illuminate\Support\Collection
     */
    protected function createAppointments($amount = 2, array $overrides = [])
    {
        return factory(Appointment::class, $amount)->create($overrides);
    }

    /**
     * Saves a new Appointment at the given date to the database and returns it
     *
     * @param int|null  $hour
     * @param int|null  $minute
     * @param int|null  $day
     * @param int|null  $month
     * @param int|null  $year
     *
     * @return Appointment
     */
    protected function createAppointmentAt($hour = null, $minute = null, $day = null, $month = null, $year = null)
    {
        return factory(Appointment::class)->create(['date' => Carbon::create($year, $month, $day, $hour, $minute)]);
    }
}
