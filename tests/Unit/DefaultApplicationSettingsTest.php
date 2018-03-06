<?php

namespace Tests\Unit;

use App\ApplicationSetting;
use App\Contracts\DefaultApplicationSettingsInterface;
use App\DefaultApplicationSettings;
use Tests\Helpers\ApplicationSettingTestHelper;

class DefaultApplicationSettingsTest extends TestCase
{
    use ApplicationSettingTestHelper;

    /**
     * @var DefaultApplicationSettingsInterface
     */
    protected $settings_resetter;

    /** @test */
    public function it_creates_all_settings_when_resetting_to_default()
    {
        $this->settings_resetter->resetToDefault();

        $this->assertTrue(ApplicationSetting::exists('title'));
        $this->assertTrue(ApplicationSetting::find('title')->reloads, 'Title should reload');

        $this->assertTrue(ApplicationSetting::exists('description'));
        $this->assertTrue(ApplicationSetting::find('description')->reloads, 'Description should reload');

        $this->assertTrue(ApplicationSetting::exists('contact_email'));
        $this->assertFalse(ApplicationSetting::find('contact_email')->reloads, 'Contact email should not reload');

        $this->assertTrue(ApplicationSetting::exists('records_per_page'));
        $this->assertFalse(ApplicationSetting::find('records_per_page')->reloads, 'Records per page should not reload');

        $this->assertTrue(ApplicationSetting::exists('maintenance'));
        $this->assertFalse(ApplicationSetting::find('maintenance')->reloads, 'Maintenance should reload');
    }

    /** @test */
    public function it_falls_back_to_supplied_default_values_when_not_found_in_enviroment()
    {
        $this->settings_resetter->resetToDefault();
        $this->assertEquals(ApplicationSetting::value('title'), 'test-title');
        $this->assertEquals(ApplicationSetting::value('description'), 'test-description');
        $this->assertEquals(ApplicationSetting::value('contact_email'), 'test-contact_email');
        $this->assertEquals(ApplicationSetting::value('records_per_page'), '10');
        $this->assertEquals(ApplicationSetting::value('maintenance'), '0');
    }

    /** @before */
    public function setUpEnviroment()
    {
        $this->settings_resetter = new DefaultApplicationSettings([
            'title'            => 'test-title',
            'description'      => 'test-description',
            'contact_email'    => 'test-contact_email',
            'records_per_page' => '10',
        ]);
    }
}
