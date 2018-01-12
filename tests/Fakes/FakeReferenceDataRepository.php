<?php

namespace Tests\Fakes;

use App\Contracts\DocTypesRepositoryInterface;
use App\Contracts\HeatingTypesRepositoryInterface;
use App\Contracts\HomeTypesRepositoryInterface;
use App\Contracts\MedicalInsuranceRepositoryInterface;
use App\Contracts\ReferenceDataRepositoryInterface;
use App\Contracts\WaterTypesRepositoryInterface;

class FakeReferenceDataRepository implements
    ReferenceDataRepositoryInterface,
    DocTypesRepositoryInterface,
    HomeTypesRepositoryInterface,
    HeatingTypesRepositoryInterface,
    WaterTypesRepositoryInterface,
    MedicalInsuranceRepositoryInterface
{
    /**
     * @var Collection
     */
    protected $models;

    /**
     * @param array $models
     */
    public function __construct(array $models = [])
    {
        $this->models = $this->makeCollection($models);
    }

    public function contains($key)
    {
        return $this->all()->has($key);
    }

    public function get($key)
    {
        return $this->all()->get($key);
    }

    public function all()
    {
        return $this->models;
    }

    /**
     * @param array $values
     */
    protected function makeCollection(array $values)
    {
        $results = [];
        foreach ($values as $each) {
            $results[$each->key()] = $each->value();
        }

        return collect($results);
    }
}
