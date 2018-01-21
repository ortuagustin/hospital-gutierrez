<?php

namespace Database\Seeds;

use App\Patient;

class PatientSeeder extends ApplicationSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Patient::class, 50)->create();
    }
}
