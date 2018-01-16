<?php

namespace Tests\Unit;

use App\Http\Requests\StoreMedicalRecordRequest;
use App\MedicalRecord;
use Tests\Helpers\PatientTestHelper;
use Tests\Helpers\UserTestHelper;
use Tests\Unit\FormRequestTestCase;

class StoreMedicalRecordRequestTest extends FormRequestTestCase
{
    use PatientTestHelper;
    use UserTestHelper;

    /** @test */
    public function it_does_not_allow_empty_fields()
    {
        $this->assertFieldsRequired();
    }

    /** @test */
    public function it_passes_validations_when_all_fields_are_correct()
    {
        $validator = $this->passingValidator();
        $this->assertValidationPasses($validator);
    }

    /** @test */
    public function it_does_not_allow_non_existent_patient_id()
    {
        $validator = $this->passingValidator(['patient_id' => 1234]);
        $this->assertValidationRuleFailed($validator, 'patient_id', 1234, 'Exists');
    }

    /** @test */
    public function it_allows_existent_patient_id()
    {
        $patient = $this->createPatient();
        $validator = $this->passingValidator(['patient_id' => $patient->id]);
        $this->assertValidationPasses($validator);
    }

    /** @test */
    public function it_doest_not_allow_non_existent_user_id()
    {
        $validator = $this->passingValidator(['user_id' => 1234]);
        $this->assertValidationRuleFailed($validator, 'user_id', 1234, 'Exists');
    }

    /** @test */
    public function it_allows_existent_user_id()
    {
        $user = $this->createUser();
        $validator = $this->passingValidator(['user_id' => $user->id]);
        $this->assertValidationPasses($validator);
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
    public function it_does_not_allow_invalid_values_on_boolean_fields()
    {
        foreach ($this->modelBooleanFields() as $each) {
            $validator = $this->passingValidator([$each => 'invalid_boolean']);
            $this->assertValidationRuleFailed($validator, $each, 'invalid_boolean', 'Boolean');
        }
    }

    /** @test */
    public function it_does_not_allow_non_numeric_values_on_numeric_fields()
    {
        foreach ($this->modelNumericFields() as $each) {
            $validator = $this->passingValidator([$each => 'not_numeric']);
            $this->assertValidationRuleFailed($validator, $each, 'not_numeric', 'Numeric');
        }
    }

    /** @test */
    public function it_does_not_allow_non_string_values_on_string_fields()
    {
        foreach ($this->modelStringFields() as $each) {
            $validator = $this->passingValidator([$each => 1]);
            $this->assertValidationRuleFailed($validator, $each, 1, 'String');
        }
    }

    /**
     * Returns boolean fields of the Medical Record Model
     * @return array
     */
    protected function modelBooleanFields()
    {
        return ['vacunas_completas', 'maduracion_acorde', 'examen_fisico_normal'];
    }

    /**
     * Returns string fields of the Medical Record Model
     * @return array
     */
    protected function modelStringFields()
    {
        return [
            'alimentacion_observaciones', 'vacunas_observaciones', 'maduracion_observaciones',
            'examen_fisico_observaciones', 'observaciones',
        ];
    }

    /**
     * Returns numeric fields of the Medical Record Model
     * @return array
     */
    protected function modelNumericFields()
    {
        return ['peso', 'talla', 'percentilo_cefalico', 'percentilo_perimetro_cefalico'];
    }

    /**
     * @inheritDoc
     */
    protected function modelUnderTestClass()
    {
        return MedicalRecord::class;
    }

    /**
     * @inheritDoc
     */
    protected function formRequestUnderTestClass()
    {
        return StoreMedicalRecordRequest::class;
    }
}
