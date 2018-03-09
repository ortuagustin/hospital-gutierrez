<?php

namespace Tests\Feature;

use App\ApplicationSetting;
use Tests\Helpers\PermissionTestHelper;
use Tests\Helpers\RoleTestHelper;
use Tests\Helpers\UserTestHelper;

class UserAuthorizationTest extends FeatureTest
{
    use RoleTestHelper, UserTestHelper, PermissionTestHelper;

    /** @test */
    public function it_has_permission_through_one_role()
    {
        $role = $this->createRole('Medic');
        $permission = $this->createPermission('create');
        $user = $this->createUser();
        $user->roles()->attach($role);
        $role->permissions()->attach($permission);
        $this->assertTrue($user->hasPermission($permission), 'It should have permission');
    }

    /** @test */
    public function it_has_many_permissions_through_one_role()
    {
        $role = $this->createRole('Medic');
        $permission_to_create = $this->createPermission('create');
        $permission_to_view = $this->createPermission('view');
        $user = $this->createUser();
        $user->roles()->attach($role);
        $role->permissions()->attach($permission_to_create);
        $role->permissions()->attach($permission_to_view);
        $this->assertTrue($user->hasPermission($permission_to_create), 'It should have permission to create');
        $this->assertTrue($user->hasPermission($permission_to_view), 'It should have permission to view');
    }

    /** @test */
    public function it_has_many_permissions_through_many_roles()
    {
        $admin_role = $this->createRole('Medic');
        $Guest_role = $this->createRole('Guest');
        $permission_to_create = $this->createPermission('create');
        $permission_to_view = $this->createPermission('view');
        $admin_role->permissions()->attach($permission_to_create);
        $Guest_role->permissions()->attach($permission_to_view);
        $user = $this->createUser();
        $user->roles()->attach($admin_role);
        $user->roles()->attach($Guest_role);
        $this->assertTrue($user->hasPermission($permission_to_create), 'It should have permission to create');
        $this->assertTrue($user->hasPermission($permission_to_view), 'It should have permission to view');
    }

    /** @test */
    public function it_does_not_have_permission_when_no_roles_are_assigned()
    {
        $role = $this->createRole('Medic');
        $permission = $this->createPermission('create');
        $user = $this->createUser();
        $role->permissions()->attach($permission);
        $this->assertTrue($user->hasNotPermission($permission), 'It should not have permission');
    }

    /** @test */
    public function it_does_not_have_permission_when_assigned_roles_misses_the_permission()
    {
        $admin_role = $this->createRole('Medic');
        $Guest_role = $this->createRole('Guest');
        $permission_to_create = $this->createPermission('create');
        $permission_to_view = $this->createPermission('view');
        $user = $this->createUser();
        $user->roles()->attach($Guest_role);
        $admin_role->permissions()->attach($permission_to_create);
        $Guest_role->permissions()->attach($permission_to_view);
        $this->assertTrue($user->hasNotPermission($permission_to_create), 'It should not have permission to create');
    }

    /** @test */
    public function it_has_permission_when_received_permission_model()
    {
        $role = $this->createRole('Medic');
        $permission = $this->createPermission('create');
        $user = $this->createUser();
        $user->roles()->attach($role);
        $role->permissions()->attach($permission);
        $this->assertTrue($user->hasPermission($permission), 'It should have permission');
    }

    /** @test */
    public function it_has_not_permission_when_received_permission_model()
    {
        $role = $this->createRole('Medic');
        $permission = $this->createPermission('create');
        $user = $this->createUser();
        $user->roles()->attach($role);
        $this->assertTrue($user->hasNotPermission($permission), 'It should not have permission');
    }

    /** @test */
    public function it_has_permission_when_received_permission_id()
    {
        $role = $this->createRole('Medic');
        $permission = $this->createPermission('create');
        $user = $this->createUser();
        $user->roles()->attach($role);
        $role->permissions()->attach($permission);
        $this->assertTrue($user->hasPermission($permission->id), 'It should have permission');
    }

