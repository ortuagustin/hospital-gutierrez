<?php

namespace App\Contracts;

/**
 * Holds all the available reports
 */
interface ReportsRepositoryInterface
{
    /**
     * Returns the report data and options
     * @param string $name
     * @return void
     */
    public function getReport($name);

    /**
     * Adds the given report to the repository
     * @param string $name
     * @param mixed $report
     * @return $this
     */
    public function addReport($name, $report);

    /**
     * Returns an array with all the registered reports names
     * @return array
     */
    public function names();
}
