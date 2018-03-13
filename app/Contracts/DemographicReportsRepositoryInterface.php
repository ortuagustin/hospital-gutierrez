<?php

namespace App\Contracts;

/**
 * Holds all the available demographic reports
 */
interface DemographicReportsRepositoryInterface extends ReportsRepositoryInterface
{
    /**
     * Returns the report data and options
     *
     * @param string $name
     *
     * @return \JsonSerializable
     */
    public function getReport($name);
}
