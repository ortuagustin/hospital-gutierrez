<?php

namespace Tests\Helpers;

use App\ApplicationSetting;

trait ApplicationSettingTestHelper
{
    /**
     * @param string $key
     * @param string $value
     * @param string $input_type
     *
     * @return \App\ApplicationSetting
     */
    public function createSetting($key, $value, $input_type = 'text')
    {
        return ApplicationSetting::create(['key' => $key, 'value' => $value, 'input_type' => $input_type]);
    }
}
