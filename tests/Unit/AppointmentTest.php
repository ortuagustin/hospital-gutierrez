<?php

namespace Tests\Unit;

use App\Appointment;

use Carbon\Carbon;
use Tests\Helpers\AppointmentTestHelper;
use Tests\Helpers\PatientTestHelper;

class AppointmentTest extends TestCase
{
    use AppointmentTestHelper;
    use PatientTestHelper;

    /** @test */
    public function it_returns_allowed_times()
    {
        $allowed_times = [
            '08:00:00',
            '08:30:00',
            '09:00:00',
            '09:30:00',
            '10:00:00',
            '10:30:00',
            '11:00:00',
            '11:30:00',
            '12:00:00',
            '12:30:00',
            '13:00:00',
            '13:30:00',
            '14:00:00',
            '14:30:00',
            '15:00:00',
            '15:30:00',
            '16:00:00',
            '16:30:00',
            '17:00:00',
            '17:30:00',
            '18:00:00',
            '18:30:00',
            '19:00:00',
            '19:30:00',
            '20:00:00',
        ];

        $this->assertEquals($allowed_times, Appointment::allowed_times());
    }

    /** @test */
    public function it_returns_true_when_validating_valid_time()
    {
        $this->assertTrue(Appointment::is_allowed_time(Carbon::create(2018, 1, 1, 8)));
        $this->assertTrue(Appointment::is_allowed_time(Carbon::create(2018, 1, 1, 8, 30)));
        $this->assertTrue(Appointment::is_allowed_time(Carbon::create(2018, 1, 1, 19, 30)));
        $this->assertTrue(Appointment::is_allowed_time(Carbon::create(2018, 1, 1, 20)));
    }

    /** @test */
    public function it_returns_false_when_validating_invalid_time()
    {
        $this->assertFalse(Appointment::is_allowed_time(Carbon::create(2018, 1, 1, 6)));
        $this->assertFalse(Appointment::is_allowed_time(Carbon::create(2018, 1, 1, 6, 30)));
        $this->assertFalse(Appointment::is_allowed_time(Carbon::create(2018, 1, 1, 7)));
        $this->assertFalse(Appointment::is_allowed_time(Carbon::create(2018, 1, 1, 7, 30)));
        $this->assertFalse(Appointment::is_allowed_time(Carbon::create(2018, 1, 1, 20, 30)));
        $this->assertFalse(Appointment::is_allowed_time(Carbon::create(2018, 1, 1, 21)));
        $this->assertFalse(Appointment::is_allowed_time(Carbon::create(2018, 1, 1, 22)));
    }

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
