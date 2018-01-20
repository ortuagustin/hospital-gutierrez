<?php

namespace App;

use App\Contracts\InteractsWithReferenceModels;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * A Model that represents a Patient
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'has_refrigerator' => 'boolean',
        'has_electricity'  => 'boolean',
        'has_pet'          => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'birth_date',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'medicalRecords',
    ];

    /**
     * Returns the Patient's Age
     * @return int
     */
    public function age()
    {
        $today = Carbon::today();

        return ($this->birth_date->diff($today)->y);
    }

    /**
     * Returns the Patient's Age
     * @return int
     */
    public function getAgeAttribute()
    {
        return $this->age();
    }

    /**
     * Returns the birth day followed by the Patient's age
     * @return string
     */
    public function birth_date_with_age()
    {
        return "{$this->birth_date->toDateString()} ($this->age years)";
    }

    /**
     * Returns the birth day followed by the Patient's age
     * @return string
     */
    public function getBirthDateWithAgeAttribute()
    {
        return $this->birth_date_with_age();
    }

    /**
     * @return string
     */
    public function document()
    {
        $doc_type = $this->docType->value();

        return "$this->dni ($doc_type)";
    }

    /**
     * @return string
     */
    public function getDocumentAttribute()
    {
        return $this->document();
    }

    /**
     * @return string
     */
    public function full_name()
    {
        return "$this->last_name, $this->name";
    }

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->full_name();
    }

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
