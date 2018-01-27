<?php

namespace App;

use App\Contracts\DefaultApplicationSettingsInterface;

/**
 * @inheritDoc
 */
class DefaultApplicationSettings implements DefaultApplicationSettingsInterface
{
    /**
     * Defaults values to use when config() does not find the key,
     * A.K.A, enviroment variables or .env file not set
     * @var array
     */
    protected $defaults;

    /**
     * @param array $defaults Defaults values to use when config() does not find the key,
     *  A.K.A, enviroment variables or .env file not set
     */
    public function __construct(array $defaults)
    {
        $this->defaults = $defaults;
    }

    /**
     * @inheritDoc
     */
    public function resetToDefault()
    {
        ApplicationSetting::truncate();
        ApplicationSetting::put('title', config('APP_TITLE', $this->defaults['title']));
        ApplicationSetting::put('description', config('APP_DESCRIPTION', $this->defaults['description']));
        ApplicationSetting::put('contact_email', config('APP_CONTACT_EMAIL', $this->defaults['contact_email']), 'email');
        ApplicationSetting::put('records_per_page', config('APP_RECORDS_PER_PAGE', $this->defaults['records_per_page']), 'number');
        ApplicationSetting::put('maintenance', '0', 'checkbox');
    }
}
