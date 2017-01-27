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
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('materatetest'),
        'remember_token' => str_random(10),
        'is_admin' => $faker->is_admin,
        'removed' => $faker->removed,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\SessionLog::class, function (Faker\Generator $faker) {

    return [
        'loginDate' => $faker->loginDate,
        'logoutDate' => $faker->logoutDate,
        'user_id' => $faker->logoutDatuser_id
    ];
});
