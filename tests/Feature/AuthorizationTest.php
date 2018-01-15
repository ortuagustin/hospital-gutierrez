<?php

namespace Tests\Feature;

use App\Permission;
use App\Role;
use App\User;

class UserAuthorizationTest extends FeatureTest
{
    /** @test */
    public function it_has_permission_through_one_role()
    {
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'create']);
        $user = factory(User::class)->create();
        $user->roles()->attach($role);
        $role->permissions()->attach($permission);
        $this->assertTrue($user->hasPermission($permission), 'It should have permission');
    }

    /** @test */
    public function it_has_many_permissions_through_one_role()
    {
        $role = Role::create(['name' => 'admin']);
        $permission_to_create = Permission::create(['name' => 'create']);
        $permission_to_view = Permission::create(['name' => 'view']);
        $user = factory(User::class)->create();
        $user->roles()->attach($role);
        $role->permissions()->attach($permission_to_create);
        $role->permissions()->attach($permission_to_view);
        $this->assertTrue($user->hasPermission($permission_to_create), 'It should have permission to create');
        $this->assertTrue($user->hasPermission($permission_to_view), 'It should have permission to view');
    }

    /** @test */
    public function it_has_many_permissions_through_many_roles()
    {
        $admin_role = Role::create(['name' => 'admin']);
        $guest_role = Role::create(['name' => 'guest']);
        $permission_to_create = Permission::create(['name' => 'create']);
        $permission_to_view = Permission::create(['name' => 'view']);
        $admin_role->permissions()->attach($permission_to_create);
        $guest_role->permissions()->attach($permission_to_view);
        $user = factory(User::class)->create();
        $user->roles()->attach($admin_role);
        $user->roles()->attach($guest_role);
        $this->assertTrue($user->hasPermission($permission_to_create), 'It should have permission to create');
        $this->assertTrue($user->hasPermission($permission_to_view), 'It should have permission to view');
    }

    /** @test */
    public function it_does_not_have_permission_when_no_roles_are_assigned()
    {
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'create']);
        $user = factory(User::class)->create();
        $role->permissions()->attach($permission);
        $this->assertTrue($user->hasNotPermission($permission), 'It should not have permission');
    }

    /** @test */
    public function it_does_not_have_permission_when_assigned_roles_misses_the_permission()
    {
        $admin_role = Role::create(['name' => 'admin']);
        $guest_role = Role::create(['name' => 'guest']);
        $permission_to_create = Permission::create(['name' => 'create']);
        $permission_to_view = Permission::create(['name' => 'view']);
        $user = factory(User::class)->create();
        $user->roles()->attach($guest_role);
        $admin_role->permissions()->attach($permission_to_create);
        $guest_role->permissions()->attach($permission_to_view);
        $this->assertTrue($user->hasNotPermission($permission_to_create), 'It should not have permission to create');
    }

    /** @test */
    public function it_has_permission_when_received_permission_model()
    {
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'create']);
        $user = factory(User::class)->create();
        $user->roles()->attach($role);
        $role->permissions()->attach($permission);
        $this->assertTrue($user->hasPermission($permission), 'It should have permission');
    }

    /** @test */
    public function it_has_not_permission_when_received_permission_model()
    {
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'create']);
        $user = factory(User::class)->create();
        $user->roles()->attach($role);
        $this->assertTrue($user->hasNotPermission($permission), 'It should not have permission');
    }

    /** @test */
    public function it_has_permission_when_received_permission_id()
    {
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'create']);
        $user = factory(User::class)->create();
        $user->roles()->attach($role);
        $role->permissions()->attach($permission);
        $this->assertTrue($user->hasPermission($permission->id), 'It should have permission');
    }

    /** @test */
    public function it_has_not_permission_when_received_permission_id()
    {
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'create']);
        $user = factory(User::class)->create();
        $user->roles()->attach($role);
        $this->assertTrue($user->hasNotPermission($permission->id), 'It should not have permission');
    }

    /** @test */
    public function it_has_permission_when_received_permission_name()
    {
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'create']);
        $user = factory(User::class)->create();
        $user->roles()->attach($role);
        $role->permissions()->attach($permission);
        $this->assertTrue($user->hasPermission($permission->name), 'It should have permission');
    }

    /** @test */
    public function it_has_not_permission_when_received_permission_name()
    {
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'create']);
        $user = factory(User::class)->create();
        $user->roles()->attach($role);
        $this->assertTrue($user->hasNotPermission($permission->name), 'It should not have permission');
    }
}
