<?php

namespace Tests\Feature;

use App\ApplicationSetting;
use Tests\Helpers\ApplicationSettingTestHelper;

class AdminAreaTest extends FeatureTest
{
    use ApplicationSettingTestHelper;

    /** @test */
    public function admin_users_may_see_all_settings_when_visiting_admin_area()
    {
        $setting = $this->createSetting('setting', 'value');
        $other_setting = $this->createSetting('other_setting', 'value');

        $this->signInAdmin()
             ->get(route('settings.index'))
             ->assertSee($setting->key)
             ->assertSee($setting->value)
             ->assertSee($other_setting->key)
             ->assertSee($other_setting->value);
    }

    /** @test */
    public function non_admin_users_cannot_visit_admin_area()
    {
        $this->withExceptionHandling()
             ->signIn()
             ->get(route('settings.index'))
             ->assertStatus(403);
    }

    /** @test */
    public function guests_are_redirected_to_login_page()
    {
        $this->withExceptionHandling()
             ->get(route('settings.index'))
             ->assertRedirect(route('login'));
    }

    /** @test */
    public function admin_users_may_update_any_setting()
    {
        $this->signInAdmin();

        $response = $this->postJson(route('settings.store'), [
            'key'   => 'setting',
            'value' => 'updated value',
        ]);

        $response->assertStatus(200);
        $this->assertEquals('updated value', ApplicationSetting::value('setting'));
    }

    /** @test */
    public function non_admin_users_cannot_update_settings()
    {
        $this->withExceptionHandling()
             ->signIn()
             ->postJson(route('settings.store'))
             ->assertStatus(403);
    }

    /** @test */
    public function admin_users_may_reset_settings_to_defaults()
    {
        $this->signInAdmin();

        $this->deleteJson(route('settings.reset'))
             ->assertStatus(200);
    }

    /** @test */
    public function non_admin_users_cannot_reset_settings_to_defaults()
    {
        $this->withExceptionHandling()
             ->signIn()
             ->deleteJson(route('settings.reset'))
             ->assertStatus(403);
    }
}
