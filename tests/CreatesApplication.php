<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Tests\Feature\Fakes\FakeReferenceDataRepository;

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
        $app->bind(\App\Contracts\DocTypesRepositoryInterface::class, FakeReferenceDataRepository::class);
        $app->bind(\App\Contracts\HomeTypesRepositoryInterface::class, FakeReferenceDataRepository::class);
        $app->bind(\App\Contracts\HeatingTypesRepositoryInterface::class, FakeReferenceDataRepository::class);
        $app->bind(\App\Contracts\WaterTypesRepositoryInterface::class, FakeReferenceDataRepository::class);
        $app->bind(\App\Contracts\MedicalInsuranceTypesRepositoryInterface::class, FakeReferenceDataRepository::class);

        return $app;
    }
}
