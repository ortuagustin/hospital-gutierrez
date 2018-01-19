<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Support\Facades\Event;
use Tests\Helpers\TestsModel;

/**
 * Tests user registration and login
 */
class AuthenticationTest extends FeatureTest
{
    use TestsModel;

    /** @test */
    public function it_registers_a_user_when_all_fields_are_supplied()
    {
        $user_attributes = $this->getRegistrationFields();
        $this->submitRegistrationForm($user_attributes);
        $this->seeUserInDatabase($user_attributes)
             ->assertEquals(User::count(), 1);
    }

    /** @test */
    public function it_dispatches_event_when_user_is_registered()
    {
        Event::fake();
        $user_attributes = $this->getRegistrationFields();
        $this->submitRegistrationForm($user_attributes);
        Event::assertDispatched(Registered::class, function ($event) {
            return $event->user->is(User::first());
        });
    }

    /** @test */
    public function it_does_not_dispatch_event_if_registration_fails()
    {
        Event::fake();
        $user_attributes = $this->getRegistrationFields(['email' => 'invalid-email']);
        $this->submitRegistrationForm($user_attributes);
        Event::assertNotDispatched(Registered::class);
    }

    /** @test */
    public function it_does_not_register_a_user_if_any_field_validation_fails()
    {
        $this->submitRegistrationForm([]);
        $this->assertEquals(User::count(), 0);
    }

    /** @test */
    public function it_does_not_allow_invalid_email()
    {
        $user_attributes = $this->getRegistrationFields(['email' => 'invalid-email']);
        $response = $this->submitRegistrationForm($user_attributes);
        $this->assertRegistrationFailed($response);
    }

    /** @test */
    public function it_does_not_allow_empty_email()
    {
        $user_attributes = $this->getRegistrationFields(['email' => '']);
        $response = $this->submitRegistrationForm($user_attributes);
        $this->assertRegistrationFailed($response);
    }

    /** @test */
    public function it_does_not_allow_empty_user_name()
    {
        $user_attributes = $this->getRegistrationFields(['name' => '']);
        $response = $this->submitRegistrationForm($user_attributes);
        $this->assertRegistrationFailed($response);
    }

    /** @test */
    public function it_does_not_allow_empty_password()
    {
        $user_attributes = $this->getRegistrationFields(['password' => '']);
        $response = $this->submitRegistrationForm($user_attributes);
        $this->assertRegistrationFailed($response);
    }

    /** @test */
    public function it_does_not_allow_password_shorter_than_four_chars()
    {
        $user_attributes = $this->getRegistrationFields(['password' => '123']);
        $response = $this->submitRegistrationForm($user_attributes);
        $this->assertRegistrationFailed($response);
    }

    /** @test */
    public function it_does_not_allow_use_existing_username()
    {
        $this->createUser(['name' => 'test']);
        $user_attributes = $this->getRegistrationFields(['name' => 'test']);
        $response = $this->submitRegistrationForm($user_attributes);
        $this->assertRegistrationFailed($response, 1);
    }

    /** @test */
    public function it_does_not_allow_use_existing_email()
    {
        $this->createUser(['email' => 'test@example.com']);
        $user_attributes = $this->getRegistrationFields(['email' => 'test@example.com']);
        $response = $this->submitRegistrationForm($user_attributes);
        $this->assertRegistrationFailed($response, 1);
    }

    /** @test */
    public function it_does_not_register_the_user_if_the_password_confirmation_does_not_match()
    {
        $user_attributes = $this->getRegistrationFields() + ['password_confirmation' => 'whatever'];
        $response = $this->submitRegistrationForm($user_attributes);
        $this->assertRegistrationFailed($response, 0);
    }

    /** @test */
    public function it_should_redirect_to_home_if_successfully_registered()
    {
        $user_attributes = $this->getRegistrationFields();
        $this->submitRegistrationForm($user_attributes)
             ->assertRedirect('home');
    }

    /** @test */
    public function it_should_login_the_user_if_successfully_registered()
    {
        $user_attributes = $this->getRegistrationFields();
        $this->submitRegistrationForm($user_attributes);
        $this->seeIsAuthenticatedAs(User::first());
    }

    /** @test */
    public function it_should_login_when_given_user_and_password_matches()
    {
        $user = $this->createUser(['name' => 'test', 'password' => bcrypt('test')]);
        $credentials = ['name' => 'test', 'password' => 'test'];
        $this->assertLogin($credentials);
    }

    /** @test */
    public function it_should_login_when_given_mail_and_password_matches()
    {
        $user = $this->createUser(['email' => 'test@example.com', 'password' => bcrypt('test')]);
        $credentials = ['email' => 'test@example.com', 'password' => 'test'];
        $this->assertLogin($credentials);
    }

    /** @test */
    public function it_should_not_login_when_credentials_dont_match()
    {
        $credentials = ['name' => 'whatever', 'password' => "doesn't matter"];
        $this->refuteLogin($credentials);
    }

    /**
     * @inheritDoc
     */
    protected function modelUnderTestClass()
    {
        return User::class;
    }

    /**
     * creates and saves a new User model
     * @param array $overrides
     * @return User
     */
    protected function createUser(array $overrides = [])
    {
        return $this->createModel($overrides);
    }

    /**
     * returns the fields that the registration form requires
     * @param array $overrides
     * @return array
     */
    protected function getRegistrationFields(array $overrides = [])
    {
        return $this->modelFields($overrides);
    }

    /**
     * simulates that the User Registration Form was submitted by sending a POST request
     * @param array $user_attributes
     * @return TestResponse
     */
    protected function submitRegistrationForm(array $user_attributes)
    {
        $fields = $user_attributes;
        if (array_has($user_attributes, 'password') && array_has_not($user_attributes, 'password_confirmation')) {
            $fields['password_confirmation'] = $user_attributes['password'];
        }

        return $this->post('register', $fields);
    }

    /**
     * simulates that the User Login Form was submitted by sending a POST request
     * @param array $credentials
     * @return TestResponse
     */
    protected function submitLoginForm(array $credentials)
    {
        return $this->post('login', $credentials);
    }

    /**
     * checks wether the given user is found in the database
     * @param array $user_attributes
     * @return $this
     */
    protected function seeUserInDatabase(array $user_attributes)
    {
        $database_fields = array_intersect_key($user_attributes, array_flip(['name', 'email']));

        return $this->assertDatabaseHas('users', $database_fields);
    }

    /**
     * attempts to login; returns true if succesful, false otherwise
     * @param array $credentials
     * @return bool
     */
    protected function attemptLogin(array $credentials)
    {
        return auth()->attempt($credentials);
    }

    /**
     * Asserts that it is possible to login with the given credentials
     * @param array $credentials
     * @return $this
     */
    protected function assertLogin(array $credentials)
    {
        return $this->seeCredentials($credentials)
                    ->assertTrue($this->attemptLogin($credentials));
    }

    /**
     * Asserts that it is NOT possible to login with the given credentials
     * @param array $credentials
     * @return $this
     */
    protected function refuteLogin(array $credentials)
    {
        return $this->dontSeeCredentials($credentials)
                    ->assertFalse($this->attemptLogin($credentials));
    }

    /**
     * Asserts that there are validation errors in the session and that no changes to the User table were made
     * @param \Illuminate\Foundation\Testing\TestResponse $response
     * @param int $expectedUserCount
     * @return $this
     */
    protected function assertRegistrationFailed(TestResponse $response, $expectedUserCount = 0)
    {
        $response->assertSessionHasErrors();
        $this->assertEquals(User::count(), $expectedUserCount);

        return $this;
    }
}
