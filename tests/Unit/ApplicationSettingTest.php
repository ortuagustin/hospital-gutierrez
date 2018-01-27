<?php

namespace Tests\Unit;

use App\ApplicationSetting;
use Tests\Helpers\ApplicationSettingTestHelper;
use Tests\Unit\TestCase;

class ApplicationSettingTest extends TestCase
{
    use ApplicationSettingTestHelper;

    /** @test */
    public function it_finds_setting_by_its_key()
    {
        $this->createSetting('key', 'value');
        $setting = ApplicationSetting::find('key');
        $this->assertEquals('key', $setting->key);
        $this->assertEquals('value', $setting->value);
    }

    /** @test */
    public function it_creates_app_setting_when_key_does_not_exit()
    {
        $setting = ApplicationSetting::put('key', 'value', 'number');
        $this->assertEquals('value', $setting->value);
        $this->assertTrue(ApplicationSetting::exists('key'));
        $this->assertEquals('value', ApplicationSetting::value('key'));
        $this->assertEquals('number', $setting->input_type);
    }

    /** @test */
    public function it_updates_app_setting_value_when_key_exists()
    {
        $this->createSetting('key', 'value');
        $setting = ApplicationSetting::put('key', 'updated-value');
        $this->assertEquals('key', $setting->key);
        $this->assertEquals('updated-value', $setting->value);
        $this->assertEquals('text', $setting->input_type);
    }

    /** @test */
    public function it_does_not_update_input_type_when_key_exists()
    {
        $this->createSetting('key', 'value', 'number');
        $setting = ApplicationSetting::put('key', 'updated-value');
        $this->assertEquals('key', $setting->key);
        $this->assertEquals('updated-value', $setting->value);
        $this->assertEquals('number', $setting->input_type);
    }

    /** @test */
    public function it_returns_true_when_existing_key()
    {
        $this->createSetting('key', 'value');
        $this->assertTrue(ApplicationSetting::exists('key'));
    }

    /** @test */
    public function it_returns_false_when_key_doest_not_exist()
    {
        $this->createSetting('whatever', 'value');
        $this->assertFalse(ApplicationSetting::exists('key'));
    }

    /** @test */
    public function it_returns_true_when_missing_key()
    {
        $this->createSetting('whatever', 'value');
        $this->assertTrue(ApplicationSetting::missing('key'));
    }

    /** @test */
    public function it_returns_false_when_key_is_not_missing()
    {
        $this->createSetting('key', 'value');
        $this->assertFalse(ApplicationSetting::missing('key'));
    }

    /** @test */
    public function it_returns_value_by_key()
    {
        $this->createSetting('key', 'value');
        $this->assertEquals('value', ApplicationSetting::value('key'));
    }

    /** @test */
    public function it_returns_default_value_when_key_does_not_exist()
    {
        $this->assertEquals('default', ApplicationSetting::value('key', 'default'));
    }

    /** @test */
    public function it_returns_null_when_key_does_not_exist()
    {
        $this->assertNull(ApplicationSetting::value('key'));
    }

    /** @test */
    public function it_returns_human_name()
    {
        $title = $this->createSetting('title', 'value');
        $contact_email = $this->createSetting('contact-email', 'value');
        $records_per_page = $this->createSetting('records_per_page', 'value');
        $this->assertEquals('Title', $title->human_name);
        $this->assertEquals('Contact Email', $contact_email->human_name);
        $this->assertEquals('Records Per Page', $records_per_page->human_name());
    }
}
