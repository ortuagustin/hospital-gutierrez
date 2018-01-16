<?php

namespace App;

use App\Contracts\InteractsWithReferenceModels;
use Illuminate\Database\Eloquent\Model;

/**
 * a Model that represents a Patient
 */
class Patient extends Model
{
    use InteractsWithReferenceModels;

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
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['medical_records'];

    /**
     * The Medical Records assigned to the Patient
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    /**
     * Returns the associated Document Type
     * @return \App\Models\ReferenceModel
     */
    public function getDocTypeAttribute()
    {
        return $this->docTypes()->get($this->doc_type_id);
    }

    /**
     * Returns the associated Home Type
     * @return \App\Models\ReferenceModel
     */
    public function getHomeTypeAttribute()
    {
        return $this->homeTypes()->get($this->home_type_id);
    }

    /**
     * Returns the associated Heating Type
     * @return \App\Models\ReferenceModel
     */
    public function getHeatingTypeAttribute()
    {
        return $this->heatingsTypes()->get($this->heating_type_id);
    }

    /**
     * Returns the associated Water Type
     * @return \App\Models\ReferenceModel
     */
    public function getWaterTypeAttribute()
    {
        return $this->waterTypes()->get($this->water_type_id);
    }

    /**
     * Returns the associated Medical Insurance
     * @return \App\Models\ReferenceModel
     */
    public function getMedicalInsuranceAttribute()
    {
        return $this->medicalInsurances()->get($this->medical_insurance_id);
    }

    /**
     * Sets the associated Medical Insurance
     * @param \App\Models\ReferenceModel $value
     */
    public function setDocTypeAttribute(\App\Models\ReferenceModel $value)
    {
        $this->doc_type_id = $value->id();
    }

    /**
     * Sets the associated Medical Insurance
     * @param \App\Models\ReferenceModel $value
     */
    public function setHomeTypeAttribute(\App\Models\ReferenceModel $value)
    {
        $this->home_type_id = $value->id();
    }

    /**
     * Sets the associated Medical Insurance
     * @param \App\Models\ReferenceModel $value
     */
    public function setHeatingTypeAttribute(\App\Models\ReferenceModel $value)
    {
        $this->heating_type_id = $value->id();
    }

    /**
     * Sets the associated Medical Insurance
     * @param \App\Models\ReferenceModel $value
     */
    public function setWaterTypeAttribute(\App\Models\ReferenceModel $value)
    {
        $this->water_type_id = $value->id();
    }

    /**
     * Sets the associated Medical Insurance
     * @param \App\Models\ReferenceModel $value
     */
    public function setMedicalInsuranceAttribute(\App\Models\ReferenceModel $value)
    {
        $this->medical_insurance_id = $value->id();
    }
}
