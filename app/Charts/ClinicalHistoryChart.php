<?php

namespace App\Charts;

use App\Patient;

abstract class ClinicalHistoryChart extends Chart
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
        return $this->isBoys() ? $this->boysStaticDatasets() : $this->girlsStaticDatasets();
    }

    /**
     * Returns an array containing all the static (constant) data of the chart for boys
     *
     * @return array
     */
    abstract protected function girlsStaticDatasets();

    /**
     * Returns an array containing all the static (constant) data of the chart for girls
     *
     * @return array
     */
    abstract protected function boysStaticDatasets();

    /**
     * Returns true if the chart must be rendered for boys; false if must be rendered for girls
     *
     * @return boolean
     */
    protected function isBoys()
    {
        return $this->patient()->gender == 'male';
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
