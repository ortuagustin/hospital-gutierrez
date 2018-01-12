<?php

namespace Tests\Unit;

use App\Contracts\DocTypesRepositoryInterface;
use App\Contracts\HeatingTypesRepositoryInterface;
use App\Contracts\HomeTypesRepositoryInterface;
use App\Contracts\MedicalInsuranceRepositoryInterface;
use App\Contracts\WaterTypesRepositoryInterface;
use Tests\Fakes\FakeReferenceDataRepository;
use Tests\Helpers\FakeReferenceDataTestHelper;
use Tests\Helpers\PatientTestHelper;
use Tests\Unit\TestCase;

class PatientTest extends TestCase
{
    use PatientTestHelper;
    use FakeReferenceDataTestHelper;

    /** @test */
    public function it_has_document_type()
    {
        $model = $this->makeReferenceModel(rand(), 'DNI');
        $this->swapRepository(DocTypesRepositoryInterface::class, [$model]);
        $patient = $this->createPatient(['doc_type_id' => $model->id()]);
        $this->assertNotNull($patient->docType);
    }

    /** @test */
    public function it_has_home_type()
    {
        $model = $this->makeReferenceModel(rand(), 'Flat');
        $this->swapRepository(HomeTypesRepositoryInterface::class, [$model]);
        $patient = $this->createPatient(['home_type_id' => $model->id()]);
        $this->assertNotNull($patient->homeType);
    }

    /** @test */
    public function it_has_water_type()
    {
        $model = $this->makeReferenceModel(rand(), 'Water Well');
        $this->swapRepository(WaterTypesRepositoryInterface::class, [$model]);
        $patient = $this->createPatient(['water_type_id' => $model->id()]);
        $this->assertNotNull($patient->waterType);
    }

    /** @test */
    public function it_has_heating_type()
    {
        $model = $this->makeReferenceModel(rand(), 'Electrical');
        $this->swapRepository(HeatingTypesRepositoryInterface::class, [$model]);
        $patient = $this->createPatient(['heating_type_id' => $model->id()]);
        $this->assertNotNull($patient->heatingType);
    }

    /** @test */
    public function it_has_social_insurance_type()
    {
        $model = $this->makeReferenceModel(rand(), 'IOMA');
        $this->swapRepository(MedicalInsuranceRepositoryInterface::class, [$model]);
        $patient = $this->createPatient(['medical_insurance_id' => $model->id()]);
        $this->assertNotNull($patient->medicalInsurance);
    }

    /**
     * Injects a FakeRepository for the given contract that contains the specified models
     * @param string $contract
     * @param array  $models
     * @return $this
     */
    protected function swapRepository($contract, array $models = [])
    {
        app()->instance($contract, $this->fakeRepository($models));

        return $this;
    }

    /**
     * Creates an instance of a FakeReferenceDataRepository that contains the specified models
     * @param array $models
     * @return FakeReferenceDataRepository
     */
    protected function fakeRepository(array $models = [])
    {
        return new FakeReferenceDataRepository($models);
    }
}
