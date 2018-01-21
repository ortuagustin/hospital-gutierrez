<?php

namespace Database\Seeds;

use App\Contracts\DefaultAuthSchemaInterface;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * @var DefaultAuthSchemaInterface
     */
    private $auth_schema;

    /**
     * @param DefaultAuthSchemaInterface $auth_schema
     */
    public function __construct(DefaultAuthSchemaInterface $auth_schema)
    {
        $this->auth_schema = $auth_schema;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->auth_schema->resetToDefault();
        $this->createUser('admin')
             ->createUser('medic')
             ->createUser('recepcionist');
    }

    protected function createUser($name)
    {
        $user = User::create([
            'name'           => $name,
            'email'          => "$name@example.com",
            'password'       => bcrypt($name),
            'remember_token' => str_random(10),
        ]);

        if ($role = Role::where('name', ucfirst($name))->first()) {
            $user->roles()->attach($role);
        }

        return $this;
    }
}
