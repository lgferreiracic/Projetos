<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Mature;
use Faker\Generator as Faker;

$factory->define(Mature::class, function (Faker $faker) {
	return [
		'total' => $faker->numberBetween($min = 0, $max = 25),
		'harvested' => $faker->numberBetween($min = 0, $max = 20),
		'rotten' => $faker->randomDigit,
		'rat' => $faker->randomDigit,
		'witchs_broom' => $faker->randomDigit,
		'loss' => $faker->randomDigit,
	];
});
