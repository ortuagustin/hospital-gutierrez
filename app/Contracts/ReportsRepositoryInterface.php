<?php

namespace App\Contracts;

/**
 * Holds all the available reports
 */
interface ReportsRepositoryInterface
{
    /**
     * Adds the given report to the repository
     *
     * @param string $name
     * @param mixed $report
     *
     * @return $this
     */
    public function addReport($name, $report);

    /**
     * Returns an array with all the registered reports names
     *
     * @return array
     */
    public function names();

    /**
     * Returns an array with all the registered reports
     *
     * @return array
     */
    public function all();
}
