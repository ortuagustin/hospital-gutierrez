<?php

namespace App\Providers;

use App\Charts\PatientsPerDocTypeChart;
use App\Charts\PatientsPerHeatingTypeChart;
use App\Charts\PatientsPerHomeTypeChart;
use App\Charts\PatientsPerWaterTypeChart;
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
        $reports[] = new PatientsPerWaterTypeChart();
        $reports[] = new PatientsPerHeatingTypeChart();
        $reports[] = new PatientsPerDocTypeChart();

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
