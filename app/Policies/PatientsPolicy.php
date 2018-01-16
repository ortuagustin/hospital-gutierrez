<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Handles authorization for the Patient Model
 */
class PatientsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the patient.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function view(User $user)
    {
        return $user->hasPermission('Patient-View');
    }

    /**
     * Determine whether the user can create patients.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('Patient-Create');
    }

    /**
     * Determine whether the user can update the patient.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function update(User $user)
    {
        return $user->hasPermission('Patient-Update');
    }

    /**
     * Determine whether the user can delete the patient.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->hasPermission('Patient-Delete');
    }
}
