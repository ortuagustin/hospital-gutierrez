<?php

namespace App\Providers;

use App\ViewComposers\PatientsFormComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PatientsViewComposerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('patients._form', PatientsFormComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
