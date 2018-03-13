<?php

namespace App\Repositories;

use App\Contracts\DemographicReportsRepositoryInterface;

/**
 * @inheritDoc
 */
class DemographicReportsRepository implements DemographicReportsRepositoryInterface
{
    /**
     * Represents a null (empty) report
     *
     * @var array
     */
    protected $nullReport = [];

    /**
     * @var array
     */
    protected $reports = [];

    /**
     * @param array $reports
     */
    public function __construct(array $reports = [])
    {
        foreach ($reports as $report) {
            $this->reports[$report->name()] = $report;
        }
    }

    /**
     * @inheritDoc
     */
    public function getReport($name)
    {
        return $this->hasReport($name) ? $this->reports[$name] : $this->nullReport;
    }

    /**
     * @inheritDoc
     */
    public function addReport($name, $report)
    {
        $this->reports[$name] = $report;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function names()
    {
        return array_keys($this->all());
    }

    /**
     * @inheritDoc
     */
    public function all()
    {
        return $this->reports;
    }

    /**
     * Returns wether the report exists in the repository
     *
     * @param string $name
     *
     * @return bool
     */
    private function hasReport($name)
    {
        return array_key_exists($name, $this->reports);
    }
}
