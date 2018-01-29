<?php

namespace App\ViewComposers;

use App\Contracts\DocTypesRepositoryInterface;
use App\Contracts\HeatingTypesRepositoryInterface;
use App\Contracts\HomeTypesRepositoryInterface;
use App\Contracts\MedicalInsurancesRepositoryInterface;
use App\Contracts\WaterTypesRepositoryInterface;
use Illuminate\View\View;

/**
 * Binds ReferenceData from Repositories to the View
 */
class PatientsFormComposer
{
    /**
     * @var DocTypesRepositoryInterface
     */
    private $doc_types_repository;

    /**
     * @var HeatingTypesRepositoryInterface
     */
    private $heating_types_repository;

    /**
     * @var HomeTypesRepositoryInterface
     */
    private $home_types_repository;

    /**
     * @var MedicalInsurancesRepositoryInterface
     */
    private $medical_insurances_repository;

    /**
     * @var WaterTypesRepositoryInterface
     */
    private $water_types_repository;

    /**
     * @param DocTypesRepositoryInterface          $doc_types_repository
     * @param HeatingTypesRepositoryInterface      $heating_types_repository
     * @param HomeTypesRepositoryInterface         $home_types_repository
     * @param MedicalInsurancesRepositoryInterface $medical_insurances_repository
     * @param WaterTypesRepositoryInterface        $water_types_repository
     */
    public function __construct(
        DocTypesRepositoryInterface $doc_types_repository,
        HeatingTypesRepositoryInterface $heating_types_repository,
        HomeTypesRepositoryInterface $home_types_repository,
        MedicalInsurancesRepositoryInterface $medical_insurances_repository,
        WaterTypesRepositoryInterface $water_types_repository
    ) {
        $this->doc_types_repository = $doc_types_repository;
        $this->heating_types_repository = $heating_types_repository;
        $this->home_types_repository = $home_types_repository;
        $this->medical_insurances_repository = $medical_insurances_repository;
        $this->water_types_repository = $water_types_repository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([
            'doc_types'          => $this->doc_types_repository->all(),
            'heating_types'      => $this->heating_types_repository->all(),
            'home_types'         => $this->home_types_repository->all(),
            'medical_insurances' => $this->medical_insurances_repository->all(),
            'water_types'        => $this->water_types_repository->all(),
        ]);
    }
}
