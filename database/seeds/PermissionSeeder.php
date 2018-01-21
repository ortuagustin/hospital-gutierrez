<?php

namespace Database\Seeds;

use App\Permission;

class PermissionSeeder extends ApplicationSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->resources as $resource) {
            foreach ($this->actions as $action) {
                Permission::create(['name' => "$resource-$action"]);
            }
        }
    }
}
