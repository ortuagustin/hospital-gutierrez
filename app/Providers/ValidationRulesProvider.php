<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

/**
 * Provides custom validation rules
 */
class ValidationRulesProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('foreign_doc_type', 'App\Rules\ForeignDocTypeRule@validate');
        Validator::extend('foreign_home_type', 'App\Rules\ForeignHomeTypeRule@validate');
        Validator::extend('foreign_water_type', 'App\Rules\ForeignWaterTypeRule@validate');
        Validator::extend('foreign_heating_type', 'App\Rules\ForeignHeatingTypeRule@validate');
        Validator::extend('foreign_medical_insurance', 'App\Rules\ForeignMedicalInsuranceRule@validate');
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
