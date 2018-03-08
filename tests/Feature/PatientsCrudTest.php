<?php

namespace Tests\Feature;

use App\Patient;
use Tests\Helpers\PatientTestHelper;

class PatientsCrudTestTest extends FeatureTest
{
    use PatientTestHelper;

    /** @test */
    public function authorized_users_can_delete_patients()
    {
        $patient = $this->createPatient();

        $this->assertEquals(Patient::count(), 1, 'There should be one Patient');

        $this->signInAdmin()
             ->deleteJson(route('patients.destroy', $patient))
             ->assertSuccessful();

        $this->assertEquals(Patient::count(), 0, 'There should not be any patient');
    }

    /** @test */
    public function unauthorized_users_cannot_delete_patients()
    {
        $patient = $this->createPatient();

        $this->assertEquals(Patient::count(), 1, 'There should be one Patient');

        $this->withExceptionHandling()
              ->delete(route('patients.destroy', $patient))
              ->assertRedirect(route('login'));

        $this->assertEquals(Patient::count(), 1, 'There should be one Patient');
    }

    /** @test */
    public function authorized_users_can_list_patients()
    {
        $this->createPatients(3);

        $this->assertEquals(Patient::count(), 3, 'There should be three Patients in the Database');

        $response = $this->signInAdmin()
                        ->getJson(route('patients.index'))
                        ->assertSuccessful()
                        ->json();

        $this->assertCount(3, $response['data'], 'There should be three Patients in the response');
    }

    /** @test */
    public function unauthorized_users_cannot_list_patients()
    {
        $this->withExceptionHandling()
              ->get(route('patients.index'))
              ->assertRedirect(route('login'));
    }
}
