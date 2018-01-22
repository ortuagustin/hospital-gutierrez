<?php

namespace App\Providers;

use App\MedicalRecord;
use App\Patient;
use App\Policies\MedicalRecordsPolicy;
use App\Policies\PatientsPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

/**
 * Provides Authorization Policies for the Applications Models
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Patient::class       => PatientsPolicy::class,
        MedicalRecord::class => MedicalRecordsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function ($user) {
            return $user->isAdmin();
        });
    }
}
