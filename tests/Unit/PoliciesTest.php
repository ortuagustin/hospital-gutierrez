<?php

namespace Tests\Unit;

use App\Policies\MedicalRecordsPolicy;
use App\Policies\PatientsPolicy;
use Tests\Helpers\PermissionTestHelper;
use Tests\Helpers\RoleTestHelper;
use Tests\Helpers\UserTestHelper;

class PoliciesTest extends TestCase
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
     * The application policies under test
     * @var array
     */
    protected $policies = [];

    /**
     * A User with the Guest Role, that hasn't any Permission at all
     * @var \App\User
     */
    protected $guestUser;

    /**
     * A User with the Admin Role, that has full access to every Action on any Resource
     * @var \App\User
     */
    protected $adminUser;

    /**
     * A User with the Medic Role, that has limited access privileges
     * @var \App\User
     */
    protected $medicUser;

    /**
     * A User with the Recepcionist Role, that has limited access privileges
     * @var \App\User
     */
    protected $receptionistUser;

    /** @test */
    public function admin_role_should_be_authorized_on_all_actions()
    {
        foreach ($this->policies as $policy) {
            $policyClass = get_class($policy);
            $this->assertTrue($policy->index($this->adminUser), "It should be able to Index --> {$policyClass}");
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
            $this->assertFalse($policy->index($this->guestUser), "It should not be able to Index --> {$policyClass}");
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
    public function medic_role_can_view_medical_records()
    {
        $policy = new MedicalRecordsPolicy();
        $this->assertTrue($policy->view($this->medicUser), 'It should be able to View Medical Records');
    }

    /** @test */
    public function medic_role_can_create_medical_records()
    {
        $policy = new MedicalRecordsPolicy();
        $this->assertTrue($policy->create($this->medicUser), 'It should be able to Create Medical Records');
    }

    /** @test */
    public function medic_role_can_update_medical_records()
    {
        $policy = new MedicalRecordsPolicy();
        $this->assertTrue($policy->update($this->medicUser), 'It should be able to Update Medical Records');
    }

    /** @test */
    public function medic_role_cannot_delete_medical_records()
    {
        $policy = new MedicalRecordsPolicy();
        $this->assertFalse($policy->delete($this->medicUser), 'It should not be able to Delete Medical Records');
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

    /** @test */
    public function receptionist_role_can_view_medical_records()
    {
        $policy = new MedicalRecordsPolicy();
        $this->assertFalse($policy->view($this->receptionistUser), 'It should not be able to View Medical Records');
    }

    /** @test */
    public function receptionist_role_can_create_medical_records()
    {
        $policy = new MedicalRecordsPolicy();
        $this->assertFalse($policy->create($this->receptionistUser), 'It should not be able to Create Medical Records');
    }

    /** @test */
    public function receptionist_role_can_update_medical_records()
    {
        $policy = new MedicalRecordsPolicy();
        $this->assertFalse($policy->update($this->receptionistUser), 'It should not be able to Update Medical Records');
    }

    /** @test */
    public function receptionist_role_cannot_delete_medical_records()
    {
        $policy = new MedicalRecordsPolicy();
        $this->assertFalse($policy->delete($this->receptionistUser), 'It should not be able to Delete Medical Records');
    }

    /** @before */
    protected function setUpPolicies()
    {
        $this->policies[] = new PatientsPolicy();
        $this->policies[] = new MedicalRecordsPolicy();
    }

    /** @before */
    protected function setUpGuestUser()
    {
        $role = $this->createRole('Guest');
        $this->guestUser = $this->createUser();
        $this->guestUser->roles()->attach($role);
    }

    /** @before */
    protected function setUpMedicUser()
    {
        $role = $this->createRole('Medic');

        $role->permissions()->attach($this->createPermission("Patients-{$this->actionView}"));
        $role->permissions()->attach($this->createPermission("Patients-{$this->actionUpdate}"));
        $role->permissions()->attach($this->createPermission("Patients-{$this->actionCreate}"));

        $role->permissions()->attach($this->createPermission("MedicalRecords-{$this->actionView}"));
        $role->permissions()->attach($this->createPermission("MedicalRecords-{$this->actionUpdate}"));
        $role->permissions()->attach($this->createPermission("MedicalRecords-{$this->actionCreate}"));

        $this->medicUser = $this->createUser();
        $this->medicUser->roles()->attach($role);
    }

    /** @before */
    protected function setUpReceptionistUser()
    {
        $role = $this->createRole('Receptionist');

        $role->permissions()->attach($this->createPermission("Patients-{$this->actionView}"));
        $role->permissions()->attach($this->createPermission("Patients-{$this->actionUpdate}"));
        $role->permissions()->attach($this->createPermission("Patients-{$this->actionCreate}"));

        $this->receptionistUser = $this->createUser();
        $this->receptionistUser->roles()->attach($role);
    }

    /** @before */
    protected function setUpAdminUser()
    {
        $role = $this->createRole('Admin');
        $this->adminUser = $this->createUser();
        $this->adminUser->roles()->attach($role);
    }
}
