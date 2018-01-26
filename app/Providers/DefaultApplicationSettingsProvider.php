<?php

namespace App\Providers;

use App\Contracts\DefaultApplicationSettingsInterface;
use App\DefaultApplicationSettings;
use Illuminate\Support\ServiceProvider;

/**
 * Registers an implementation for DefaultApplicationSettingsInterface
 */
class DefaultApplicationSettingsProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $defaults = [
            'title'            => 'Hospital Dr. Ricardo Gutiérrez',
            'description'      => 'Trabajo de Promoción - Proyecto de Software 2017',
            'contact_email'    => 'ortu.agustin@gmail.com',
            'records_per_page' => '15',
        ];

        // $this->app->bind(DefaultApplicationSettingsInterface::class, DefaultApplicationSettings::class);

        $this->app->bind(DefaultApplicationSettingsInterface::class, function ($app) use ($defaults) {
            return new DefaultApplicationSettings($defaults);
        });
    }
}
