<?php

namespace Tests\Feature;

use App\Policies\ClinicalRecordsPolicy;
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
    public function medic_role_can_view_clinical_records()
    {
        $policy = new ClinicalRecordsPolicy();
        $this->assertTrue($policy->view($this->medicUser), 'It should be able to View Clinical Records');
    }

    /** @test */
    public function medic_role_can_create_clinical_records()
    {
        $policy = new ClinicalRecordsPolicy();
        $this->assertTrue($policy->create($this->medicUser), 'It should be able to Create Clinical Records');
    }

    /** @test */
    public function medic_role_can_update_clinical_records()
    {
        $policy = new ClinicalRecordsPolicy();
        $this->assertTrue($policy->update($this->medicUser), 'It should be able to Update Clinical Records');
    }

    /** @test */
    public function medic_role_cannot_delete_clinical_records()
    {
        $policy = new ClinicalRecordsPolicy();
        $this->assertFalse($policy->delete($this->medicUser), 'It should not be able to Delete Clinical Records');
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
    public function receptionist_role_can_view_clinical_records()
    {
        $policy = new ClinicalRecordsPolicy();
        $this->assertFalse($policy->view($this->receptionistUser), 'It should not be able to View Clinical Records');
    }

    /** @test */
    public function receptionist_role_can_create_clinical_records()
    {
        $policy = new ClinicalRecordsPolicy();
        $this->assertFalse($policy->create($this->receptionistUser), 'It should not be able to Create Clinical Records');
    }

    /** @test */
    public function receptionist_role_can_update_clinical_records()
    {
        $policy = new ClinicalRecordsPolicy();
        $this->assertFalse($policy->update($this->receptionistUser), 'It should not be able to Update Clinical Records');
    }

    /** @test */
    public function receptionist_role_cannot_delete_clinical_records()
    {
        $policy = new ClinicalRecordsPolicy();
        $this->assertFalse($policy->delete($this->receptionistUser), 'It should not be able to Delete Clinical Records');
    }

    /** @before */
    protected function setUpPolicies()
    {
        $this->policies[] = new PatientsPolicy();
        $this->policies[] = new ClinicalRecordsPolicy();
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

        $role->permissions()->attach($this->createPermission("Patient-{$this->actionView}"));
        $role->permissions()->attach($this->createPermission("Patient-{$this->actionUpdate}"));
        $role->permissions()->attach($this->createPermission("Patient-{$this->actionCreate}"));

        $role->permissions()->attach($this->createPermission("ClinicalRecord-{$this->actionView}"));
        $role->permissions()->attach($this->createPermission("ClinicalRecord-{$this->actionUpdate}"));
        $role->permissions()->attach($this->createPermission("ClinicalRecord-{$this->actionCreate}"));

        $this->medicUser = $this->createUser();
        $this->medicUser->roles()->attach($role);
    }

    /** @before */
    protected function setUpReceptionistUser()
    {
        $role = $this->createRole('Receptionist');
        $role->permissions()->attach($this->createPermission("Patient-{$this->actionView}"));
        $role->permissions()->attach($this->createPermission("Patient-{$this->actionUpdate}"));
        $role->permissions()->attach($this->createPermission("Patient-{$this->actionCreate}"));

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
