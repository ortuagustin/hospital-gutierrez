<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Patient::class, function (Faker\Generator $faker) {
    return [
      'doc_type_id'          => 1,
      'home_type_id'         => 1,
      'heating_type_id'      => 1,
      'water_type_id'        => 1,
      'medical_insurance_id' => 1,
      'name'                 => $faker->unique()->name,
      'last_name'            => $faker->unique()->name,
      'dni'                  => $faker->unique()->numerify('########'),
      'birth_date'           => $faker->dateTimeInInterval(),
      'gender'               => $faker->randomElement(['male', 'female']),
      'address'              => $faker->address(),
      'phone'                => $faker->e164PhoneNumber(),
      'has_refrigerator'     => $faker->boolean(),
      'has_electricity'      => $faker->boolean(),
      'has_pet'              => $faker->boolean(),
    ];
});

$factory->define(App\Appointment::class, function (Faker\Generator $faker) {
    return [
        'patient_id'     => factory(App\Patient::class)->create()->id,
        'date'           => $faker->dateTime(),
    ];
});

$factory->define(App\ApplicationSetting::class, function (Faker\Generator $faker) {
    return [
        'key'   => $faker->unique()->slug,
        'value' => $faker->unique()->isbn10,
    ];
});
