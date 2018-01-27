<?php

namespace Tests\Unit;

use App\Contracts\DocTypesRepositoryInterface;
use App\Contracts\HeatingTypesRepositoryInterface;
use App\Contracts\HomeTypesRepositoryInterface;
use App\Contracts\MedicalInsurancesRepositoryInterface;
use App\Contracts\WaterTypesRepositoryInterface;
use App\Http\Requests\StorePatientRequest;
use App\Patient;
use Tests\Helpers\FakeReferenceDataTestHelper;

/**
 * Tests the StorePatientRequest FormRequest class
 */
class StorePatientRequestTest extends FormRequestTestCase
{
    use FakeReferenceDataTestHelper;

    /** @test */
    public function it_does_not_allow_empty_fields()
    {
        $this->assertFieldsRequired();
    }

    /** @test */
    public function it_does_not_allow_special_chars_on_name()
    {
        $this->assertFieldDoesNotAllowSpecialChars('name');
    }

    /** @test */
    public function it_does_not_allow_special_chars_on_last_name()
    {
        $this->assertFieldDoesNotAllowSpecialChars('last_name');
    }

    /** @test */
    public function it_passes_validations_when_all_fields_are_correct()
    {
        $validator = $this->passingValidator();

        $this->assertValidationPasses($validator);
    }

    /** @test */
    public function it_allows_alpha_numeric_name()
    {
        $test_names = ['Some Name', 'other.name', 'Sr. John 1st'];
        foreach ($test_names as $each) {
            $validator = $this->passingValidator(['name' => $each]);
            $this->assertValidationPasses($validator);
        }
    }

    /** @test */
    public function it_allows_all_valid_genders()
    {
        $valid_genders = ['male', 'female', 'unknown'];
        foreach ($valid_genders as $each) {
            $validator = $this->passingValidator(['gender' => $each]);
            $this->assertValidationPasses($validator);
        }
    }

    /** @test */
    public function it_does_not_allow_invalid_genders()
    {
        $invalid_genders = ['foo', '123', 'unk', 'Male', 'Female', 'Unknown'];
        foreach ($invalid_genders as $each) {
            $validator = $this->passingValidator(['gender' => $each]);
            $this->assertValidationRuleFailed($validator, 'gender', $each, 'In');
        }
    }

    /** @test */
    public function it_allows_alpha_numeric_and_dashes_in_phone()
    {
        $valid_phones = ['1234', '221 450 9878', '221-4509878', '+54 221 450 9878', '+54-221-450-9878'];
        foreach ($valid_phones as $each) {
            $validator = $this->passingValidator(['phone' => $each]);
            $this->assertValidationPasses($validator);
        }
    }

    /** @test */
    public function it_does_not_allow_invalid_phones()
    {
        $invalid_phones = ['12.34', '221@450,9878', 'aa221-4509878'];
        foreach ($invalid_phones as $each) {
            $validator = $this->passingValidator(['phone' => $each]);
            $this->assertValidationRuleFailed($validator, 'phone', $each, 'Regex');
        }
    }

    /** @test */
    public function it_does_not_allow_invalid_values_on_boolean_fields()
    {
        foreach ($this->modelBooleanFields() as $each) {
            $validator = $this->passingValidator([$each => 'invalid_boolean']);
            $this->assertValidationRuleFailed($validator, $each, 'invalid_boolean', 'Boolean');
        }
    }

    /** @test */
    public function it_allows_all_valid_bolean_values_on_boolean_fields()
    {
        foreach ($this->modelBooleanFields() as $field) {
            foreach ($this->validBooleanValues() as $value) {
                $validator = $this->passingValidator([$field => $value]);
                $this->assertValidationPasses($validator);
            }
        }
    }

    /** @test */
    public function it_does_not_allow_non_numeric_values_for_id_fields()
    {
        foreach ($this->modelIdFields() as $each) {
            $validator = $this->passingValidator([$each => 'any-string']);
            $this->assertValidationRuleFailed($validator, $each, 'any-string', 'Numeric');
        }
    }

    /** @test */
    public function it_allows_numeric_values_for_id_fields()
    {
        foreach ($this->modelIdFields() as $each) {
            $validator = $this->passingValidator([$each => 1]);
            $this->assertValidationPasses($validator);
        }
    }

    /** @test */
    public function it_does_not_allow_duplicate_dni()
    {
        $patient = $this->createModel(['dni' => '37058719']);
        $validator = $this->passingValidator(['dni' => $patient->dni]);
        $this->assertValidationRuleFailed($validator, 'dni', $patient->dni, 'Unique');
    }

    /** @test */
    public function it_does_not_allow_addresses_that_are_not_string()
    {
        $invalidAdresses = [1, true, false, $this->createModel()];
        foreach ($invalidAdresses as $each) {
            $validator = $this->passingValidator(['address' => $each]);
            $this->assertValidationRuleFailed($validator, 'address', $each, 'String');
        }
    }

    /** @test */
    public function it_stores_new_patient_in_the_database()
    {
        $input = $this->modelFields();
        $this->assertTrue($this->createFormRequest($input)->save());
        $this->assertDatabaseHas('patients', $input);
        $this->assertEquals(Patient::count(), 1);
    }

