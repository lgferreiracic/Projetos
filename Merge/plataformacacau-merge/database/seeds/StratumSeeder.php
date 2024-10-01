<?php

use App\Models\SamplingPoint;
use App\User;
use Illuminate\Database\Seeder;

class StratumSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$collectors = User::whereHas(
			'roles',
			function ($roles) {
				$roles->where('label', 'collector');
			}
		)->get();

		factory(App\Models\Stratum::class, 3)
			->create()
			->each(function ($stratum) {
				$property = factory(App\Models\Property::class)
					->create();

				$stratum->sampling_points()->createMany(
					factory(App\Models\SamplingPoint::class, 10)
						->make(['property_id' => $property->id])
						->toArray()
				);
			});

		$sampling_points = SamplingPoint::all();
		foreach ($collectors as $collector) {
			$collector->sampling_points()->attach($sampling_points->random(10));
		}
	}
}
