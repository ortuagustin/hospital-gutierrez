<?php

namespace App\Repositories;

use App\Contracts\PatientsReportsRepositoryInterface;
use App\Patient;

/**
 * @inheritDoc
 */
class PatientsReportsRepository extends ReportsRepository implements PatientsReportsRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getReport($name, Patient $patient)
    {
        if ($this->hasReport($name)) {
            $report = $this->reports[$name];

            return $report->render($patient);
        }

        return $this->nullReport;
    }
}
