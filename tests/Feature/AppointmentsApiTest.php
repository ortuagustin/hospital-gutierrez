<?php

namespace Tests\Feature;

use App\Appointment;
use App\Patient;
use Tests\Helpers\AppointmentTestHelper;
use Tests\Helpers\PatientTestHelper;

class AppointmentsApiTest extends FeatureTest
{
    use AppointmentTestHelper, PatientTestHelper;

    /** @test */
    public function it_returns_all_available_times_for_appointments_at_given_date()
    {
        $response = $this->getJson('/api/turnos/1-5-2018');

        $this->assertEquals(Appointment::allowed_times(), $response->json());
    }

    /** @test */
    public function it_returns_times_for_appointments_scheduled_at_given_date()
    {
        $this->createAppointmentAt(8, 0, 1, 5, 2018);
        $this->createAppointmentAt(8, 30, 1, 5, 2018);
        $this->createAppointmentAt(10, 30, 1, 5, 2018);
        $this->createAppointmentAt(10, 30, 1, 6, 2018);

        $response = $this->getJson('/api/turnos/1-5-2018');

        $expected = [
            '09:00',
            '09:30',
            '10:00',
            '11:00',
            '11:30',
            '12:00',
            '12:30',
            '13:00',
            '13:30',
            '14:00',
            '14:30',
            '15:00',
            '15:30',
            '16:00',
            '16:30',
            '17:00',
            '17:30',
            '18:00',
            '18:30',
            '19:00',
            '19:30',
            '20:00',
        ];

        $this->assertEquals($expected, $response->json());
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
            'dni'        => $patient->dni,
            'date'       => '25-10-2018 08:00',
        ]);

        $response->assertSuccessful();
        $this->assertAppointmentScheduled($patient, '25-10-2018', '08:00');
    }

    /** @test */
    public function it_creates_new_appointment_2()
    {
        $patient = $this->createPatient();
        $this->assertEquals(0, Appointment::count());

        $response = $this->postJson('/api/turnos', [
            'dni'        => $patient->dni,
            'date'       => '1-1-2018 08:30',
        ]);

        $response->assertSuccessful();
        $this->assertAppointmentScheduled($patient, '1-1-2018', '08:30');
    }

    protected function assertAppointmentScheduled(Patient $patient, $date, $time)
    {
        $this->assertEquals(1, Appointment::count());
        $appointment = Appointment::first();
        $this->assertEquals($patient->id, $appointment->patient_id);
        $this->assertEquals($date, $appointment->formatted_date);
        $this->assertEquals($time, $appointment->time);
    }

    /** @test */
    public function it_returns_message_attribute_in_the_response_when_appointment_is_successfully_scheduled()
    {
        $patient = $this->createPatient(['dni' => '37058719']);

        $response = $this->postJson('/api/turnos', [
            'dni'        => $patient->dni,
            'date'       => '1-1-2018 08:30',
        ]);

        $this->assertEquals('Te confirmamos el turno nro 1 para 37058719, a las 08:30 del dia 1-1-2018', $response->json()['message']);
    }
}
