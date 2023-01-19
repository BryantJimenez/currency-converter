<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Currency\Currency;
use App\Models\Currency\Exchange;
use Faker\Generator as Faker;

$factory->define(Exchange::class, function (Faker $faker) {
	$currency=Currency::inRandomOrder()->first();
	$currencies=Currency::where('id', '!=', $currency->id)->get()->pluck('id');
    return [
        'conversion_rate' => $faker->randomFloat(2, 0, 20),
        'currency_id' => $currency->id,
        'currency_exchange_id' => $faker->randomElement($currencies)
    ];
});
