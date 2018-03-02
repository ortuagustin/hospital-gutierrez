<?php

namespace Tests\Unit;

use App\Contracts\DocTypesRepositoryInterface;
use App\Contracts\HeatingTypesRepositoryInterface;
use App\Contracts\HomeTypesRepositoryInterface;
use App\Contracts\MedicalInsurancesRepositoryInterface;
use App\Contracts\WaterTypesRepositoryInterface;
use App\Models\ReferenceModel;
use Carbon\Carbon;
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
    public function it_returns_boolean_for_field_has_refrigerator()
    {
        $he_has_refrigerator = $this->createPatient(['has_refrigerator' => '1']);
        $he_has_not_refrigerator = $this->createPatient(['has_refrigerator' => '0']);
        $this->assertTrue(is_bool($he_has_refrigerator->has_refrigerator), "has_refrigerator should be boolean type!");
        $this->assertTrue(is_bool($he_has_not_refrigerator->has_refrigerator), "has_refrigerator should be boolean type!");
        $this->assertTrue($he_has_refrigerator->has_refrigerator, "this patient should have refrigerator");
        $this->assertFalse($he_has_not_refrigerator->has_refrigerator, "this patient shouldn't have refrigerator");
    }

    /** @test */
    public function it_returns_boolean_for_field_has_pet()
    {
        $he_has_pet = $this->createPatient(['has_pet' => '1']);
        $he_has_not_pet = $this->createPatient(['has_pet' => '0']);
        $this->assertTrue(is_bool($he_has_pet->has_pet), "has_pet should be boolean type!");
        $this->assertTrue(is_bool($he_has_not_pet->has_pet), "has_pet should be boolean type!");
        $this->assertTrue($he_has_pet->has_pet, "this patient should have pet");
        $this->assertFalse($he_has_not_pet->has_pet, "this patient shouldn't have pet");
    }

    /** @test */
    public function it_returns_boolean_for_field_has_electricity()
    {
        $he_has_electricity = $this->createPatient(['has_electricity' => '1']);
        $he_has_not_electricity = $this->createPatient(['has_electricity' => '0']);
        $this->assertTrue(is_bool($he_has_electricity->has_electricity), "has_electricity should be boolean type!");
        $this->assertTrue(is_bool($he_has_not_electricity->has_electricity), "has_electricity should be boolean type!");
        $this->assertTrue($he_has_electricity->has_electricity, "this patient should have electricity");
        $this->assertFalse($he_has_not_electricity->has_electricity, "this patient shouldn't have electricity");
    }

    /** @test */
    public function it_has_birth_day_with_age()
    {
        $birth_date = Carbon::createFromDate(1992, 11, 1);
        $patient = $this->createPatient(['birth_date' => $birth_date]);
        $this->assertEquals($patient->birth_date_with_age(), '1992-11-01 (25 years)');
        $this->assertEquals($patient->birth_date_with_age, '1992-11-01 (25 years)');
    }

    /** @test */
    public function it_has_an_age()
    {
        $birth_date = Carbon::createFromDate(1992, 11, 1);
        $patient = $this->createPatient(['birth_date' => $birth_date]);
        $this->assertEquals($patient->age(), 25);
        $this->assertEquals($patient->age, 25);
    }

    /** @test */
    public function its_date_of_birth_should_be_a_carbon_datetime_instance()
    {
        $patient = $this->createPatient();
        $this->assertInstanceOf(Carbon::class, $patient->birth_date);
    }

    /** @test */
    public function its_timestamps_should_be_carbon_datetime_instances()
    {
        $patient = $this->createPatient();
        $this->assertInstanceOf(Carbon::class, $patient->created_at);
        $this->assertInstanceOf(Carbon::class, $patient->updated_at);
    }

    /** @test */
    public function its_full_name_is_its_last_name_followed_by_the_name_separated_by_comma()
    {
        $patient = $this->createPatient(['name' => 'Agustin', 'last_name' => 'Ortu']);
        $this->assertEquals('Ortu, Agustin', $patient->full_name());
        $this->assertEquals('Ortu, Agustin', $patient->full_name);
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
    public function it_has_a_document()
    {
        $doc_type = $this->makeReferenceModel(rand(), 'DNI');
        $this->swapRepository(DocTypesRepositoryInterface::class, [$doc_type]);
        $patient = $this->createPatient(['dni' => '37058719', 'doc_type_id' => $doc_type->id()]);
        $this->assertEquals('37058719 (DNI)', $patient->document());
        $this->assertEquals('37058719 (DNI)', $patient->document);
    }

    /** @test */
    public function it_returns_related_document_type()
    {
        $model = $this->makeReferenceModel(rand(), 'DNI');
        $this->swapRepository(DocTypesRepositoryInterface::class, [$model]);
        $patient = $this->createPatient(['doc_type_id' => $model->id()]);
        $this->assertNotNull($patient->docType);
        $this->assertInstanceOf(ReferenceModel::class, $patient->docType);
    }

    /** @test */
    public function it_returns_related_home_type()
    {
        $model = $this->makeReferenceModel(rand(), 'Flat');
        $this->swapRepository(HomeTypesRepositoryInterface::class, [$model]);
        $patient = $this->createPatient(['home_type_id' => $model->id()]);
        $this->assertNotNull($patient->homeType);
        $this->assertInstanceOf(ReferenceModel::class, $patient->homeType);
    }

    /** @test */
    public function it_returns_related_water_type()
    {
        $model = $this->makeReferenceModel(rand(), 'Water Well');
        $this->swapRepository(WaterTypesRepositoryInterface::class, [$model]);
        $patient = $this->createPatient(['water_type_id' => $model->id()]);
        $this->assertNotNull($patient->waterType);
        $this->assertInstanceOf(ReferenceModel::class, $patient->waterType);
    }

    /** @test */
    public function it_returns_related_heating_type()
    {
        $model = $this->makeReferenceModel(rand(), 'Electrical');
        $this->swapRepository(HeatingTypesRepositoryInterface::class, [$model]);
        $patient = $this->createPatient(['heating_type_id' => $model->id()]);
        $this->assertNotNull($patient->heatingType);
        $this->assertInstanceOf(ReferenceModel::class, $patient->heatingType);
    }

    /** @test */
    public function it_returns_related_medical_insurance_type()
    {
        $model = $this->makeReferenceModel(rand(), 'IOMA');
        $this->swapRepository(MedicalInsurancesRepositoryInterface::class, [$model]);
        $patient = $this->createPatient(['medical_insurance_id' => $model->id()]);
        $this->assertNotNull($patient->medicalInsurance);
        $this->assertInstanceOf(ReferenceModel::class, $patient->medicalInsurance);
    }

    /** @test */
    public function its_related_document_type_can_be_changed()
    {
        $old_doc_type = $this->makeReferenceModel(10, 'DNI');
        $new_doc_type = $this->makeReferenceModel(20, 'LC');
        $patient = $this->createPatient(['doc_type_id' => $old_doc_type->id()]);
        $this->swapRepository(DocTypesRepositoryInterface::class, [$old_doc_type, $new_doc_type]);
        $patient->docType = $new_doc_type;
        $this->assertSame($patient->docType, $new_doc_type);
    }

    /** @test */
    public function its_related_home_type_can_be_changed()
    {
        $old_home_type = $this->makeReferenceModel(10, 'Flat');
        $new_home_type = $this->makeReferenceModel(20, 'House');
        $patient = $this->createPatient(['home_type_id' => $old_home_type->id()]);
        $this->swapRepository(HomeTypesRepositoryInterface::class, [$old_home_type, $new_home_type]);
        $patient->homeType = $new_home_type;
        $this->assertSame($patient->homeType, $new_home_type);
    }

    /** @test */
    public function its_related_water_type_can_be_changed()
    {
        $old_water_type = $this->makeReferenceModel(10, 'Water Well');
        $new_water_type = $this->makeReferenceModel(20, 'Some Water Provisioning System');
        $patient = $this->createPatient(['doc_type_id' => $old_water_type->id()]);
        $this->swapRepository(WaterTypesRepositoryInterface::class, [$old_water_type, $new_water_type]);
        $patient->waterType = $new_water_type;
        $this->assertSame($patient->waterType, $new_water_type);
    }

    /** @test */
    public function its_related_heating_type_can_be_changed()
    {
        $old_heating_type = $this->makeReferenceModel(10, 'Electrical');
        $new_heating_type = $this->makeReferenceModel(20, 'Gas');
        $patient = $this->createPatient(['heating_type_id' => $old_heating_type->id()]);
        $this->swapRepository(HeatingTypesRepositoryInterface::class, [$old_heating_type, $new_heating_type]);
        $patient->heatingType = $new_heating_type;
        $this->assertSame($patient->heatingType, $new_heating_type);
    }

    /** @test */
    public function its_related_medical_insurance_type_can_be_changed()
    {
        $old_medical_insurance = $this->makeReferenceModel(10, 'OSDE');
        $new_medical_insurance = $this->makeReferenceModel(20, 'IOMA');
        $patient = $this->createPatient(['medical_insurance_id' => $old_medical_insurance->id()]);
        $this->swapRepository(MedicalInsurancesRepositoryInterface::class, [$old_medical_insurance, $new_medical_insurance]);
        $patient->medicalInsurance = $new_medical_insurance;
        $this->assertSame($patient->medicalInsurance, $new_medical_insurance);
    }

    /** @test */
    public function it_returns_searchable_attributes()
    {
        $this->swapRepository(MedicalInsurancesRepositoryInterface::class, [$this->makeReferenceModel(1, 'IOMA')]);
        $this->swapRepository(DocTypesRepositoryInterface::class, [$this->makeReferenceModel(1, 'DNI')]);
        $this->swapRepository(HomeTypesRepositoryInterface::class, [$this->makeReferenceModel(1, 'Flat')]);
        $this->swapRepository(WaterTypesRepositoryInterface::class, [$this->makeReferenceModel(1, 'Water Well')]);
        $this->swapRepository(HeatingTypesRepositoryInterface::class, [$this->makeReferenceModel(1, 'Electrical')]);

        $patient = $this->createPatient([
            'doc_type_id'            => 1,
            'home_type_id'           => 1,
            'water_type_id'          => 1,
            'heating_type_id'        => 1,
            'medical_insurance_id'   => 1,
        ]);

        $expected = [
            'id'                => $patient->id,
            'full_name'         => $patient->full_name,
            'dni'               => $patient->dni,
            'gender'            => $patient->gender,
            'age'               => $patient->age,
            'path'              => $patient->path(),
            'doc_type'          => 'DNI',
            'home_type'         => 'Flat',
            'water_type'        => 'Water Well',
            'heating_type'      => 'Electrical',
            'medical_insurance' => 'IOMA',
        ];

        $this->assertEquals($expected, $patient->toSearchableArray());
    }

    /** @test */
    public function it_returns_non_absoulte_url_path()
    {
        $patient = $this->createPatient(['id' => 1]);
        $this->assertEquals('/patients/1', $patient->path());
    }
}
