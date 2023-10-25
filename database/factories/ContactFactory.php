<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
	$user=User::where('user_role', 'Cliente')->inRandomOrder()->first();
	$users=User::where([['id', '!=', $user->id], ['user_role', 'Cliente']])->get()->pluck('id');
    return [
        'alias' => $faker->word,
        'user_id' => $user->id,
        'user_destination_id' => $faker->randomElement($users)
    ];
});
