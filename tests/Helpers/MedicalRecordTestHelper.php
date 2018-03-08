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

    /**
     * Saves a collection of new Medical Records to the database and returns it
     * @param int $amount
     * @param array $overrides
     *
     * @return Illuminate\Support\Collection
     */
    protected function createMedicalRecords($amount = 2, array $overrides = [])
    {
        return factory(MedicalRecord::class, $amount)->create($overrides);
    }
}
