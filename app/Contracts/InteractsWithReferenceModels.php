<?php

namespace App\Contracts;

/**
 * Provides access to the different ReferenceData Repositories that are
 * resolved from the application container
 */
trait InteractsWithReferenceModels
{
    /**
     * Repository for DocType Models
     *
     * @return DocTypesRepositoryInterface
     */
    private function docTypes()
    {
        return resolve(DocTypesRepositoryInterface::class);
    }

    /**
     * Repository for HomeType Models
     *
     * @return HomeTypesRepositoryInterface
     */
    private function homeTypes()
    {
        return resolve(HomeTypesRepositoryInterface::class);
    }

    /**
     * Repository for HeatingType Models
     *
     * @return HeatingTypesRepositoryInterface
     */
    private function heatingsTypes()
    {
        return resolve(HeatingTypesRepositoryInterface::class);
    }

    /**
     * Repository for WaterType Models
     *
     * @return WaterTypesRepositoryInterface
     */
    private function waterTypes()
    {
        return resolve(WaterTypesRepositoryInterface::class);
    }

    /**
     * Repository for MedicalInsurance Models
     *
     * @return MedicalInsurancesRepositoryInterface
     */
    private function medicalInsurances()
    {
        return resolve(MedicalInsurancesRepositoryInterface::class);
    }
}
