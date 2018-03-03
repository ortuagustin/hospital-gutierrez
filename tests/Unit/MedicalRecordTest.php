<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\Helpers\MedicalRecordTestHelper;
use Tests\Helpers\PatientTestHelper;
use Tests\Helpers\UserTestHelper;

class MedicalRecordTest extends TestCase
{
    use MedicalRecordTestHelper;
    use UserTestHelper;
    use PatientTestHelper;

    /** @test */
    public function it_returns_carbon_date()
    {
        $medical_record = $this->createMedicalRecord();
        $this->assertInstanceOf(Carbon::class, $medical_record->fecha);
    }

    /** @test */
    public function it_returns_the_age_of_the_patient_when_controlled()
    {
        $birth_date = Carbon::create(1992, 11, 1);
        $control_date = Carbon::create(2000, 11, 1);

        $patient = $this->createPatient([
            'birth_date' => $birth_date,
        ]);

        $medical_record = $this->createMedicalRecord([
            'patient_id' => $patient->id,
            'fecha'      => $control_date,
        ]);

        $this->assertEquals(8, $medical_record->patient_age);
        $this->assertEquals(8, $medical_record->patient_age());
    }

    /** @test */
    public function it_returns_the_user_name_capitalized()
    {
        $admin = $this->createUser(['name' => 'admin']);
        $medical_record = $this->createMedicalRecord(['user_id' => $admin->id]);
        $this->assertEquals('Admin', $medical_record->user_name);
        $this->assertEquals('Admin', $medical_record->user_name());
    }
}
