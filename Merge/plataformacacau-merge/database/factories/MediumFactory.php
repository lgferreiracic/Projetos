<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Medium;
use Faker\Generator as Faker;

$factory->define(Medium::class, function (Faker $faker) {
	return [
		'total' => $faker->numberBetween($min = 0, $max = 25),
		'rotten' => $faker->randomDigit,
		'rat' => $faker->randomDigit,
		'witchs_broom' => $faker->randomDigit,
		'loss' => $faker->randomDigit,
		'piece' => $faker->randomDigit,
	];
});
