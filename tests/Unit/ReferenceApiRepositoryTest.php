<?php

namespace Tests\Unit;

use App\Repositories\DocTypesRepository;
use App\Repositories\HeatingTypesRepository;
use App\Repositories\HomeTypesRepository;
use App\Repositories\MedicalInsurancesRepository;
use App\Repositories\WaterTypesRepository;
use Tests\Unit\TestCase;

class ReferenceApiRepository extends TestCase
{
    /**
     * Holds all repositories under test
     * @var array
     */
    protected $repositories = [];

    /** @test */
    public function it_returns_non_empty_collection_when_requesting_all_models()
    {
        foreach ($this->repositories as $each) {
            $this->assertTrue($each->all()->isNotEmpty());
        }
    }

    /** @before */
    protected function setUpEnviroment()
    {
        $this->repositories[] = new DocTypesRepository();
        $this->repositories[] = new HomeTypesRepository();
        $this->repositories[] = new HeatingTypesRepository();
        $this->repositories[] = new WaterTypesRepository();
        $this->repositories[] = new MedicalInsurancesRepository();
    }
}
