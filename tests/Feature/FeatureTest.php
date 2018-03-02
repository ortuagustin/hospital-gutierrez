<?php

namespace Tests\Feature;

use App\Exceptions\Handler;
use App\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use SebastianBergmann\CodeCoverage\Exception;
use Tests\CreatesApplication;
use Tests\Helpers\UserTestHelper;
use Tests\RunsMigrations;

abstract class FeatureTest extends BaseTestCase
{
    use CreatesApplication, RunsMigrations, DatabaseTransactions, UserTestHelper;

    protected function setUp()
    {
        parent::setUp();
        $this->disableExceptionHandling();
    }

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

    // Adam Wathan --> https://gist.github.com/adamwathan/c9752f61102dc056d157
    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);
        app()->instance(ExceptionHandler::class, new PassThroughHandler());
    }

    protected function withExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);

        return $this;
    }
}

class PassThroughHandler extends Handler
{
    public function __construct()
    {
    }

    public function report(\Exception $e)
    {
        // no-op
    }

    public function render($request, \Exception $e)
    {
        throw $e;
    }
}
