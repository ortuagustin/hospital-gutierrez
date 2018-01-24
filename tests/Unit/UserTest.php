<?php

namespace Tests\Unit;

use Tests\Helpers\RoleTestHelper;
use Tests\Helpers\UserTestHelper;
use Tests\Unit\TestCase;

class UserTest extends TestCase
{
    use UserTestHelper;
    use RoleTestHelper;

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
