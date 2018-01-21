<?php

namespace App\Providers;

use App\Contracts\DefaultAuthSchemaInterface;
use App\DefaultAuthSchema;
use Illuminate\Support\ServiceProvider;

/**
 * Registers an implementation for DefaultAuthSchemaInterface
 */
class DefaultAuthSchemaProvider extends ServiceProvider
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
        $this->app->singleton(DefaultAuthSchemaInterface::class, DefaultAuthSchema::class);
    }
}
