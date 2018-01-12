<?php

namespace Tests\Unit;

use App\Http\Requests\StorePatientRequest;
use App\Patient;
use Tests\Unit\FormRequestTestCase;

/**
 * Tests the StorePatientRequest FormRequest class
 */
class StorePatientRequestTest extends FormRequestTestCase
{
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
    public function it_does_allows_all_valid_bolean_values_on_boolean_fields()
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
    public function it_does_allows_numeric_values_for_id_fields()
    {
        foreach ($this->modelIdFields() as $each) {
            $validator = $this->passingValidator([$each => rand(1, 10)]);
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
        // TODO: write this test
        $this->markTestIncomplete();
    }

    /** @test */
    public function it_does_not_allow_non_existent_home_type_id()
    {
        // TODO: write this test
        $this->markTestIncomplete();
    }

    /** @test */
    public function it_does_not_allow_non_existent_heating_type_id()
    {
        // TODO: write this test
        $this->markTestIncomplete();
    }

    /** @test */
    public function it_does_not_allow_non_existent_water_type_id()
    {
        // TODO: write this test
        $this->markTestIncomplete();
    }

    /** @test */
    public function it_does_not_allow_non_existent_medical_insurance_id()
    {
        // TODO: write this test
        $this->markTestIncomplete();
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
