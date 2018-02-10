<?php

namespace Database\Seeds;

use App\Contracts\DefaultAuthSchemaInterface;
use App\Role;
use App\User;
use Faker\Generator;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * @var DefaultAuthSchemaInterface
     */
    private $auth_schema;

    /**
     * @var Generator
     */
    private $faker;

    /**
     * @param Generator                  $faker
     * @param DefaultAuthSchemaInterface $auth_schema
     */
    public function __construct(Generator $faker, DefaultAuthSchemaInterface $auth_schema)
    {
        $this->faker = $faker;
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
        $this->createUser('admin', 'Admin')
             ->createUser('medic', 'Medic')
             ->createUser('guest', 'Guest')
             ->createUser($this->faker->name, 'Medic')
             ->createUser($this->faker->name, 'Medic')
             ->createUser('recepcionist', 'Recepcionist')
             ->createUser($this->faker->name, 'Recepcionist');
    }

    /**
     * @param string $name
     * @param string $role
     * @return $this
     */
    protected function createUser($name, $role)
    {
        $user = User::create([
            'name'           => $name,
            'email'          => "$name@example.com",
            'password'       => bcrypt($name),
            'remember_token' => str_random(10),
        ]);

        if ($role = Role::where('name', $role)->first()) {
            $user->roles()->attach($role);
        }

        return $this;
    }
}
