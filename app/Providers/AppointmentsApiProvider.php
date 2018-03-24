<?php

namespace App\Providers;

use App\AppointmentsApi;
use App\Contracts\AppointmentsApiInterface;
use Illuminate\Support\ServiceProvider;

class AppointmentsApiProvider extends ServiceProvider
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
        $this->app->singleton(AppointmentsApiInterface::class, AppointmentsApi::class);
    }
}
