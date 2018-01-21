<?php

namespace Database\Seeds;

use App\Permission;
use App\Role;

class PermissionRoleSeeder extends ApplicationSeeder
{
    /**
     * Admins has access to everything
     * @param \App\Role $role
     */
    protected function seedAdminRole(Role $role)
    {
        $permissions = Permission::pluck('id');
        $role->permissions()->attach($permissions);

        return $this;
    }

    /**
     * Addds all permissions to the Role for the given resource, except Delete
     * @param Role  $role
     * @param string $resource
     */
    protected function seedActions(Role $role, $resource)
    {
        $permissions = Permission::where('name', 'like', "$resource%")->get()
            ->reject(function ($value, $key) {
                return preg_match('/Delete/i', $value->name);
            });

        $role->permissions()->attach($permissions);


        return $this;
    }

    /**
     * Medics can create, update and view Patients and ClinicalRecords
     * @param \App\Role $role
     */
    protected function seedMedicRole($role)
    {
        return $this->seedActions($role, 'Patient')
                    ->seedActions($role, 'ClinicalRecord');
    }

    /**
     * Recepcionists can only create, update and view Patients
     * @param \App\Role $role
     */
    protected function seedRecepcionistRole($role)
    {
        return $this->seedActions($role, 'Patient');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedAdminRole(Role::where('name', 'Admin')->first())
             ->seedMedicRole(Role::where('name', 'Medic')->first())
             ->seedRecepcionistRole(Role::where('name', 'Recepcionist')->first());
    }
}
