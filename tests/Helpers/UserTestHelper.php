<?php

namespace Tests\Helpers;

use App\Role;
use App\User;

/**
 * Add convenient methods to make it easier to work with the User Model in tests
 */
trait UserTestHelper
{
    /**
     * Saves a new User to the database and returns it
     * @param array $overrides
     * @return User
     */
    protected function createUser(array $overrides = [])
    {
        return factory(User::class)->create($overrides);
    }

    /**
     * Saves a new User with Admin Role to the database and returns it
     * @param array $overrides
     * @return User
     */
    protected function createAdminUser(array $overrides = [])
    {
        $user = $this->createUser($overrides);
        $user->roles()->attach(Role::firstOrCreate(['name' => 'Admin']));

        return $user;
    }
}
