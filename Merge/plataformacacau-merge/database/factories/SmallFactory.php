<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Small;
use Faker\Generator as Faker;

$factory->define(Small::class, function (Faker $faker) {
	return [
		'total' => $faker->numberBetween($min = 0, $max = 25),
		'witchs_broom' => $faker->randomDigit,
		'loss' => $faker->randomDigit,
		'piece' => $faker->randomDigit,
	];
});
