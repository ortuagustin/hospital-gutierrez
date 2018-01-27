<?php

namespace Database\Seeds;

use App\MedicalRecord;
use App\Patient;
use App\User;
use Illuminate\Database\Seeder;

class MedicalRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all()->filter(function ($user, $key) {
            return $user->hasRole('Medic');
        })
        ->pluck('id')
        ->toArray();

        $patients = Patient::pluck('id');

        foreach ($patients as $patient_id) {
            foreach ($users as $user_id) {
                $records = factory(MedicalRecord::class, rand(1, 10))->raw([
                    'patient_id' => $patient_id,
                    'user_id'    => $user_id,
                ]);

                MedicalRecord::insert($records);
            }
        }
    }
}
