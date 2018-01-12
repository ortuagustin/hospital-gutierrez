<?php

namespace Tests\Unit;

use App\Http\Requests\StorePatientRequest;
use App\Patient;
use Illuminate\Validation\Validator;
use Tests\Unit\TestCase;

/**
 * Tests the StorePatientRequest FormRequest class
 */
class StorePatientRequestTest extends TestCase
{
    /** @test */
    public function it_does_not_allow_empty_fields()
    {
        foreach ($this->modelFields() as $field => $value) {
            $this->assertFieldRequired($field);
        }
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
    public function it_does_allows_all_validBooleanValues_on_boolean_fields()
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
        foreach ($this->modelIdfields() as $each) {
            $validator = $this->passingValidator([$each => 'any-string']);
            $this->assertValidationRuleFailed($validator, $each, 'any-string', 'Numeric');
        }
    }

    /** @test */
    public function it_does_allows_numeric_values_for_id_fields()
    {
        foreach ($this->modelIdfields() as $each) {
            $validator = $this->passingValidator([$each => rand(1, 10)]);
            $this->assertValidationPasses($validator);
        }
    }

    /** @test */
    public function it_does_not_allow_duplicate_dni()
    {
        $patient = $this->createPatient(['dni' => '37058719']);
        $validator = $this->passingValidator(['dni' => $patient->dni]);
        $this->assertValidationRuleFailed($validator, 'dni', $patient->dni, 'Unique');
    }

    /** @test */
    public function it_does_not_allow_addresses_that_are_not_string()
    {
        $invalidAdresses = [1, true, false, $this->createPatient()];
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
     * Asserts that the validator fails when the given field contains special characters
     * @param string $field
     * @return $this
     */
    protected function assertFieldDoesNotAllowSpecialChars($field)
    {
        foreach ($this->blacklistedCharacters() as $each) {
            $each = "test_this.value1234{$each}";
            $validator = $this->validator([$field => $each]);
            $this->assertValidationRuleFailed($validator, $field, $each, 'Regex');
        }

        return $this;
    }

    /**
     * Asserts that the validator fails when the given field is empty
     * @param string $field
     * @return $this
     */
    protected function assertFieldRequired($field)
    {
        $validator = $this->validator([$field => '']);
        $this->assertValidationRuleFailed($validator, $field, '', 'Required');

        return $this;
    }

    /**
     * Runs the given validator and expects that all the validation rules passes
     * @param Validator $validator
     * @return $this
     */
    protected function assertValidationPasses(Validator $validator)
    {
        $success = ! $validator->fails();
        $this->assertTrue($success, $this->getValidatorAssertMessage($validator, 'Expected the validator to pass, but it failed'));

        return $this;
    }

    /**
     * Returns a descriptive message with all the validations information from the given
     * validator, such as: fields that failed, the rules that every field failed, error messages, and field values
     * @param Validator $validator
     * @param string $message
     * @return string
     */
    protected function getValidatorAssertMessage(Validator $validator, $message = '')
    {
        $failed = ['$failed' => $validator->failed()];
        $messages = ['$messages' => $validator->messages()];
        $values = ['$values' => $validator->attributes()];

        return $message . PHP_EOL . json_encode(($failed + $messages + $values), JSON_PRETTY_PRINT);
    }

    /**
     * Runs the given Validator and checks that it fails;
     * also, check that the given rule is in the failed array of the Validator
     * @param Validator $validator
     * @param string $value
     * @param string $field
     * @param string $rule
     * @return $this
     */
    protected function assertValidationRuleFailed(Validator $validator, $field, $value, $rule)
    {
        $this->assertTrue($validator->fails(), "Expected the validator to fail for field {$field} with value $value against rule {$rule}, but it passed");
        $failed = $validator->failed();
        $this->assertArrayHasKey($field, $failed, $this->getValidatorAssertMessage($validator, "Expected failed fields to contain {$field}"));
        $this->assertArrayHasKey($rule, $failed[$field], $this->getValidatorAssertMessage($validator, "Expected field {$field} failed rules to contain rule {$rule}"));

        return $this;
    }

    /**
     * Returns a validator for the StorePatientRequest
     * @param array $input
     * @return Validator
     */
    protected function validator(array $input = [])
    {
        return validator($input, $this->validationRules());
    }

    /**
     * Returns a validator for the StorePatientRequest that will pass by default, unless user custom overriden fields
     * @param array $overrides
     * @return Validator
     */
    protected function passingValidator(array $overrides = [])
    {
        return $this->validator($this->modelFields($overrides));
    }

    /**
     * Returns the validation validationRules for the StorePatientRequest
     * @return array
     */
    protected function validationRules()
    {
        return (new StorePatientRequest())->rules();
    }

    /**
     * Saves a new Patient Model to the database and returns it
     * @param array $overrides
     * @return Patient
     */
    protected function createPatient(array $overrides = [])
    {
        return $this->modelFactory()->create($overrides);
    }

    /**
     * Returns a Model Factory for the Patient Model
     * @return Illuminate\Database\Eloquent\Factory
     */
    protected function modelFactory()
    {
        return factory(Patient::class);
    }

    /**
     * Returns an associative array with the fields of the Patient Model
     * The array will contain the field name as the key, and random data as the value
     * You can override the values of a field passing an associative array, ie ['name' => 'your-value', 'last_name', => 'other-value', ...]
     * @param array $overrides
     * @return array
     */
    protected function modelFields(array $overrides = [])
    {
        return $this->modelFactory()->raw($overrides);
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
     * Returns an array with every boolean value that is considered valid
     * @return array
     */
    protected function validBooleanValues()
    {
        return [true, false, 1, 0, '1', '0'];
    }

    /**
     * Returns an array with some characters that are considered 'special' and thus,
     * they are blacklisted for some fields like names
     * @return array
     */
    protected function blacklistedCharacters()
    {
        return ['@', '#', '|', '¬'];
    }
}
