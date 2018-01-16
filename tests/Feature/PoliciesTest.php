<?php

namespace Tests\Feature;

use App\Policies\PatientsPolicy;
use Tests\Helpers\PermissionTestHelper;
use Tests\Helpers\RoleTestHelper;
use Tests\Helpers\UserTestHelper;

class PoliciesTest extends FeatureTest
{
    use UserTestHelper;
    use PermissionTestHelper;
    use RoleTestHelper;

    /**
     * @var string
     */
    protected $actionView = 'View';

    /**
     * @var string
     */
    protected $actionCreate = 'Create';

    /**
     * @var string
     */
    protected $actionUpdate = 'Update';

    /**
     * @var string
     */
    protected $actionDelete = 'Delete';

    /**
     * @var array
     */
    protected $policies = [];

    /**
     * @var \App\User
     */
    protected $guestUser;

    /**
     * @var \App\User
     */
    protected $medicUser;

    /**
     * @var \App\User
     */
    protected $adminUser;

    /**
     * @var \App\User
     */
    protected $receptionistUser;

    /** @test */
    public function admin_role_should_be_authorized_on_all_actions()
    {
        foreach ($this->policies as $policy) {
            $policyClass = get_class($policy);
            $this->assertTrue($policy->view($this->adminUser), "It should be able to View --> {$policyClass}");
            $this->assertTrue($policy->create($this->adminUser), "It should be able to Create --> {$policyClass}");
            $this->assertTrue($policy->update($this->adminUser), "It should be able to Update --> {$policyClass}");
            $this->assertTrue($policy->delete($this->adminUser), "It should be able to Delete --> {$policyClass}");
        }
    }

    /** @test */
    public function guest_role_should_be_unauthorized_on_all_actions()
    {
        foreach ($this->policies as $policy) {
            $policyClass = get_class($policy);
            $this->assertFalse($policy->view($this->guestUser), "It should not be able to View --> {$policyClass}");
            $this->assertFalse($policy->create($this->guestUser), "It should not be able to Create --> {$policyClass}");
            $this->assertFalse($policy->update($this->guestUser), "It should not be able to Update --> {$policyClass}");
            $this->assertFalse($policy->delete($this->guestUser), "It should not be able to Delete --> {$policyClass}");
        }
    }

    /** @test */
    public function medic_role_can_view_patients()
    {
        $policy = new PatientsPolicy();
        $this->assertTrue($policy->view($this->medicUser), 'It should be able to View Patients');
    }

    /** @test */
    public function medic_role_can_create_patients()
    {
        $policy = new PatientsPolicy();
        $this->assertTrue($policy->create($this->medicUser), 'It should be able to Create Patients');
    }

    /** @test */
    public function medic_role_can_update_patients()
    {
        $policy = new PatientsPolicy();
        $this->assertTrue($policy->update($this->medicUser), 'It should be able to Update Patients');
    }

    /** @test */
    public function medic_role_cannot_delete_patients()
    {
        $policy = new PatientsPolicy();
        $this->assertFalse($policy->delete($this->medicUser), 'It should not be able to Delete Patients');
    }

    /** @test */
    public function receptionist_role_can_view_patients()
    {
        $policy = new PatientsPolicy();
        $this->assertTrue($policy->view($this->receptionistUser), 'It should be able to View Patients');
    }

    /** @test */
    public function receptionist_role_can_create_patients()
    {
        $policy = new PatientsPolicy();
        $this->assertTrue($policy->create($this->receptionistUser), 'It should be able to Create Patients');
    }

    /** @test */
    public function receptionist_role_can_update_patients()
    {
        $policy = new PatientsPolicy();
        $this->assertTrue($policy->update($this->receptionistUser), 'It should be able to Update Patients');
    }

    /** @test */
    public function receptionist_role_cannot_delete_patients()
    {
        $policy = new PatientsPolicy();
        $this->assertFalse($policy->delete($this->receptionistUser), 'It should not be able to Delete Patients');
    }

    /** @before */
    protected function setUpTestEnviroment()
    {
        $this->policies[] = new PatientsPolicy();
        $this->setUpGuestUser()
             ->setUpReceptionistUser()
             ->setUpAdminUser()
             ->setUpMedicUser();
    }

    /**
     * Initializes the guestUser with a User that does not have any Permission
     * @return $this
     */
    protected function setUpGuestUser()
    {
        $role = $this->createRole('Guest');
        $this->guestUser = $this->createUser();
        $this->guestUser->roles()->attach($role);

        return $this;
    }

    /**
     * Initializes the medicUser with a User according the system specs
     * @return $this
     */
    protected function setUpMedicUser()
    {
        $role = $this->createRole('Medic');
        $role->permissions()->attach($this->createPermission("Patient-{$this->actionView}"));
        $role->permissions()->attach($this->createPermission("Patient-{$this->actionUpdate}"));
        $role->permissions()->attach($this->createPermission("Patient-{$this->actionCreate}"));

        $this->medicUser = $this->createUser();
        $this->medicUser->roles()->attach($role);

        return $this;
    }

    /**
     * Initializes the receptionistUser with a User according the system specs
     * @return $this
     */
    protected function setUpReceptionistUser()
    {
        $role = $this->createRole('Receptionist');
        $role->permissions()->attach($this->createPermission("Patient-{$this->actionView}"));
        $role->permissions()->attach($this->createPermission("Patient-{$this->actionUpdate}"));
        $role->permissions()->attach($this->createPermission("Patient-{$this->actionCreate}"));

        $this->receptionistUser = $this->createUser();
        $this->receptionistUser->roles()->attach($role);

        return $this;
    }

    /**
     * Initializes the adminUser with a User that has all the Permissions
     * @return $this
     */
    protected function setUpAdminUser()
    {
        $role = $this->createRole('Admin');
        foreach ($this->resources() as $resource) {
            foreach ($this->actions($resource) as $action) {
                $permission = $this->createPermission($action);
                $role->permissions()->attach($permission);
            }
        }

        $this->adminUser = $this->createUser();
        $this->adminUser->roles()->attach($role);

        return $this;
    }

    /**
     * All the resources names (singularized, capitalized) with policies under test
     * @return array
     */
    protected function resources()
    {
        return [
            'Patient',
        ];
    }

    /**
     * The available actions on the resource, or the name of the Permissions on the resource
     * @param string $resource
     * @return array
     */
    protected function actions($resource)
    {
        return [
            "{$resource}-{$this->actionView}",
            "{$resource}-{$this->actionUpdate}",
            "{$resource}-{$this->actionDelete}",
            "{$resource}-{$this->actionCreate}",
        ];
    }
}
