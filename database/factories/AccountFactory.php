<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Account;
use Faker\Generator as Faker;

$factory->define(Account::class, function (Faker $faker) {
	$users=User::all()->pluck('id');
    return [
    	'number' => $faker->creditCardNumber,
        'bank' => $faker->company,
        'state' => $faker->randomElement(['1', '0']),
        'user_id' => $faker->randomElement($users)
    ];
});
