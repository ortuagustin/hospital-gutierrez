<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * A Model that represents a User Permission
 */
class Permission extends Model
{
    /**
     * @var array
     */
    const actions = ['View', 'Create', 'Update', 'Delete'];

    /**
     * @var array
     */
    const resources = ['Patients', 'Roles', 'Permissions', 'MedicalRecords'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * A Permission may be assigned to many Roles
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * A Permission may be assigned to many Users
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
