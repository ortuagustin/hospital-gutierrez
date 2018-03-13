<?php

namespace App\Repositories;

use App\Contracts\DemographicReportsRepositoryInterface;

/**
 * @inheritDoc
 */
class DemographicReportsRepository extends ReportsRepository implements DemographicReportsRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getReport($name)
    {
        return $this->hasReport($name) ? $this->reports[$name] : $this->nullReport;
    }
}
