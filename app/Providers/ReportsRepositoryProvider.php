<?php

namespace App\Providers;

use App\Charts\PatientsPerHomeTypeChart;
use App\Contracts\ReportsRepositoryInterface;
use App\Repositories\ReportsRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Registers an implementation for the ReportsRepositoryInterface
 */
class ReportsRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $reports = [];
        $reports[] = new PatientsPerHomeTypeChart();

        $this->app->bind(ReportsRepositoryInterface::class, function ($app) use ($reports) {
            return new ReportsRepository($reports);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
