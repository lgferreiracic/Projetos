<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SamplingPoint;
use Faker\Generator as Faker;

$auto_increment = sp_increment();

$factory->define(SamplingPoint::class, function (Faker $faker) use ($auto_increment) {
	$auto_increment->next();

	return [
		'label' => $auto_increment->current(),
		'ini_period' => $faker->numberBetween($min = 1, $max = 17),
		'status' => true,
		'geolocation_id' => factory(App\Models\Geolocation::class)->create()->id
	];
});

$increment = 1;

function sp_increment()
{
	for ($i = 0; $i < 1000; $i++) {
		yield $i;

		if ($i === 10) {
			$i = 0;
		}
	}
}
