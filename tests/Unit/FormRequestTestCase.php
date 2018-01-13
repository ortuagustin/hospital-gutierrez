<?php

namespace Tests\Unit;

use Illuminate\Routing\Redirector;
use Illuminate\Validation\Validator;
use Tests\Unit\TestCase;

/**
 * Base TestCase for FormRequest objects
 */
abstract class FormRequestTestCase extends TestCase
{
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
     * Asserts that the validator fails when the given fields are empty
     * @param array $fields if empty array given, will check all fields
     * @return $this
     */
    protected function assertFieldsRequired(array $fields = [])
    {
        $fields = empty($fields) ? $this->modelFields() : $fields;
        foreach ($fields as $field => $value) {
            $this->assertFieldRequired($field);
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
     * @param mixed $value
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
     * Returns a validator for the FormRequest
     * @param array $input
     * @return Validator
     */
    protected function validator(array $input = [])
    {
        return validator($input, $this->validationRules());
    }

    /**
     * Returns a validator for the FormRequest that should pass by default,
     * unless user supplies custom overriden fields
     * This allows to test scenarios where the validation should fail for
     * a controlled set of fields
     * @param array $overrides
     * @return Validator
     */
    protected function passingValidator(array $overrides = [])
    {
        return $this->validator($this->modelFields($overrides));
    }

    /**
     * Returns the validation validationRules for the FormRequest
     * @return array
     */
    protected function validationRules()
    {
        return $this->createFormRequest()->rules();
    }

    /**
     * Saves a new Model that the FormRequest handles to the database and returns it
     * @param array $overrides
     * @return Illuminate\Database\Eloquent\Model
     */
    protected function createModel(array $overrides = [])
    {
        return $this->modelFactory()->create($overrides);
    }

    /**
     * Returns the class of the Eloquent Model that is beign tested
     */
    abstract protected function modelUnderTestClass();

    /**
     * Returns the class of the FormRequest that is beign tested
     */
    abstract protected function formRequestUnderTestClass();

    /**
     * Creates an instance of formRequestUnderTestClass
     * @param array $input
     * @return FormRequest
     */
    protected function createFormRequest(array $input = [])
    {
        $formRequestClass = $this->formRequestUnderTestClass();
        $request = new $formRequestClass();
        $request->setContainer($this->app);
        $request->setRedirector(app(Redirector::class));
        $request->replace($input);

        return $request;
    }

    /**
     * Returns a Model Factory for the Model
     * @return Illuminate\Database\Eloquent\Factory
     */
    protected function modelFactory()
    {
        return factory($this->modelUnderTestClass());
    }

    /**
     * Returns an associative array with the fields of the Model
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
