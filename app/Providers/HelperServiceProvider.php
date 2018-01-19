<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Autoloader for files under App/Helpers
 */
class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        foreach (glob(app_path().'/Helpers/*.php') as $filename) {
            require_once($filename);
        }
    }
}
