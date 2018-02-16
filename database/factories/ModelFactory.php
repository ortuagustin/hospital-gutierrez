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

use Carbon\Carbon;

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
      'doc_type_id'          => $faker->numberBetween(1, 4),
      'home_type_id'         => $faker->numberBetween(1, 3),
      'heating_type_id'      => $faker->numberBetween(1, 3),
      'water_type_id'        => $faker->numberBetween(1, 2),
      'medical_insurance_id' => $faker->numberBetween(1, 3),
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

$factory->define(App\Appointment::class, function (Faker\Generator $faker, $attributes) {
    $patient_id = isset($attributes['patient_id']) ? $attributes['patient_id']: factory(App\Patient::class)->create()->id;

    return [
        'patient_id'     => $patient_id,
        'date'           => Carbon::create(null, null, null, 10, 0, 0),
    ];
});

$factory->define(App\ApplicationSetting::class, function (Faker\Generator $faker) {
    return [
        'key'        => $faker->unique()->slug,
        'value'      => $faker->unique()->isbn10,
        'input_type' => 'text',
    ];
});

$factory->define(App\MedicalRecord::class, function (Faker\Generator $faker, $attributes) {
    $paragraph = $faker->paragraph();
    $patient_id = isset($attributes['patient_id']) ? $attributes['patient_id']: factory(App\Patient::class)->create()->id;
    $user_id = isset($attributes['user_id']) ? $attributes['user_id']: factory(App\User::class)->create()->id;

    return [
            'patient_id'                    => $patient_id,
            'user_id'                       => $user_id,
            'fecha'                         => $faker->dateTimeThisDecade(),
            'peso'                          => $faker->randomFloat(),
            'talla'                         => $faker->randomFloat(),
            'percentilo_cefalico'           => $faker->randomFloat(),
            'percentilo_perimetro_cefalico' => $faker->randomFloat(),
            'alimentacion_observaciones'    => $paragraph,
            'vacunas_completas'             => $faker->boolean(),
            'vacunas_observaciones'         => $paragraph,
            'maduracion_acorde'             => $faker->boolean(),
            'maduracion_observaciones'      => $paragraph,
            'examen_fisico_normal'          => $faker->boolean(),
            'examen_fisico_observaciones'   => $paragraph,
            'observaciones'                 => $paragraph,
    ];
});
