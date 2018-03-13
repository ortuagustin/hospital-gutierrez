<?php

namespace App\Providers;

use App\Charts\PatientsPerDocTypeChart;
use App\Charts\PatientsPerHeatingTypeChart;
use App\Charts\PatientsPerHomeTypeChart;
use App\Charts\PatientsPerMedicalInsuranceChart;
use App\Charts\PatientsPerWaterTypeChart;
use App\Contracts\DemographicReportsRepositoryInterface;
use App\Repositories\DemographicReportsRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Registers an implementation for the DemographicReportsRepositoryInterface
 */
class DemographicReportsRepositoryProvider extends ServiceProvider
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
        $reports[] = new PatientsPerMedicalInsuranceChart();

        $this->app->bind(DemographicReportsRepositoryInterface::class, function ($app) use ($reports) {
            return new DemographicReportsRepository($reports);
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
