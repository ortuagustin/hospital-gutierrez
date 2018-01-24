<?php

use Database\Seeds\MedicalRecordSeeder;
use Database\Seeds\PatientSeeder;
use Database\Seeds\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(MedicalRecordSeeder::class);
    }
}
