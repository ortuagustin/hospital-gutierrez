<?php

namespace Tests\Unit;

use App\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use Tests\Unit\FormRequestTestCase;
use Tests\Unit\Helpers\AppointmentTestHelper;

/**
 * Tests the StoreAppointmentRequest FormRequest class
 */
class StoreAppointmentRequestTest extends FormRequestTestCase
{
    use AppointmentTestHelper;

    /** @test */
    public function it_does_not_allow_empty_fields()
    {
        $this->assertFieldsRequired();
    }

    /** @test */
    public function it_doest_not_allow_non_existent_patient_id()
    {
        $validator = $this->validator(['patient_id' => 1234]);
        $this->assertValidationRuleFailed($validator, 'patient_id', 1234, 'Exists');
    }

    /** @test */
    public function it_allows_existent_patient_id()
    {
        $patient = $this->createPatient();
        $validator = $this->validator(['patient_id' => $patient->id]);
        $this->assertValidationRuleFailed($validator, 'patient_id', $patient->id, 'Exists');
    }

    /** @test */
    public function it_does_not_allow_incorrectly_formatted_date()
    {
        // TODO: write this test
        $this->markTestIncomplete();
    }

    /** @test */
    public function it_does_not_allow_past_date()
    {
        // TODO: write this test
        $this->markTestIncomplete();
    }

    /** @test */
    public function it_does_not_allow_incorrectly_formatted_time()
    {
        // TODO: write this test
        $this->markTestIncomplete();
    }

    /** @test */
    public function it_prevents_duplicated_appointments()
    {
        $appointment = $this->createAppointment();
        $validator = $this->passingValidator(['date' => $appointment->date]);

        $this->assertValidationRuleFailed($validator, 'date', $appointment->date->toDateString(), 'Unique');
    }

    /** @test */
    public function it_does_not_allow_out_of_range_time()
    {
        // TODO: write this test
        $this->markTestIncomplete();
    }

    /** @test */
    public function it_allows_correctly_formatted_date()
    {
        // TODO: write this test
        $this->markTestIncomplete();
    }

    /** @test */
    public function it_allows_correctly_formatted_time()
    {
        // TODO: write this test
        $this->markTestIncomplete();
    }

    /**
     * @inheritDoc
     */
    protected function modelUnderTestClass()
    {
        return Appointment::class;
    }

    /**
     * @inheritDoc
     */
    protected function formRequestUnderTestClass()
    {
        return StoreAppointmentRequest::class;
    }
}
