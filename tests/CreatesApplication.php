<?php

namespace Tests;

use App\Contracts\DocTypesRepositoryInterface;
use App\Contracts\HeatingTypesRepositoryInterface;
use App\Contracts\HomeTypesRepositoryInterface;
use App\Contracts\MedicalInsuranceTypesRepositoryInterface;
use App\Contracts\WaterTypesRepositoryInterface;
use Illuminate\Contracts\Console\Kernel;
use Tests\Fakes\FakeReferenceDataRepository;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();
        $app->bind(DocTypesRepositoryInterface::class, FakeReferenceDataRepository::class);
        $app->bind(HomeTypesRepositoryInterface::class, FakeReferenceDataRepository::class);
        $app->bind(HeatingTypesRepositoryInterface::class, FakeReferenceDataRepository::class);
        $app->bind(WaterTypesRepositoryInterface::class, FakeReferenceDataRepository::class);
        $app->bind(MedicalInsuranceTypesRepositoryInterface::class, FakeReferenceDataRepository::class);

        return $app;
    }
}
