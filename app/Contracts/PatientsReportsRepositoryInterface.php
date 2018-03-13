<?php

namespace App\Contracts;

use App\Patient;

/**
 * Holds all the available patient reports
 */
interface PatientsReportsRepositoryInterface extends ReportsRepositoryInterface
{
    /**
     * Returns the report data and options
     *
     * @param string $name
     * @param Patient $patient
     *
     * @return \JsonSerializable
     */
    public function getReport($name, Patient $patient);
}
