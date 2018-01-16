<?php

namespace Tests\Helpers;

use App\Role;

/**
 * Add convenient methods to make it easier to work with the Role Model in tests
 */
trait RoleTestHelper
{
    /**
     * Saves a new Role to the database and returns it
     * @param string $name
     * @return Role
     */
    protected function createRole($name)
    {
        return Role::create(['name' => $name]);
    }
}