    /** @test */
    public function it_stores_updated_patient_in_the_database()
    {
        $patient = $this->createModel();
        $patient->name = 'changed the name';
        $patient->last_name = 'changed the last_name';
        $patient->phone = '123-456-7890';
        $changed_fields = $patient->toArray();
        $this->assertTrue($this->createFormRequest($changed_fields)->save());
        $this->assertDatabaseHas('patients', $changed_fields);
        $this->assertEquals(Patient::count(), 1);
    }

    /** @test */
    public function it_returns_the_saved_patient_when_saved()
    {
        $input = $this->modelFields();
        $request = $this->createFormRequest($input);
        $request->save();
        $this->assertDatabaseHas('patients', $request->patient()->toArray());
    }

    /** @test */
    public function it_raises_exception_when_calling_patient_and_it_was_not_saved()
    {
        $this->expectException(\InvalidArgumentException::class);
        $input = $this->modelFields();
        $request = $this->createFormRequest($input);
        $request->patient();
    }

    /** @test */
    public function it_does_not_allow_invalid_birth_date()
    {
        // TODO: write this test
        $this->markTestIncomplete();
    }

    /** @test */
    public function it_allows_valid_birth_date()
    {
        // TODO: write this test
        $this->markTestIncomplete();
    }

    /** @test */
    public function it_does_not_allow_non_existent_doc_type_id()
    {
        $this->injectEmptyRepository(DocTypesRepositoryInterface::class);
        $validator = $this->passingValidator(['doc_type_id' => 1234]);
        $this->assertValidationRuleFailed($validator, 'doc_type_id', 1234, 'ForeignDocType');
    }

    /** @test */
    public function it_does_not_allow_non_existent_home_type_id()
    {
        $this->injectEmptyRepository(HomeTypesRepositoryInterface::class);
        $validator = $this->passingValidator(['home_type_id' => 1234]);
        $this->assertValidationRuleFailed($validator, 'home_type_id', 1234, 'ForeignHomeType');
    }

    /** @test */
    public function it_does_not_allow_non_existent_heating_type_id()
    {
        $this->injectEmptyRepository(HeatingTypesRepositoryInterface::class);
        $validator = $this->passingValidator(['heating_type_id' => 1234]);
        $this->assertValidationRuleFailed($validator, 'heating_type_id', 1234, 'ForeignHeatingType');
    }

    /** @test */
    public function it_does_not_allow_non_existent_water_type_id()
    {
        $this->injectEmptyRepository(WaterTypesRepositoryInterface::class);
        $validator = $this->passingValidator(['water_type_id' => 1234]);
        $this->assertValidationRuleFailed($validator, 'water_type_id', 1234, 'ForeignWaterType');
    }

    /** @test */
    public function it_does_not_allow_non_existent_medical_insurance_id()
    {
        $this->injectEmptyRepository(MedicalInsurancesRepositoryInterface::class);
        $validator = $this->passingValidator(['medical_insurance_id' => 1234]);
        $this->assertValidationRuleFailed($validator, 'medical_insurance_id', 1234, 'ForeignMedicalInsurance');
    }

    /** @before */
    protected function setupReferenceDataRepositories()
    {
        $this->injectRepository(DocTypesRepositoryInterface::class, [$this->makeReferenceModel(1, 'DNI')]);
        $this->injectRepository(HomeTypesRepositoryInterface::class, [$this->makeReferenceModel(1, 'Flat')]);
        $this->injectRepository(WaterTypesRepositoryInterface::class, [$this->makeReferenceModel(1, 'Water Well')]);
        $this->injectRepository(HeatingTypesRepositoryInterface::class, [$this->makeReferenceModel(1, 'Electrical')]);
        $this->injectRepository(MedicalInsurancesRepositoryInterface::class, [$this->makeReferenceModel(1, 'IOMA')]);
    }

    /**
     * @inheritDoc
     */
    protected function passingValidator(array $overrides = [])
    {
        $reference_keys = [
          'doc_type_id',
          'home_type_id',
          'heating_type_id',
          'water_type_id',
          'medical_insurance_id',
        ];

        foreach ($reference_keys as $reference_id) {
            if (! isset($overrides[$reference_id])) {
                $overrides[$reference_id] = 1;
            }
        }

        return parent::passingValidator($overrides);
    }

    /**
     * Returns boolean fields of the Patient Model
     * @return array
     */
    protected function modelBooleanFields()
    {
        return ['has_refrigerator', 'has_electricity', 'has_pet'];
    }

    /**
     * Returns "_id" (a.k.a foreign keys) fields of the Patient Model
     * @return array
     */
    protected function modelIdFields()
    {
        return ['doc_type_id', 'home_type_id', 'heating_type_id', 'water_type_id', 'medical_insurance_id'];
    }

    /**
     * @inheritDoc
     */
    protected function modelUnderTestClass()
    {
        return Patient::class;
    }

    /**
     * @inheritDoc
     */
    protected function formRequestUnderTestClass()
    {
        return StorePatientRequest::class;
    }
}
