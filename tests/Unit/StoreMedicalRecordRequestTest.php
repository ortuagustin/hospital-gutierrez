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
        $this->assertFieldsRequired($this->observationFields());
    }

    /** @test */
    public function it_allows_null_on_observations_fields()
    {
        foreach ($this->observationFields() as $field) {
            $validator = $this->passingValidator([$field => null]);
            $this->assertValidationPasses($validator);
        }
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
    public function it_stores_new_medical_record_in_the_database()
    {
        $input = $this->modelFields();
        $this->assertTrue($this->createFormRequest($input)->save());
        $this->assertDatabaseHas('medical_records', $input);
        $this->assertEquals(MedicalRecord::count(), 1);
    }

    /** @test */
    public function it_stores_updated_medical_record_in_the_database()
    {
        $medical_record = $this->createModel();
        $medical_record->peso = 123.45;
        $medical_record->observaciones = 'bla bla bla';
        $medical_record->vacunas_completas = ! $medical_record->vacunas_completas;
        $changed_fields = $medical_record->toArray();
        $this->assertTrue($this->createFormRequest($changed_fields)->save());
        $this->assertDatabaseHas('medical_records', $changed_fields);
        $this->assertEquals(MedicalRecord::count(), 1);
    }

    /** @test */
    public function it_returns_the_medical_record_when_saved()
    {
        $input = $this->modelFields();
        $request = $this->createFormRequest($input);
        $request->save();
        $this->assertDatabaseHas('medical_records', $request->medicalRecord()->toArray());
    }

    /** @test */
    public function it_raises_exception_when_calling_medical_record_and_it_was_not_saved()
    {
        $this->expectException(\InvalidArgumentException::class);
        $input = $this->modelFields();
        $request = $this->createFormRequest($input);
        $request->medicalRecord();
    }

    /**
     * Returns boolean fields of the Medical Record Model
     * @return array
     */
    protected function modelBooleanFields()
    {
        return [
            'vacunas_completas',
            'maduracion_acorde',
            'examen_fisico_normal',
        ];
    }

    /**
     * Returns numeric fields of the Medical Record Model
     * @return array
     */
    protected function modelNumericFields()
    {
        return [
            'peso',
            'talla',
            'percentilo_cefalico',
            'percentilo_perimetro_cefalico',
        ];
    }

    /**
     * Returns observation fields of the Medical Record Model
     * @return array
     */
    protected function observationFields()
    {
        return [
            'alimentacion_observaciones',
            'vacunas_observaciones',
            'maduracion_observaciones',
            'examen_fisico_observaciones',
            'observaciones',
        ];
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
