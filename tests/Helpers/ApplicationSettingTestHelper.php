<?php

namespace Tests\Helpers;

use App\ApplicationSetting;

trait ApplicationSettingTestHelper
{
    /**
     * @param string $key
     * @param string $value
     * @return \App\ApplicationSetting
     */
    public function createSetting($key, $value)
    {
        return ApplicationSetting::create(['key' => $key, 'value' => $value]);
    }
}
