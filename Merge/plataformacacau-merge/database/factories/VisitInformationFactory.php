<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\VisitInformation;
use Faker\Generator as Faker;

$factory->define(VisitInformation::class, function (Faker $faker) {
	return [
		'date' => $faker->date($format = 'Y-m-d H:i:s', $max = 'now'),
		'note' => $faker->text($maxNbChars = 50),
		'flowering' => $faker->numberBetween($min = 0, $max = 2),
		'refoliation' => $faker->numberBetween($min = 0, $max = 2),
		'top' => $faker->numberBetween($min = 0, $max = 2),
		'pruned' => ($faker->boolean($chanceOfGettingTrue = 50) == false) ? 0 : 1,
		'mowing' => ($faker->boolean($chanceOfGettingTrue = 50) == false) ? 0 : 1,
		'weeding' => ($faker->boolean($chanceOfGettingTrue = 50) == false) ? 0 : 1,
		'grated' => ($faker->boolean($chanceOfGettingTrue = 50) == false) ? 0 : 1,
		'renewed' => ($faker->boolean($chanceOfGettingTrue = 50) == false) ? 0 : 1,
		'fertilized' => ($faker->boolean($chanceOfGettingTrue = 50) == false) ? 0 : 1,
		'pulverized' => ($faker->boolean($chanceOfGettingTrue = 50) == false) ? 0 : 1,
		'unbounded' => ($faker->boolean($chanceOfGettingTrue = 50) == false) ? 0 : 1,
		'wind' => ($faker->boolean($chanceOfGettingTrue = 50) == false) ? 0 : 1,
		'brown_rot' => ($faker->boolean($chanceOfGettingTrue = 50) == false) ? 0 : 1,
		'drought' => ($faker->boolean($chanceOfGettingTrue = 50) == false) ? 0 : 1,
		'rain' => ($faker->boolean($chanceOfGettingTrue = 50) == false) ? 0 : 1,
		'rat' => ($faker->boolean($chanceOfGettingTrue = 50) == false) ? 0 : 1,
		'flood' => ($faker->boolean($chanceOfGettingTrue = 50) == false) ? 0 : 1,
		'insect' => ($faker->boolean($chanceOfGettingTrue = 50) == false) ? 0 : 1,
		'absence_of_shadow' => ($faker->boolean($chanceOfGettingTrue = 50) == false) ? 0 : 1,
		'excess_shade' => ($faker->boolean($chanceOfGettingTrue = 50) == false) ? 0 : 1,
	];
});
