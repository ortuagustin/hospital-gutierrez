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
    public function it_returns_true_when_existing_key()
    {
        $this->createSetting('key', 'value');
        $this->assertTrue(ApplicationSetting::exists('key'));
    }

    /** @test */
    public function it_returns_false_when_key_doest_not_exist()
    {
        $this->assertFalse(ApplicationSetting::exists('key'));
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
}
