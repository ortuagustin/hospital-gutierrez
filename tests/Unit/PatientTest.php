<?php

namespace Tests\Unit;

use App\Contracts\DocTypesRepositoryInterface;
use App\Contracts\HeatingTypesRepositoryInterface;
use App\Contracts\HomeTypesRepositoryInterface;
use App\Contracts\MedicalInsurancesRepositoryInterface;
use App\Contracts\WaterTypesRepositoryInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\Helpers\FakeReferenceDataTestHelper;
use Tests\Helpers\MedicalRecordTestHelper;
use Tests\Helpers\PatientTestHelper;
use Tests\Unit\TestCase;

class PatientTest extends TestCase
{
    use PatientTestHelper;
    use MedicalRecordTestHelper;
    use FakeReferenceDataTestHelper;

    /** @test */
    public function its_full_name_is_its_last_name_followed_by_the_name_separated_by_comma()
    {
        $patient = $this->createPatient(['name' => 'Agustin', 'last_name' => 'Ortu']);
        $this->assertEquals('Ortu, Agustin', $patient->full_name());
    }

    /** @test */
    public function it_has_many_relation_with_medical_record()
    {
        $patient = $this->createPatient();
        $this->assertNotNull($patient->medicalRecords());
        $this->assertInstanceOf(HasMany::class, $patient->medicalRecords());
    }

    /** @test */
    public function it_has_empty_medical_record_collection_when_created()
    {
        $patient = $this->createPatient();
        $this->assertEquals(0, $patient->medicalRecords()->count());
    }

    /** @test */
    public function it_can_add_many_medical_records()
    {
        $patient = $this->createPatient();
        $first_medical_record = $this->createMedicalRecord();
        $second_medical_record = $this->createMedicalRecord();

        $patient->medicalRecords()->save($first_medical_record);
        $this->assertEquals(1, $patient->medicalRecords()->count());

        $patient->medicalRecords()->save($second_medical_record);
        $this->assertEquals(2, $patient->medicalRecords()->count());
    }

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
    public function it_returns_related_water_type()
    {
        $model = $this->makeReferenceModel(rand(), 'Water Well');
        $this->swapRepository(WaterTypesRepositoryInterface::class, [$model]);
        $patient = $this->createPatient(['water_type_id' => $model->id()]);
        $this->assertNotNull($patient->waterType);
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
    public function it_returns_related_medical_insurance_type()
    {
        $model = $this->makeReferenceModel(rand(), 'IOMA');
        $this->swapRepository(MedicalInsurancesRepositoryInterface::class, [$model]);
        $patient = $this->createPatient(['medical_insurance_id' => $model->id()]);
        $this->assertNotNull($patient->medicalInsurance);
    }

    /** @test */
    public function its_related_document_type_can_be_changed()
    {
        $old_doc_type = $this->makeReferenceModel(10, 'DNI');
        $new_doc_type = $this->makeReferenceModel(20, 'LC');
        $patient = $this->createPatient(['doc_type_id' => $old_doc_type->id()]);
        $this->swapRepository(DocTypesRepositoryInterface::class, [$old_doc_type, $new_doc_type]);
        $patient->docType = $new_doc_type;
        $this->assertNotSame($patient->docType, $new_doc_type);
    }

    /** @test */
    public function its_related_home_type_can_be_changed()
    {
        $old_home_type = $this->makeReferenceModel(10, 'Flat');
        $new_home_type = $this->makeReferenceModel(20, 'House');
        $patient = $this->createPatient(['home_type_id' => $old_home_type->id()]);
        $this->swapRepository(HomeTypesRepositoryInterface::class, [$old_home_type, $new_home_type]);
        $patient->homeType = $new_home_type;
        $this->assertNotSame($patient->homeType, $new_home_type);
    }

    /** @test */
    public function its_related_water_type_can_be_changed()
    {
        $old_water_type = $this->makeReferenceModel(10, 'Water Well');
        $new_water_type = $this->makeReferenceModel(20, 'Some Water Provisioning System');
        $patient = $this->createPatient(['doc_type_id' => $old_water_type->id()]);
        $this->swapRepository(WaterTypesRepositoryInterface::class, [$old_water_type, $new_water_type]);
        $patient->docType = $new_water_type;
        $this->assertNotSame($patient->waterType, $new_water_type);
    }

    /** @test */
    public function its_related_heating_type_can_be_changed()
    {
        $old_heating_type = $this->makeReferenceModel(10, 'Electrical');
        $new_heating_type = $this->makeReferenceModel(20, 'Gas');
        $patient = $this->createPatient(['heating_type_id' => $old_heating_type->id()]);
        $this->swapRepository(HeatingTypesRepositoryInterface::class, [$old_heating_type, $new_heating_type]);
        $patient->heatingType = $new_heating_type;
        $this->assertNotSame($patient->heatingType, $new_heating_type);
    }

    /** @test */
    public function its_related_medical_insurance_type_can_be_changed()
    {
        $old_medical_insurance = $this->makeReferenceModel(10, 'OSDE');
        $new_medical_insurance = $this->makeReferenceModel(20, 'IOMA');
        $patient = $this->createPatient(['medical_insurance_id' => $old_medical_insurance->id()]);
        $this->swapRepository(MedicalInsurancesRepositoryInterface::class, [$old_medical_insurance, $new_medical_insurance]);
        $patient->medicalInsurance = $new_medical_insurance;
        $this->assertNotSame($patient->medicalInsurance, $new_medical_insurance);
    }
}
