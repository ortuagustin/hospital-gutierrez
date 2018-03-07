<?php

namespace Tests\Feature;

use App\Patient;
use Tests\Helpers\PatientTestHelper;

class PatientsCrudTestTest extends FeatureTest
{
    use PatientTestHelper;

    /** @test */
    public function authorized_users_can_delete_a_patient()
    {
        $patient = $this->createPatient();

        $this->assertEquals(Patient::count(), 1, 'There should be one Patient');

        $this->signInAdmin()
             ->deleteJson(route('patients.destroy', $patient))
             ->assertSuccessful();

        $this->assertEquals(Patient::count(), 0, 'There should not be any patient');
    }

    /** @test */
    public function unauthorized_users_can_delete_a_patient()
    {
        $patient = $this->createPatient();

        $this->assertEquals(Patient::count(), 1, 'There should be one Patient');

        $this->withExceptionHandling()
              ->delete(route('patients.destroy', $patient))
              ->assertRedirect(route('login'));

        $this->assertEquals(Patient::count(), 1, 'There should be one Patient');
    }
}
