<?php

namespace Database\Seeds;

use App\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = factory(Patient::class, rand(50, 100))->raw();
        Patient::insert($records);
    }
}
