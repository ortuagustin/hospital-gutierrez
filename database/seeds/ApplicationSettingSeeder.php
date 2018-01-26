<?php

namespace Database\Seeds;

use App\Contracts\DefaultApplicationSettingsInterface;
use Illuminate\Database\Seeder;

class ApplicationSettingSeeder extends Seeder
{
    /**
     * @var DefaultApplicationSettingsInterface
     */
    private $default_settings;

    /**
     * @param DefaultApplicationSettingsInterface $default_settings
     */
    public function __construct(DefaultApplicationSettingsInterface $default_settings)
    {
        $this->default_settings = $default_settings;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->default_settings->resetToDefault();
    }
}
