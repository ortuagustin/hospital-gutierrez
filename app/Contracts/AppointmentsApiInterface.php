<?php

namespace App\Contracts;

interface AppointmentsApiInterface
{
    /**
     * Returns an array of available times for appointments at the given date
     *
     * @param string $date
     *
     * @return array
     */
    public function available_at($date);

    /**
     * Returns an array of available times for appointments at the given date
     *
     * @param string $dni
     * @param string $date
     *
     * @return array
     */
    public function schedule($dni, $date);
}
