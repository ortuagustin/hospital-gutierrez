<?php

namespace App\Providers;

use App\Contracts\ReportsRepositoryInterface;
use App\Repositories\ReportsRepository;
use Illuminate\Support\ServiceProvider;

class ReportsRepositoryProvider extends ServiceProvider
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
        $this->app->bind(ReportsRepositoryInterface::class, function ($app) use ($reports) {
            return new ReportsRepository($reports);
        });
    }
}
