<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\Helpers\MedicalRecordTestHelper;
use Tests\Helpers\UserTestHelper;
use Tests\Unit\TestCase;

class MedicalRecordTest extends TestCase
{
    use MedicalRecordTestHelper;
    use UserTestHelper;

    /** @test */
    public function it_returns_carbon_date()
    {
        $medical_record = $this->createMedicalRecord();
        $this->assertInstanceOf(Carbon::class, $medical_record->fecha);
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
