<?php

namespace App;

use App\Models\ReferenceModel;
use Illuminate\Database\Eloquent\Model;

/**
 * a Model that represents a Patient
 */
class Patient extends Model
{
    /**
     * Repository for DocType Models
     * @return \App\Contracts\DocTypesRepositoryInterface
     */
    private function docTypes()
    {
        return resolve(\App\Contracts\DocTypesRepositoryInterface::class);
    }

    /**
     * Repository for HomeType Models
     * @return \App\Contracts\HomeTypesRepositoryInterface
     */
    private function homeTypes()
    {
        return resolve(\App\Contracts\HomeTypesRepositoryInterface::class);
    }

    /**
     * Repository for HeatingType Models
     * @return \App\Contracts\HeatingTypesRepositoryInterface
     */
    private function heatingsTypes()
    {
        return resolve(\App\Contracts\HeatingTypesRepositoryInterface::class);
    }

    /**
     * Repository for WaterType Models
     * @return \App\Contracts\WaterTypesRepositoryInterface
     */
    private function waterTypes()
    {
        return resolve(\App\Contracts\WaterTypesRepositoryInterface::class);
    }

    /**
     * Repository for MedicalInsurance Models
     * @return \App\Contracts\MedicalInsurancesRepositoryInterface
     */
    private function medicalInsurances()
    {
        return resolve(\App\Contracts\MedicalInsurancesRepositoryInterface::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'doc_type_id', 'home_type_id', 'heating_type_id', 'water_type_id',
      'medical_insurance_id', 'name', 'last_name', 'dni', 'birth_date',
      'gender', 'address', 'phone', 'has_refrigerator', 'has_electricity',
      'has_pet',
    ];

    /**
     * Returns the associated Document Type
     * @return ReferenceModel
     */
    public function getDocTypeAttribute()
    {
        return $this->docTypes()->get($this->doc_type_id);
    }

    /**
     * Returns the associated Home Type
     * @return ReferenceModel
     */
    public function getHomeTypeAttribute()
    {
        return $this->homeTypes()->get($this->home_type_id);
    }

    /**
     * Returns the associated Heating Type
     * @return ReferenceModel
     */
    public function getHeatingTypeAttribute()
    {
        return $this->heatingsTypes()->get($this->heating_type_id);
    }

    /**
     * Returns the associated Water Type
     * @return ReferenceModel
     */
    public function getWaterTypeAttribute()
    {
        return $this->waterTypes()->get($this->water_type_id);
    }

    /**
     * Returns the associated Medical Insurance
     * @return ReferenceModel
     */
    public function getMedicalInsuranceAttribute()
    {
        return $this->medicalInsurances()->get($this->medical_insurance_id);
    }

    /**
     * Sets the associated Medical Insurance
     * @param $value ReferenceModel
     */
    public function setDocTypeAttribute(ReferenceModel $value)
    {
        $this->doc_type_id = $value->id();
    }

    /**
     * Sets the associated Medical Insurance
     * @param $value ReferenceModel
     */
    public function setHomeTypeAttribute(ReferenceModel $value)
    {
        $this->home_type_id = $value->id();
    }

    /**
     * Sets the associated Medical Insurance
     * @param $value ReferenceModel
     */
    public function setHeatingTypeAttribute(ReferenceModel $value)
    {
        $this->heating_type_id = $value->id();
    }

    /**
     * Sets the associated Medical Insurance
     * @param $value ReferenceModel
     */
    public function setWaterTypeAttribute(ReferenceModel $value)
    {
        $this->water_type_id = $value->id();
    }

    /**
     * Sets the associated Medical Insurance
     * @param $value ReferenceModel
     */
    public function setMedicalInsuranceAttribute(ReferenceModel $value)
    {
        $this->medical_insurance_id = $value->id();
    }
}
