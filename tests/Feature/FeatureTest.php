<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\CreatesApplication;
use Tests\Helpers\UserTestHelper;
use Tests\RunsMigrations;

abstract class FeatureTest extends BaseTestCase
{
    use CreatesApplication, RunsMigrations, DatabaseTransactions, UserTestHelper;

    protected function signIn(User $user = null)
    {
        $user = $user ?: $this->createUser();
        $this->be($user);

        return $this;
    }

    protected function signInAdmin(User $user = null)
    {
        $user = $user ?: $this->createAdminUser();

        return $this->signIn($user);
    }
}
