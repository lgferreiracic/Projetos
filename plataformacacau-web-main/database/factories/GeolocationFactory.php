<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Geolocation;
use Faker\Generator as Faker;

$factory->define(Geolocation::class, function (Faker $faker) {
	return [
		// 'latitude' => $faker->latitude($min = -90, $max = 90),
		'latitude' => $faker->latitude($min = -15.01, $max = -14.70),
		'longitude' => $faker->longitude($min = -39.40, $max = -39.07),
		'ratio' => 2.5,
	];
});
