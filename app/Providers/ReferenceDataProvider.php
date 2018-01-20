<?php

namespace App\Providers;

use App\Contracts\DocTypesRepositoryInterface;
use App\Contracts\HeatingTypesRepositoryInterface;
use App\Contracts\HomeTypesRepositoryInterface;
use App\Contracts\MedicalInsurancesRepositoryInterface;
use App\Contracts\WaterTypesRepositoryInterface;
use App\Repositories\DocTypesRepository;
use App\Repositories\HeatingTypesRepository;
use App\Repositories\HomeTypesRepository;
use App\Repositories\MedicalInsurancesRepository;
use App\Repositories\WaterTypesRepository;
use Illuminate\Support\ServiceProvider;

class ReferenceDataProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(DocTypesRepositoryInterface::class, DocTypesRepository::class);
        $this->app->singleton(HomeTypesRepositoryInterface::class, HomeTypesRepository::class);
        $this->app->singleton(HeatingTypesRepositoryInterface::class, HeatingTypesRepository::class);
        $this->app->singleton(WaterTypesRepositoryInterface::class, WaterTypesRepository::class);
        $this->app->singleton(MedicalInsurancesRepositoryInterface::class, MedicalInsurancesRepository::class);
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
