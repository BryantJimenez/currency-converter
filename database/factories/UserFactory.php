<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Country;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $countries=Country::all()->pluck('id');
    return [
        'name' => $faker->name,
        'lastname' => $faker->lastname,
        'dni' => $faker->unique()->numberBetween($min=10000000, $max=99999999),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'phone' => $faker->numberBetween($min=10000000, $max=99999999),
        'address' => $faker->address,
        'password' => Hash::make('12345678'),
        'remember_token' => Str::random(10),
        'state' => $faker->randomElement(['1', '0']),
        'user_role' => $faker->randomElement(['Super Admin', 'Administrador', 'Cliente']),
        'custom_permissions' => $faker->randomElement(['1', '0']),
        'country_id' => $faker->randomElement($countries)
    ];
});
