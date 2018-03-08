<?php

namespace Tests\Unit;

use App\DefaultAuthSchema;
use App\Permission;
use App\Role;
use Tests\Helpers\PermissionTestHelper;
use Tests\Helpers\RoleTestHelper;

class DefaultAuthSchemaTest extends TestCase
{
    use PermissionTestHelper, RoleTestHelper;

    /**
     * @var \App\DefaultAuthSchema
     */
    protected $auth_schema;

    /** @test */
    public function it_creates_default_roles_for_the_system()
    {
        $this->auth_schema->createDefaultRoles();
        $this->assertDefaultRoles();
    }

    /** @test */
    public function it_creates_default_permissions_for_the_system()
    {
        $this->auth_schema->createDefaultPermissions();
        $this->assertDefaultPermissions();
    }

    /** @test */
    public function it_does_not_try_to_create_role_if_it_already_exists()
    {
        $this->createRole('Admin');
        $this->auth_schema->createDefaultRoles();
        $this->assertDefaultRoles();
    }

    /** @test */
    public function it_does_not_try_to_create_permission_if_it_already_exists()
    {
        $this->createPermission('Patients-View');
        $this->auth_schema->createDefaultPermissions();
        $this->assertDefaultPermissions();
    }

    /** @test */
    public function it_clears_existent_roles_when_resetting_to_default()
    {
        $this->createRole('Admin');
        $this->createRole('Guest');
        $this->createRole('Some Role');

        $this->auth_schema->resetToDefault();
        $this->assertDefaultRoles();
    }

    /** @test */
    public function it_clears_existent_permissions_when_resetting_to_default()
    {
        $this->createPermission('Patients-View');
        $this->createPermission('Patients-Create');

        $this->auth_schema->resetToDefault();
        $this->assertDefaultPermissions();
    }

    /** @test */
    public function it_creates_default_roles_when_resetting_to_default()
    {
        $this->auth_schema->resetToDefault();
        $this->assertDefaultRoles();
    }

    /** @test */
    public function it_creates_default_permissions_when_resetting_to_default()
    {
        $this->auth_schema->resetToDefault();
        $this->assertDefaultPermissions();
    }

    /** @test */
    public function it_creates_default_permissions_schema_when_resetting_to_default()
    {
        $this->auth_schema->resetToDefault();
        $this->assertDefaultPermissionSchema();
    }

    /** @before */
    public function setUpEnviroment()
    {
        $this->auth_schema = new DefaultAuthSchema();
    }

    /**
     * Checks wether the Roles in the DB are the default
     *
     * @return $this
     */
    protected function assertDefaultRoles()
    {
        $actual = Role::pluck('name')->toArray();
        $expected = ['Admin', 'Guest', 'Medic', 'Recepcionist'];
        $this->assertEquals($expected, $actual);

        return $this;
    }

    /**
     * Checks wether the Permissions in the DB are the default
     *
     * @return $this
     */
    protected function assertDefaultPermissions()
    {
        $actual = Permission::pluck('name')->toArray();

        $this->assertEquals($this->default_permissions(), $actual);

        return $this;
    }

    /**
     * Checks wether the Default Roles have been assigned the Default Permissiosn
     *
     * @return $this
     */
    protected function assertDefaultPermissionSchema()
    {
        $guest = Role::where('name', 'Guest')->firstOrFail();
        $expected = $guest->permissions()->pluck('name')->toArray();
        $this->assertEquals($expected, $this->guest_default_permissions(), 'The Guest Role Permissions are not correctly set');

        $admin = Role::where('name', 'Admin')->firstOrFail();
        $expected = $admin->permissions()->pluck('name')->toArray();
        $this->assertEquals($expected, $this->admin_default_permissions(), 'The Admin Role Permissions are not correctly set');

        $medic = Role::where('name', 'Medic')->firstOrFail();
        $expected = $medic->permissions()->pluck('name')->toArray();
        $this->assertEquals($expected, $this->medic_default_permissions(), 'The Medic Role Permissions are not correctly set');

        $recepcionist = Role::where('name', 'Recepcionist')->firstOrFail();
        $expected = $recepcionist->permissions()->pluck('name')->toArray();
        $this->assertEquals($expected, $this->recepcionist_default_permissions(), 'The Recepcionist Role Permissions are not correctly set');

        return $this;
    }

    /**
     * Returns all the system permissions (Resource-Action convention) for the Admin Role
     *
     * @return array
     */
    protected function admin_default_permissions()
    {
        return $this->default_permissions();
    }

    /**
     * Returns all the system permissions (Resource-Action convention) for the Receptionist Role
     *
     * @return array
     */
    protected function recepcionist_default_permissions()
    {
        return $this->permissions_for_resource('Patients', 'Delete');
    }

    /**
     * Returns all the system permissions (Resource-Action convention) for the Medic Role
     *
     * @return array
     */
    protected function medic_default_permissions()
    {
        return array_merge(
            $this->permissions_for_resource('Patients', 'Delete'),
            $this->permissions_for_resource('MedicalRecords', 'Delete')
        );
    }

    /**
     * Returns all the system permissions (Resource-Action convention) for the Guest Role
     *
     * @return array
     */
    protected function guest_default_permissions()
    {
        return [];
    }

    /**
     * Returns all the permissions for the resource (Resource-Action convention)
     * @param string  $resource
     * @param string  $except [filter for actions]
     *
     * @return array
     */
    protected function permissions_for_resource($resource, $except = '')
    {
        $permissions = [];
        foreach (Permission::actions as $action) {
            if (! preg_match("/$except/i", $action)) {
                $permissions[] = "$resource-$action";
            }
        }

        return $permissions;
    }

    /**
     * Returns all the system permissions (Resource-Action convention)
     *
     * @return array
     */
    protected function default_permissions()
    {
        $permissions = [];
        foreach (Permission::resources as $resource) {
            foreach (Permission::actions as $action) {
                $permissions[] = "$resource-$action";
            }
        }

        return $permissions;
    }

    /**
     * Returns all the roles
     *
     * @return array
     */
    protected function default_roles()
    {
        return ['Admin', 'Guest', 'Medic', 'Recepcionist'];
    }
}
