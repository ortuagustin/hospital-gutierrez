<?php

namespace App\Charts;

use App\Contracts\DocTypesRepositoryInterface;
use App\Contracts\HeatingTypesRepositoryInterface;
use App\Contracts\HomeTypesRepositoryInterface;
use App\Contracts\MedicalInsurancesRepositoryInterface;
use App\Contracts\ReferenceDataRepositoryInterface;
use App\Contracts\WaterTypesRepositoryInterface;
use App\Patient;
use Illuminate\Support\Facades\DB;

abstract class PatientsChart extends Chart
{
    /**
     * @var ReferenceDataRepositoryInterface
     */
    protected $repository;

    /**
     * The field to group by the patients; value must be provided by subclass
     *
     * @var string
     */
    protected $group_by;

    /**
     * @inheritDoc
     */
    public function data()
    {
        return Patient::select(DB::raw('count(*) as total'))
                      ->groupBy($this->group_by)
                      ->pluck('total')
                      ->all();
    }

    /**
     * @inheritDoc
     */
    protected function labels()
    {
        return $this->repository->all()->map(function ($each) {
            return $each->value();
        });
    }
}

class PatientsPerHomeTypeChart extends PatientsChart
{
    protected $group_by = 'home_type_id';

    /**
     * @inheritDoc
     */
    public function __construct()
    {
        $this->repository = resolve(HomeTypesRepositoryInterface::class);
    }
}

class PatientsPerWaterTypeChart extends PatientsChart
{
    protected $group_by = 'water_type_id';

    /**
     * @inheritDoc
     */
    public function __construct()
    {
        $this->repository = resolve(WaterTypesRepositoryInterface::class);
    }
}
