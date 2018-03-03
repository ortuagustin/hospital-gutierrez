<?php

namespace Tests\Feature;

use Tests\Helpers\RoleTestHelper;
use Tests\Helpers\UserTestHelper;

class UserRolesTest extends FeatureTest
{
    use UserTestHelper, RoleTestHelper;

    /** @test */
    public function admins_can_add_roles_to_any_user()
    {
        $user = $this->createUser();
        $this->assertEmpty($user->roles);

        $guest_role = $this->createRole('Guest');

        $payload = [
          'roles' => [
            'id' => $guest_role->id,
            ],
          ];

        $this->signInAdmin();
        $response = $this->patchJson(route('user.roles.update', $user), $payload);

        $response->assertSuccessful();
        $user = $user->fresh();
        $this->assertTrue($user->hasRole($guest_role), 'User should have the Guest Role');
        $this->assertCount(1, $user->roles, 'User should have only 1 Role');
    }

    /** @test */
    public function it_deletes_roles_of_the_user_that_are_not_in_the_payload()
    {
        $user = $this->createUser();
        $guest_role = $this->createRole('Guest');
        $medic_role = $this->createRole('Medic');
        $recep_role = $this->createRole('Receptionist');

        $user->roles()->attach([$guest_role->id, $medic_role->id]);
        $this->assertCount(2, $user->roles);

        $payload = [
          'roles' => [
            'medic_role_id' => $medic_role->id,
            '1'             => $recep_role->id,
            ],
          ];

        $this->signInAdmin();
        $this->patchJson(route('user.roles.update', $user), $payload);

        $user = $user->fresh();
        $this->assertTrue($user->hasNotRole($guest_role), 'User should not have the Guest Role');
        $this->assertTrue($user->hasRole($medic_role), 'User should have the Medic Role');
        $this->assertTrue($user->hasRole($recep_role), 'User should have the Receptionist Role');
        $this->assertCount(2, $user->roles);
    }

    /** @test */
    public function non_admin_users_cannot_add_roles()
    {
        $user = $this->createUser();

        $this->withExceptionHandling()
             ->signIn()
             ->patchJson(route('user.roles.update', $user), [])
             ->assertStatus(403);
    }
}
