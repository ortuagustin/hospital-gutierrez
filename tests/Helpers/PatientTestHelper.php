<?php

namespace Tests\Helpers;

use App\Patient;

/**
 * Add convenient methods to make it easier to work with the Patient Model in tests
 */
trait PatientTestHelper
{
    /**
     * Saves a new Patient to the database and returns it
     * @param array $overrides
     *
     * @return Patient
     */
    protected function createPatient(array $overrides = [])
    {
        return factory(Patient::class)->create($overrides);
    }

    /**
     * Saves a collection of new Patients to the database and returns it
     * @param int $amount
     * @param array $overrides
     *
     * @return Illuminate\Support\Collection
     */
    protected function createPatients($amount = 2, array $overrides = [])
    {
        return factory(Patient::class, $amount)->create($overrides);
    }
}
