<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Stratum;
use Faker\Generator as Faker;

$factory->define(Stratum::class, function (Faker $faker) {
	$strata = $faker->unique()->randomElement([
		'Norte',
		'Sul',
		'Central',
		'Nordeste',
		'Sudeste'
	]);

	return [
		'label' => $strata,
		'status' => true
	];
});
