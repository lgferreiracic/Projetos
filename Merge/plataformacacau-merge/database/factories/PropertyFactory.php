<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Property;
use Faker\Generator as Faker;

$factory->define(Property::class, function (Faker $faker) {
	$cities = $faker->randomElement([
		'Itabuna',
		'Itajuípe',
		'Buerarema',
		'Itapé',
		'Barro Preto',
		'Uruçuca',
		'Ilhéus',
		'São José da Vitória',
		'Coaraci',
		'Ibicaraí',
		'Almadina',
		'Floresta Azul',
		'Jussari',
		'Aurelino Leal',
	]);

	return [
		'name' => $faker->company,
		'owner_name' => $faker->firstName,
		'description' => $faker->realText($maxNbChars = 50, $indexSize = 2),
		'city' => $cities,
		'uf' => 'BA'
	];
});
