<?php

namespace Tests\Unit;

use App\Contracts\DocTypesRepositoryInterface;
use App\Contracts\HeatingTypesRepositoryInterface;
use App\Contracts\HomeTypesRepositoryInterface;
use App\Contracts\MedicalInsurancesRepositoryInterface;
use Tests\Fakes\FakeReferenceDataRepository;
use Tests\Helpers\FakeReferenceDataTestHelper;
use Tests\Helpers\PatientTestHelper;
use Tests\Unit\TestCase;

class PatientTest extends TestCase
{
    use PatientTestHelper;
    use FakeReferenceDataTestHelper;

    /** @test */
    public function it_returns_related_document_type()
    {
        $model = $this->makeReferenceModel(rand(), 'DNI');
        $this->swapRepository(DocTypesRepositoryInterface::class, [$model]);
        $patient = $this->createPatient(['doc_type_id' => $model->id()]);
        $this->assertNotNull($patient->docType);
    }

    /** @test */
    public function it_returns_related_home_type()
    {
        $model = $this->makeReferenceModel(rand(), 'Flat');
        $this->swapRepository(HomeTypesRepositoryInterface::class, [$model]);
        $patient = $this->createPatient(['home_type_id' => $model->id()]);
        $this->assertNotNull($patient->homeType);
    }

    /** @test */
    public function it_returns_related_doc_type()
    {
        $model = $this->makeReferenceModel(rand(), 'doc Well');
        $this->swapRepository(DocTypesRepositoryInterface::class, [$model]);
        $patient = $this->createPatient(['doc_type_id' => $model->id()]);
        $this->assertNotNull($patient->docType);
    }

    /** @test */
    public function it_returns_related_heating_type()
    {
        $model = $this->makeReferenceModel(rand(), 'Electrical');
        $this->swapRepository(HeatingTypesRepositoryInterface::class, [$model]);
        $patient = $this->createPatient(['heating_type_id' => $model->id()]);
        $this->assertNotNull($patient->heatingType);
    }

    /** @test */
    public function it_returns_related_social_insurance_type()
    {
        $model = $this->makeReferenceModel(rand(), 'IOMA');
        $this->swapRepository(MedicalInsurancesRepositoryInterface::class, [$model]);
        $patient = $this->createPatient(['medical_insurance_id' => $model->id()]);
        $this->assertNotNull($patient->medicalInsurance);
    }

    /** @test */
    public function its_related_document_type_can_be_changed()
    {
        $old_doc_type = $this->makeReferenceModel(rand(), 'Electrical');
        $new_doc_type = $this->makeReferenceModel(rand(), 'Gas');
        $patient = $this->createPatient(['doc_type_id' => $old_doc_type->id()]);
        $this->swapRepository(DocTypesRepositoryInterface::class, [$old_doc_type, $new_doc_type]);
        $patient->docType = $new_doc_type;
        $this->assertNotSame($patient->docType, $new_doc_type);
    }

    /** @test */
    public function its_related_home_type_can_be_changed()
    {
        $old_home_type = $this->makeReferenceModel(rand(), 'Electrical');
        $new_home_type = $this->makeReferenceModel(rand(), 'Gas');
        $patient = $this->createPatient(['home_type_id' => $old_home_type->id()]);
        $this->swapRepository(HomeTypesRepositoryInterface::class, [$old_home_type, $new_home_type]);
        $patient->homeType = $new_home_type;
        $this->assertNotSame($patient->homeType, $new_home_type);
    }

    /** @test */
    public function its_related_doc_type_can_be_changed()
    {
        $old_doc_type = $this->makeReferenceModel(rand(), 'Electrical');
        $new_doc_type = $this->makeReferenceModel(rand(), 'Gas');
        $patient = $this->createPatient(['doc_type_id' => $old_doc_type->id()]);
        $this->swapRepository(docTypesRepositoryInterface::class, [$old_doc_type, $new_doc_type]);
        $patient->docType = $new_doc_type;
        $this->assertNotSame($patient->docType, $new_doc_type);
    }

    /** @test */
    public function its_related_heating_type_can_be_changed()
    {
        $old_heating_type = $this->makeReferenceModel(rand(), 'Electrical');
        $new_heating_type = $this->makeReferenceModel(rand(), 'Gas');
        $patient = $this->createPatient(['heating_type_id' => $old_heating_type->id()]);
        $this->swapRepository(HeatingTypesRepositoryInterface::class, [$old_heating_type, $new_heating_type]);
        $patient->heatingType = $new_heating_type;
        $this->assertNotSame($patient->heatingType, $new_heating_type);
    }

    /** @test */
    public function its_related_social_insurance_type_can_be_changed()
    {
        $old_medical_insurance = $this->makeReferenceModel(rand(), 'OSDE');
        $new_medical_insurance = $this->makeReferenceModel(rand(), 'IOMA');
        $patient = $this->createPatient(['medical_insurance_id' => $old_medical_insurance->id()]);
        $this->swapRepository(MedicalInsurancesRepositoryInterface::class, [$old_medical_insurance, $new_medical_insurance]);
        $patient->medicalInsurance = $new_medical_insurance;
        $this->assertNotSame($patient->medicalInsurance, $new_medical_insurance);
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
