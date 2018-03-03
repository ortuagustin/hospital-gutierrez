<?php

namespace Tests\Unit;

use Tests\Helpers\RoleTestHelper;
use Tests\Helpers\UserTestHelper;

class UserTest extends TestCase
{
    use UserTestHelper;
    use RoleTestHelper;

    /** @test */
    public function it_has_many_roles()
    {
        $user = $this->createUser();
        $this->assertEmpty($user->roles);

        $user->roles()->attach($this->createRole('Some Role'));
        $this->assertEquals(1, $user->roles()->count());

        $user->roles()->attach($this->createRole('Other Role'));
        $this->assertEquals(2, $user->roles()->count());
    }

    /** @test */
    public function it_can_delete_any_associated_role()
    {
        $user = $this->createUser();
        $user->roles()->attach($role = $this->createRole('Some Role'));
        $this->assertEquals(1, $user->roles()->count());

        $user->roles()->detach($role);

        $this->assertEmpty($user->roles);
    }

    /** @test */
    public function it_can_delete_any_associated_roles()
    {
        $user = $this->createUser();
        $user->roles()->attach($role1 = $this->createRole('Some Role'));
        $user->roles()->attach($role2 = $this->createRole('Another Role'));
        $this->assertEquals(2, $user->roles()->count());

        $user->roles()->detach($role1);

        $this->assertEquals(1, $user->roles()->count());
        $this->assertTrue($user->hasNotRole($role1));
        $this->assertTrue($user->hasRole($role2));
    }

    /** @test */
    public function it_can_sync_its_roles_relationship()
    {
        $user = $this->createUser();
        $user->roles()->attach($admin_role = $this->createRole('Admin'));
        $user->roles()->attach($guest_role = $this->createRole('Guest'));
        $medic_role = $this->createRole('Medic');

        $user->roles()->sync($medic_role);

        $this->assertEquals(1, $user->roles()->count());
        $this->assertTrue($user->hasNotRole($admin_role));
        $this->assertTrue($user->hasNotRole($guest_role));
        $this->assertTrue($user->hasRole($medic_role));

        $user->roles()->sync([
            $medic_role->id,
            $admin_role->id,
        ]);

        $this->assertEquals(2, $user->roles()->count());
        $this->assertTrue($user->hasNotRole($guest_role));
        $this->assertTrue($user->hasRole($admin_role));
        $this->assertTrue($user->hasRole($medic_role));
    }

    /** @test */
    public function it_returns_roles_separated_by_comma()
    {
        $user = $this->createUser();

        $user->roles()->attach($this->createRole('Admin'));
        $user->roles()->attach($this->createRole('Guest'));
        $user->roles()->attach($this->createRole('Medic'));

        $this->assertEquals('Admin, Guest, Medic', $user->roles_names());
    }

    /** @test */
    public function it_returns_empty_when_user_has_no_roles()
    {
        $user = $this->createUser();

        $this->assertEquals('', $user->roles_names());
    }

    /** @test */
    public function it_returns_one_role_when_user_has_only_one_role()
    {
        $user = $this->createUser();

        $user->roles()->attach($this->createRole('Admin'));

        $this->assertEquals('Admin', $user->roles_names());
    }

    /** @test */
    public function it_trims_the_string_if_more_than_three_roles()
    {
        $user = $this->createUser();

        $user->roles()->attach($this->createRole('Admin'));
        $user->roles()->attach($this->createRole('Medic'));
        $user->roles()->attach($this->createRole('Receptionist'));
        $user->roles()->attach($this->createRole('Owner'));
        $user->roles()->attach($this->createRole('Guest'));

        $this->assertEquals('Admin, Medic, Receptionist, ...', $user->roles_names());
    }
}
