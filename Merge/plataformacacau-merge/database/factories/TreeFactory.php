<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tree;
use Faker\Generator as Faker;

$auto_increment = tree_increment();

$factory->define(Tree::class, function (Faker $faker) use ($auto_increment) {
	$auto_increment->next();

	return [
		'label' => $auto_increment->current(),
		'status' => true
	];
});

function tree_increment()
{
	for ($i = 0; $i < 1000; $i++) {
		yield $i;

		if ($i === 6) {
			$i = 0;
		}
	}
}
