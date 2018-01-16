<?php

namespace Tests\Unit;

use App\Permission;
use App\Policies\PatientsPolicy;
use App\Role;
use App\User;
use Tests\Helpers\PatientTestHelper;

class PatientsPolicyTest extends TestCase
{
    use PatientTestHelper;

    /**
     * @var PatientsPolicy
     */
    protected $policy;

    /**
     * @var User
     */
    protected $guestUser;

    /**
     * @var User
     */
    protected $medicUser;

    /**
     * @var \App\Patient
     */
    protected $patient;

    /** @test */
    public function it_does_not_allow_action_when_user_does_not_have_permission()
    {
        foreach ($this->actions() as $action) {
            $this->assertFalse($this->policy->view($this->guestUser, $this->patient), "It should not have the Permission for action {$action}");
        }
    }

    /** @test */
    public function it_allows_action_when_user_has_permission()
    {
        foreach ($this->actions() as $action) {
            $this->assertTrue($this->policy->view($this->medicUser, $this->patient), "It should have the Permission for action {$action}");
        }
    }

    /** @before */
    protected function setUpTestEnviroment()
    {
        $this->policy = new PatientsPolicy();
        $this->patient = $this->createPatient();
        $this->setUpGuestUser()
             ->setUpMedicUser();
    }

    /**
     * Initializes the guestUser with a User that does not have any Permission
     * @return $this
     */
    protected function setUpGuestUser()
    {
        $role = Role::create(['name' => 'Guest']);
        $this->guestUser = factory(User::class)->create();
        $this->guestUser->roles()->attach($role);

        return $this;
    }

    /**
     * Initializes the medicUser with a User that has all the Permissions
     * @return $this
     */
    protected function setUpMedicUser()
    {
        $role = Role::create(['name' => 'Medic']);
        foreach ($this->actions() as $action) {
            $permission = Permission::create(['name' => $action]);
            $role->permissions()->attach($permission);
        }

        $this->medicUser = factory(User::class)->create();
        $this->medicUser->roles()->attach($role);

        return $this;
    }

    /**
     * The available actions on the resource, or the name of the Permissions on the resource
     * @return array
     */
    protected function actions()
    {
        return [
            'Patient-View',
            'Patient-Show',
            'Patient-Create',
            'Patient-Update',
            'Patient-Delete',
        ];
    }
}
