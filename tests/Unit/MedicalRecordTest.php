<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\Helpers\MedicalRecordTestHelper;
use Tests\Unit\TestCase;

class MedicalRecordTest extends TestCase
{
    use MedicalRecordTestHelper;

    /** @test */
    public function it_returns_carbon_date()
    {
        $medical_record = $this->createMedicalRecord();
        $this->assertInstanceOf(Carbon::class, $medical_record->fecha);
    }
}
