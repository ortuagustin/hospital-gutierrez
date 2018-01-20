<?php

use Database\Seeds\PatientSeeder;
use Database\Seeds\PermissionRoleSeeder;
use Database\Seeds\PermissionSeeder;
use Database\Seeds\RoleSeeder;
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
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        $this->call(PatientSeeder::class);
    }
}
