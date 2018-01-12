<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\Helpers\AppointmentTestHelper;
use Tests\Helpers\PatientTestHelper;
use Tests\Unit\TestCase;

class AppointmentTest extends TestCase
{
    use AppointmentTestHelper;
    use PatientTestHelper;

    /** @test */
    public function it_returns_carbon_date()
    {
        $appointment = $this->createAppointment();
        $this->assertInstanceOf(Carbon::class, $appointment->date);
    }

    /** @test */
    public function it_returns_time_string()
    {
        $appointment = $this->createAppointment();
        $this->assertInternalType('string', $appointment->time, "Got a " . gettype($appointment->time) . " instead of a string");
    }

    /** @test */
    public function it_stores_expected_date()
    {
        $dateTime = Carbon::now();
        $appointment = $this->createAppointment(['date' => $dateTime]);
        $this->assertInstanceOf(Carbon::class, $appointment->date);
        $this->assertEquals($dateTime, $appointment->date);
    }

    /** @test */
    public function it_stores_expected_time()
    {
        $time = '16:30:00';
        $dateTime = Carbon::createFromTime(16, 30, 0);
        $appointment = $this->createAppointment(['date' => $dateTime]);
        $this->assertEquals($time, $appointment->time);
    }

    /** @test */
    public function it_belongs_to_a_patient()
    {
        $patient = $this->createPatient();
        $appointment = $this->createAppointment(['patient_id' => $patient->id]);
        $this->assertEquals($patient->id, $appointment->patient->id);
    }

    /** @test */
    public function its_related_patient_can_be_changed()
    {
        $originalPatient = $this->createPatient();
        $appointment = $this->createAppointment(['patient_id' => $originalPatient->id]);
        $anotherPatient = $this->createPatient();
        $appointment->patient = $anotherPatient;
        $this->assertNotEquals($originalPatient->id, $appointment->patient->id);
        $this->assertEquals($anotherPatient->id, $appointment->patient->id);
    }
}
