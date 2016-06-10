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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Tower::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'state' => $faker->state,
        'city' => $faker->state,
        'address' => $faker->state,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'description' => $faker->text,
        'active' => 1,
    ];
});
