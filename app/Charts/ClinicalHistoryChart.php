<?php

namespace App\Charts;

use App\Patient;

class ClinicalHistoryChart extends Chart
{
    private $patient;

    /** @inheritDoc */
    protected function labels()
    {
    }

    /** @inheritDoc */
    protected function data()
    {
        return $this->clinical_history();
    }

    protected function clinical_history()
    {
        return $this->patient->medicalRecords;
    }

    public function render(Patient $patient)
    {
        $this->patient = $patient;

        return $this;
    }

    /** @inheritDoc */
    public function endpoint()
    {
        return route('patients.reports', [$this->patient], false) . '/' . $this->name();
    }
}
