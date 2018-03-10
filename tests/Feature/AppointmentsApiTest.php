<?php

namespace Tests\Feature;

use App\Appointment;
use Tests\Helpers\AppointmentTestHelper;
use Tests\Helpers\PatientTestHelper;

class AppointmentsApiTest extends FeatureTest
{
    use AppointmentTestHelper, PatientTestHelper;

    /** @test */
    public function it_returns_times_for_appointments_scheduled_at_give_date()
    {
        $this->createAppointmentAt(8, 0, 1, 5, 2018);
        $this->createAppointmentAt(8, 30, 1, 5, 2018);
        $this->createAppointmentAt(10, 30, 1, 5, 2018);
        $this->createAppointmentAt(10, 30, 1, 6, 2018);

        $response = $this->getJson('/api/turnos/1-5-2018');

        $this->assertEquals(['08:00', '08:30', '10:30'], $response->json());
    }

    /** @test */
    public function it_returns_200_ok_when_date_format_is_correct()
    {
        $this->getJson('/api/turnos/1-1-2018')->assertStatus(200);
        $this->getJson('/api/turnos/1-10-2018')->assertStatus(200);
        $this->getJson('/api/turnos/10-10-2018')->assertStatus(200);
        $this->getJson('/api/turnos/10-1-2018')->assertStatus(200);
    }

    /** @test */
    public function it_returns_422_unprocessable_entity_when_date_format_is_incorrect()
    {
        $this->withExceptionHandling();
        $this->getJson('/api/turnos/2018')->assertStatus(422);
        $this->getJson('/api/turnos/01-05-2018')->assertStatus(422);
        $this->getJson('/api/turnos/01-5-2018')->assertStatus(422);
        $this->getJson('/api/turnos/1-05-2018')->assertStatus(422);
        $this->getJson('/api/turnos/1-05-18')->assertStatus(422);
        $this->getJson('/api/turnos/1-1')->assertStatus(422);
        $this->getJson('/api/turnos/1-1-1')->assertStatus(422);
        $this->getJson('/api/turnos/foo')->assertStatus(422);
    }

    /** @test */
    public function it_creates_new_appointment_1()
    {
        $patient = $this->createPatient();
        $this->assertEquals(0, Appointment::count());

        $response = $this->postJson('/api/turnos', [
            'patient_id' => $patient->id,
            'date'       => '25-10-2018 08:00',
          ]);

        $response->assertSuccessful();

        $this->assertEquals(1, Appointment::count());

        $appointment = Appointment::first();
        $this->assertEquals($patient->id, $appointment->patient_id);
        $this->assertEquals('08:00', $appointment->time);
        $this->assertEquals('25-10-2018', $appointment->formatted_date);
    }

    /** @test */
    public function it_creates_new_appointment_2()
    {
        $patient = $this->createPatient();
        $this->assertEquals(0, Appointment::count());

        $response = $this->postJson('/api/turnos', [
            'patient_id' => $patient->id,
            'date'       => '1-1-2018 08:30',
          ]);

        $response->assertSuccessful();

        $this->assertEquals(1, Appointment::count());

        $appointment = Appointment::first();
        $this->assertEquals($patient->id, $appointment->patient_id);
        $this->assertEquals('08:30', $appointment->time);
        $this->assertEquals('1-1-2018', $appointment->formatted_date);
    }
}
