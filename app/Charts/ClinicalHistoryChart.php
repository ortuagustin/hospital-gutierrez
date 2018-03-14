<?php

namespace App\Charts;

use App\Patient;

class ClinicalHistoryChart extends Chart
{
    /** @inheritDoc */
    protected $isResponsive = true;

    /**
     * An array where each element is a week number
     *
     * @param int $upto
     *
     * @return array
     */
    protected function weeksArray($upto = 13)
    {
        $weeks = [];

        for ($i = 0; $i <= $upto; $i++) {
            $weeks[] = (string) $i;
        }

        return $weeks;
    }

    /**
     * Creates a chart dataset
     *
     * @param string $name
     * @param array $data
     *
     * @return array
     */
    protected function createDataset($name, array $data)
    {
        return [
            'label'           => $name,
            'data'            => $data,
            'borderColor'     => Colours::random(),
            'fill'            => false,
        ];
    }

    /**
     * Returns an array containing all the static (constant) data of the chart
     *
     * @return array
     */
    protected function staticDatasets()
    {
        return [
            $this->createDataset('3rd', [2.4, 2.5, 2.7, 2.9, 3.1, 3.3, 3.5, 3.7, 3.9, 4.1, 4.2, 4.3, 4.4, 4.5]),
            $this->createDataset('15th', [2.8, 2.9, 3.1, 3.3, 3.5, 3.8, 4.0, 4.2, 4.4, 4.5, 4.7, 4.8, 5.0, 5.1]),
            $this->createDataset('50th', [3.2, 3.3, 3.6, 3.8, 4.1, 4.3, 4.6, 4.8, 5.0, 5.2, 5.4, 5.5, 5.7, 5.8]),
            $this->createDataset('85th', [3.7, 3.9, 4.1, 4.4, 4.7, 5.0, 5.2, 5.5, 5.7, 5.9, 6.1, 6.3, 6.5, 6.6]),
            $this->createDataset('97th', [4.2, 4.4, 4.7, 5.0, 5.4, 5.7, 6.0, 6.2, 6.5, 6.7, 6.9, 7.1, 7.3, 7.5]),
        ];
    }

    /** @inheritDoc */
    protected function datasets()
    {
        $datasets = [];

        foreach ($this->staticDatasets() as $each) {
            $datasets[] = $each;
        }

        $datasets[] = $this->createDataset('patient', $this->data());

        return $datasets;
    }

    /** @inheritDoc */
    protected function labels()
    {
        return $this->weeksArray();
    }

    /** @inheritDoc */
    protected function data()
    {
        return [];
    }

    protected function clinical_history()
    {
        return $this->patient()->medicalRecords;
    }

    protected function patient()
    {
        return request()->patient;
    }

    /** @inheritDoc */
    public function endpoint()
    {
        return route('patients.reports', [$this->patient()], false) . '/' . $this->name();
    }
}
