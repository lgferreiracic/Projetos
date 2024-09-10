<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TreeVisit;
use Faker\Generator as Faker;

$factory->define(TreeVisit::class, function (Faker $faker) {
	return [
		'bobbin_id' => factory(App\Models\Bobbin::class)->create()->id,
		'small_id' => factory(App\Models\Small::class)->create()->id,
		'medium_id' => factory(App\Models\Medium::class)->create()->id,
		'adult_id' => factory(App\Models\Adult::class)->create()->id,
		'mature_id' => factory(App\Models\Mature::class)->create()->id,
	];
});
