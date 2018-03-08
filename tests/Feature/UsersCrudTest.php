<?php

namespace Tests\Feature;

use App\User;
use Tests\Helpers\UserTestHelper;

class UsersCrudTest extends FeatureTest
{
    use UserTestHelper;

    /** @test */
    public function authorized_users_can_delete_users()
    {
        $user = $this->createUser();

        $this->assertEquals(User::count(), 1, 'There should be one User');

        $this->signInAdmin()
             ->deleteJson(route('users.destroy', $user))
             ->assertSuccessful();

        $this->assertEquals(User::count(), 1, 'There should be one User (the Admin user)');
    }

    /** @test */
    public function unauthorized_users_cannot_delete_users()
    {
        $user = $this->createUser();

        $this->assertEquals(User::count(), 1, 'There should be one User');

        $this->withExceptionHandling()
              ->delete(route('users.destroy', $user))
              ->assertRedirect(route('login'));

        $this->assertEquals(User::count(), 1, 'There should be one User');
    }
}
