<?php

namespace App\Charts;

class WeightGrowthReportChart extends ClinicalHistoryChart
{
    /** @inheritDoc */
    protected function girlsStaticDatasets()
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
    protected function boysStaticDatasets()
    {
        return [
            $this->createDataset('3rd', [2.5, 2.6, 2.8, 3.1, 3.4, 3.6, 3.8, 4.1, 4.3, 4.4, 4.6, 4.8, 4.9, 5.1]),
            $this->createDataset('15th', [2.9, 3.0, 3.2, 3.5, 3.8, 4.1, 4.3, 4.5, 4.7, 4.9, 4.1, 5.3, 5.5, 5.6]),
            $this->createDataset('50th', [3.3, 3.5, 3.8, 4.1, 4.4, 4.7, 4.9, 5.2, 5.4, 5.6, 5.8, 6.0, 6.2, 6.4]),
            $this->createDataset('85th', [3.7, 3.9, 4.1, 4.4, 4.7, 5.0, 5.2, 5.5, 5.7, 5.9, 6.1, 6.3, 6.5, 6.6]),
            $this->createDataset('97th', [4.3, 4.5, 4.9, 5.2, 5.6, 5.9, 6.3, 6.5, 6.8, 7.1, 7.3, 7.5, 7.7, 7.9]),
        ];
    }
}
