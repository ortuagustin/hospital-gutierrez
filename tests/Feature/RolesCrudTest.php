<?php

namespace Tests\Feature;

use App\Role;
use Tests\Helpers\RoleTestHelper;

class RolesCrudTest extends FeatureTest
{
    use RoleTestHelper;

    /** @test */
    public function authorized_users_can_delete_roles()
    {
        $role = $this->createRole('Admin');

        $this->assertEquals(Role::count(), 1, 'There should be one Role');

        $this->signInAdmin()
             ->deleteJson(route('roles.destroy', $role))
             ->assertSuccessful();

        $this->assertEquals(Role::count(), 0, 'There should not be any Role');
    }

    /** @test */
    public function unauthorized_users_cannot_delete_roles()
    {
        $role = $this->createRole('Test');

        $this->assertEquals(Role::count(), 1, 'There should be one Role');

        $this->withExceptionHandling()
              ->delete(route('roles.destroy', $role))
              ->assertRedirect(route('login'));

        $this->assertEquals(Role::count(), 1, 'There should be one Role');
    }
}
