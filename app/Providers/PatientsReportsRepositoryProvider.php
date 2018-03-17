<?php

namespace App\Providers;

use App\Charts\PPCGrowthReportChart;
use App\Charts\TallGrowthReportChart;
use App\Charts\WeightGrowthReportChart;
use App\Contracts\PatientsReportsRepositoryInterface;
use App\Repositories\PatientsReportsRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Registers an implementation for the PatientsReportsRepositoryInterface
 */
class PatientsReportsRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $reports = [];
        $reports[] = new WeightGrowthReportChart();
        $reports[] = new PPCGrowthReportChart();
        $reports[] = new TallGrowthReportChart();

        $this->app->bind(PatientsReportsRepositoryInterface::class, function ($app) use ($reports) {
            return new PatientsReportsRepository($reports);
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
