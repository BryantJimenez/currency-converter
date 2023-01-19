<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
	$user=User::role(['Cliente'])->inRandomOrder()->first();
	$users=User::role(['Cliente'])->where('id', '!=', $user->id)->get()->pluck('id');
    return [
        'alias' => $faker->word,
        'user_id' => $user->id,
        'user_destination_id' => $faker->randomElement($users)
    ];
});
