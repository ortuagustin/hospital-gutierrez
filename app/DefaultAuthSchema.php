<?php

namespace App;

use App\Contracts\DefaultAuthSchemaInterface;
use App\Permission;
use App\Role;

/**
 * Generates the default authorization schema for the application;
 * that is, it can create all the required Roles, Permissions and grant access to
 * each role accordingly
 */
class DefaultAuthSchema implements DefaultAuthSchemaInterface
{
    /**
     * Clears all Roles and Permissions
     * Creates the default set of Roles
     * Creates the default set of Permissions
     * Creates the default Role-Permission schema
     */
    public function resetToDefault()
    {
        Role::getQuery()->delete();
        Permission::getQuery()->delete();

        $this->createDefaultRoles();
        $this->createDefaultPermissions();
        $this->createDefaultPermissionSchema();
    }

    /**
     * Creates the default Roles for the system, only if they dont exist
     */
    public function createDefaultRoles()
    {
        Role::firstOrCreate(['name' => 'Admin']);
        Role::firstOrCreate(['name' => 'Guest']);
        Role::firstOrCreate(['name' => 'Medic']);
        Role::firstOrCreate(['name' => 'Recepcionist']);
    }

    /**
     * Creates the default Permissions for the system, only if they dont exist
     */
    public function createDefaultPermissions()
    {
        foreach (Permission::resources as $resource) {
            foreach (Permission::actions as $action) {
                Permission::firstOrCreate(['name' => "$resource-$action"]);
            }
        }
    }

    /**
     * Assigns the default Permissions Schema to the default Roles
     */
    protected function createDefaultPermissionSchema()
    {
        $this->grantAccessToAdmin(Role::where('name', 'Admin')->first())
             ->grantAccessToMedics(Role::where('name', 'Medic')->first())
             ->grantAccessToRecepcionist(Role::where('name', 'Recepcionist')->first());
    }

    /**
     * Admins has access to everything
     * @param \App\Role $role
     * @return $this
     */
    protected function grantAccessToAdmin(Role $role)
    {
        $permissions = Permission::pluck('id');
        $role->permissions()->attach($permissions);

        return $this;
    }

    /**
     * Medics can create, update and view Patients and MedicalRecords
     * @param \App\Role $role
     * @return $this
     */
    protected function grantAccessToMedics(Role $role)
    {
        return $this->grantPermissions($role, 'Patients')
                    ->grantPermissions($role, 'MedicalRecords');
    }

    /**
     * Recepcionists can only create, update and view Patients
     * @param \App\Role $role
     * @return $this
     */
    protected function grantAccessToRecepcionist(Role $role)
    {
        return $this->grantPermissions($role, 'Patients');
    }

    /**
     * Addds all permissions to the Role for the given resource, except Delete
     * @param \App\Role $role
     * @param string    $resource
     * @return $this
     */
    protected function grantPermissions(Role $role, $resource)
    {
        $permissions = Permission::where('name', 'like', "$resource%")->get()
        ->reject(function ($value, $key) {
            return preg_match('/Delete/i', $value->name);
        });

        $role->permissions()->attach($permissions);


        return $this;
    }
}
