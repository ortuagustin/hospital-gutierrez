<?php

namespace Tests\Helpers;

use App\Permission;

/**
 * Add convenient methods to make it easier to work with the Permission Model in tests
 */
trait PermissionTestHelper
{
    /**
     * Saves a new Permission to the database and returns it
     * @param string $name
     *
     * @return Permission
     */
    protected function createPermission($name)
    {
        return Permission::create(['name' => $name]);
    }
}
