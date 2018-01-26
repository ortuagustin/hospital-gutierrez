<?php

namespace App\Contracts;

/**
 * Clears all ApplicationSetting records
 * Creates the default ApplicationSetting with reasonable values
 */
interface DefaultApplicationSettingsInterface
{
    /**
     * Clears all ApplicationSetting records
     * Creates the default ApplicationSetting with reasonable values
     */
    public function resetToDefault();
}
