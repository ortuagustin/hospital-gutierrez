<?php

namespace App\Repositories;

use App\Contracts\ReportsRepositoryInterface;

/**
 * @inheritDoc
 */
class ReportsRepository implements ReportsRepositoryInterface
{
    /**
     * @var array
     */
    protected $reports = [];

    /**
     * @param array $reports
     */
    public function __construct(array $reports = [])
    {
        $this->reports = $reports;
    }

    /**
     * @inheritDoc
     */
    public function getReport($name)
    {
        return $this->reports[$name];
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
        return array_keys($this->reports);
    }
}
