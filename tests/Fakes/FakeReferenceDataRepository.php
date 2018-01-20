<?php

namespace Tests\Fakes;

use App\Contracts\DocTypesRepositoryInterface;
use App\Contracts\HeatingTypesRepositoryInterface;
use App\Contracts\HomeTypesRepositoryInterface;
use App\Contracts\MedicalInsurancesRepositoryInterface;
use App\Contracts\ReferenceDataRepository\HandlesReferenceDataCollection;
use App\Contracts\ReferenceDataRepositoryInterface;
use App\Contracts\WaterTypesRepositoryInterface;

class FakeReferenceDataRepository implements
    ReferenceDataRepositoryInterface,
    DocTypesRepositoryInterface,
    HomeTypesRepositoryInterface,
    HeatingTypesRepositoryInterface,
    WaterTypesRepositoryInterface,
    MedicalInsurancesRepositoryInterface
{
    use HandlesReferenceDataCollection;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $models;

    /**
     * @param array $models
     */
    public function __construct(array $models = [])
    {
        $this->models = collect($models);
    }

    public function all()
    {
        return $this->models;
    }
}
