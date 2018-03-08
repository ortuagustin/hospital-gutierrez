<?php

namespace App\Rules;

use App\Contracts\DocTypesRepositoryInterface;
use App\Contracts\HeatingTypesRepositoryInterface;
use App\Contracts\HomeTypesRepositoryInterface;
use App\Contracts\MedicalInsurancesRepositoryInterface;
use App\Contracts\ReferenceDataRepositoryInterface;
use App\Contracts\WaterTypesRepositoryInterface;
use Illuminate\Validation\Validator;

/**
 * A Validation Rule that checks that a related (ie. foreign Model) exists
 * It's similar to Laravel's Exists but it's not tied to database backend
 */
abstract class ForeignRule
{
    /**
     * @var ReferenceDataRepositoryInterface
     */
    protected $repository;

    /**
     * Determine if the validation rule passes.
     * @param mixed $attribute
     * @param mixed $value
     * @param mixed $parameters
     * @param Validator $validator
     *
     * @return bool
     */
    public function validate($attribute, $value, $parameters, Validator $validator)
    {
        return $this->repository->contains($value);
    }
}

class ForeignDocTypeRule extends ForeignRule
{
    /**
     * @param DocTypesRepositoryInterface $repository
     */
    public function __construct(DocTypesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}

class ForeignHomeTypeRule extends ForeignRule
{
    /**
     * @param HomeTypesRepositoryInterface $repository
     */
    public function __construct(HomeTypesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}

class ForeignWaterTypeRule extends ForeignRule
{
    /**
     * @param WaterTypesRepositoryInterface $repository
     */
    public function __construct(WaterTypesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}

class ForeignHeatingTypeRule extends ForeignRule
{
    /**
     * @param HeatingTypesRepositoryInterface $repository
     */
    public function __construct(HeatingTypesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}

class ForeignMedicalInsuranceRule extends ForeignRule
{
    /**
     * @param MedicalInsurancesRepositoryInterface $repository
     */
    public function __construct(MedicalInsurancesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}
