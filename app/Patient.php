<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * a model that represents a Patient
 */
class Patient extends Model
{
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
}
