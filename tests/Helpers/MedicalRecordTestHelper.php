<?php

namespace Tests\Helpers;

use App\MedicalRecord;

/**
 * Add convenient methods to make it easier to work with the MedicalRecord Model in tests
 */
trait MedicalRecordTestHelper
{
    /**
     * Saves a new MedicalRecord to the database and returns it
     * @param array $overrides
     *
     * @return MedicalRecord
     */
    protected function createMedicalRecord(array $overrides = [])
    {
        return factory(MedicalRecord::class)->create($overrides);
    }
}
