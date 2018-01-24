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

        foreach ($patients as $id) {
            $records = factory(MedicalRecord::class, 30)->raw([
                'patient_id' => $id,
                'user_id'    => array_random($users),
            ]);

            MedicalRecord::insert($records);
        }
    }
}