    /** @test */
    public function it_has_not_permission_when_received_permission_id()
    {
        $role = $this->createRole('Medic');
        $permission = $this->createPermission('create');
        $user = $this->createUser();
        $user->roles()->attach($role);
        $this->assertTrue($user->hasNotPermission($permission->id), 'It should not have permission');
    }

    /** @test */
    public function it_has_permission_when_received_permission_name()
    {
        $role = $this->createRole('Medic');
        $permission = $this->createPermission('create');
        $user = $this->createUser();
        $user->roles()->attach($role);
        $role->permissions()->attach($permission);
        $this->assertTrue($user->hasPermission($permission->name), 'It should have permission');
    }

    /** @test */
    public function it_has_not_permission_when_received_permission_name()
    {
        $role = $this->createRole('Medic');
        $permission = $this->createPermission('create');
        $user = $this->createUser();
        $user->roles()->attach($role);
        $this->assertTrue($user->hasNotPermission($permission->name), 'It should not have permission');
    }

    /** @test */
    public function it_has_role_when_received_role_model()
    {
        $role = $this->createRole('Medic');
        $user = $this->createUser();
        $user->roles()->attach($role);
        $this->assertTrue($user->hasRole($role), 'It should have role');
    }

    /** @test */
    public function it_has_not_role_when_received_role_model()
    {
        $role = $this->createRole('Medic');
        $user = $this->createUser();
        $this->assertTrue($user->hasNotRole($role), 'It should not have Admin role');
    }

    /** @test */
    public function it_has_role_when_received_role_id()
    {
        $role = $this->createRole('Medic');
        $user = $this->createUser();
        $user->roles()->attach($role);
        $this->assertTrue($user->hasRole($role->id), 'It should have role');
    }

    /** @test */
    public function it_has_not_role_when_received_role_id()
    {
        $role = $this->createRole('Medic');
        $user = $this->createUser();
        $this->assertTrue($user->hasNotRole($role->id), "It should not have role with id  {$role->id}");
        $this->assertTrue($user->hasNotRole(1234), 'It should not have role with id 1234');
    }

    /** @test */
    public function it_has_role_when_received_role_name()
    {
        $role = $this->createRole('Medic');
        $user = $this->createUser();
        $user->roles()->attach($role);
        $this->assertTrue($user->hasRole($role->name), 'It should have role');
    }

    /** @test */
    public function it_has_not_role_when_received_role_name()
    {
        $role = $this->createRole('Medic');
        $user = $this->createUser();
        $this->assertTrue($user->hasNotRole($role->name), 'It should not have Admin role');
        $this->assertTrue($user->hasNotRole('Guest'), 'It should not have Guest role');
    }

    /** @test */
    public function it_should_be_admin_if_it_has_admin_role()
    {
        $admin_role = $this->createRole('Admin');
        $Guest_role = $this->createRole('Guest');
        $admin_user = $this->createUser();
        $admin_user->roles()->attach($admin_role);
        $admin_user->roles()->attach($Guest_role);
        $this->assertTrue($admin_user->isAdmin(), 'It should be Admin');
    }

    /** @test */
    public function it_should_not_be_admin_if_it_does_not_have_admin_role()
    {
        $admin_role = $this->createRole('Admin');
        $Guest_role = $this->createRole('Guest');
        $user = $this->createUser();
        $user->roles()->attach($Guest_role);
        $this->assertFalse($user->isAdmin(), 'It should not be Admin');
        $this->assertTrue($user->isNotAdmin(), 'It should not be Admin');
    }

    /** @test */
    public function service_is_unavailable_for_normal_users_if_on_maintenance_state()
    {
        ApplicationSetting::putOnMaintenance();

        $this->signIn();

        $this->withExceptionHandling()
             ->get('/patients')
             ->assertStatus(503);
    }

    /** @test */
    public function service_is_available_for_admins_if_on_maintenance_state()
    {
        ApplicationSetting::putOnMaintenance();

        $this->signInAdmin();

        $this->get('/patients')
             ->assertSuccessful();
    }
}
