<?php

namespace Tests\Helpers;

use App\Patient;

trait PatientTestHelper
{
    /**
     * Saves a new Patient to the database and returns it
     * @param array $overrides
     * @return Patient
     */
    protected function createPatient(array $overrides = [])
    {
        return factory(Patient::class)->create($overrides);
    }
}
