<?php

namespace Tests\Feature;

use App\MedicalRecord;
use Tests\Helpers\MedicalRecordTestHelper;

class MedicalRecordsCrudTest extends FeatureTest
{
    use MedicalRecordTestHelper;

    /** @test */
    public function authorized_users_can_delete_medical_records()
    {
        $record = $this->createMedicalRecord();

        $this->assertEquals(MedicalRecord::count(), 1, 'There should be one Record');

        $this->signInAdmin()
             ->deleteJson(route('patients.medical_records.destroy', [$record->patient, $record]))
             ->assertSuccessful();

        $this->assertEquals(MedicalRecord::count(), 0, 'There should not be any Record');
    }

    /** @test */
    public function unauthorized_users_cannot_delete_medical_records()
    {
        $record = $this->createMedicalRecord();

        $this->assertEquals(MedicalRecord::count(), 1, 'There should be one Record');

        $this->withExceptionHandling()
              ->delete(route('patients.medical_records.destroy', [$record->patient, $record]))
              ->assertRedirect(route('login'));

        $this->assertEquals(MedicalRecord::count(), 1, 'There should be one Record');
    }
}
