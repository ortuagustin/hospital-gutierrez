<?php

namespace App\Contracts;

use App\Models\ReferenceModel;
use Illuminate\Support\Collection;

/**
 * Provides access to ReferenceModel objects
 */
interface ReferenceDataRepositoryInterface
{
    /**
     * Returns wether the given key exists in the Repository
     * @param int $key
     * @return bool
     */
    public function contains($key);

    /**
     * Returns wether the given key exists in the Repository
     * @param int $key
     * @return ReferenceModel
     */
    public function get($key);

    /**
     * Returns an array with all the models in the repository
     * @return Collection
     */
    public function all();
}

/**
 * Interface for a Repository that handles DocType Models
 */
interface DocTypesRepositoryInterface extends ReferenceDataRepositoryInterface
{
}

/**
 * Interface for a Repository that handles HomeType Models
 */
interface HomeTypesRepositoryInterface extends ReferenceDataRepositoryInterface
{
}

/**
 * Interface for a Repository that handles HeatingType Models
 */
interface HeatingTypesRepositoryInterface extends ReferenceDataRepositoryInterface
{
}

/**
 * Interface for a Repository that handles WaterType Models
 */
interface WaterTypesRepositoryInterface extends ReferenceDataRepositoryInterface
{
}

/**
 * Interface for a Repository that handles MedicalInsuranceType Models
 */
interface MedicalInsuranceRepositoryInterface extends ReferenceDataRepositoryInterface
{
}
