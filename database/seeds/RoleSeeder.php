<?php

namespace Database\Seeds;

use App\Role;

class RoleSeeder extends ApplicationSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Guest']);
        Role::create(['name' => 'Medic']);
        Role::create(['name' => 'Recepcionist']);
    }
}
