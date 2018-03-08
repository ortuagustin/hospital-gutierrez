<?php

namespace Tests\Unit;

use App\Appointment;
use App\Http\Requests\StoreAppointmentRequest;

use Carbon\Carbon;
use Tests\Helpers\AppointmentTestHelper;
use Tests\Helpers\PatientTestHelper;

/**
 * Tests the StoreAppointmentRequest FormRequest class
 */
class StoreAppointmentRequestTest extends FormRequestTestCase
{
    use AppointmentTestHelper, PatientTestHelper;

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
    public function it_doest_not_allow_non_existent_patient_id()
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
    public function it_prevents_duplicated_appointments()
    {
        $appointment = $this->createAppointment();
        $validator = $this->passingValidator(['date' => $appointment->date]);
        $this->assertValidationRuleFailed($validator, 'date', $appointment->date->toDateString(), 'Unique');
    }

    /** @test */
    public function it_does_not_allow_out_of_range_time()
    {
        foreach ($this->invalid_times() as $date) {
            $validator = $this->passingValidator(['date' => $date]);
            $this->assertValidationRuleFailed($validator, 'date', $date, 'AppointmentTime');
        }
    }

    /**
     * Returns an array of Carbon dates that are considered to be invalid
     *
     * @return array
     */
    protected function invalid_times()
    {
        $times = [];
        for ($i = 0; $i <= 7; $i++) {
            $times[] = Carbon::create(2018, 1, 1, $i);
            $times[] = Carbon::create(2018, 1, 1, $i, 12);
            $times[] = Carbon::create(2018, 1, 1, $i, 47);
        }

        return $times;
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
