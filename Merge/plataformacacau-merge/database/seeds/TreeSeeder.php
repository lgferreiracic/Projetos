<?php

use Illuminate\Database\Seeder;

class TreeSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$users = App\User::all();
		$sampling_points = App\Models\SamplingPoint::all();
		$limiter = 0;

		factory(
			App\Models\VisitInformation::class,
			$sampling_points->count() * 3
		)->create();

		foreach ($sampling_points as $key => $sampling_point) {
			$trees = factory(App\Models\Tree::class, 6)->create([
				'sampling_point_id' => $sampling_point->id
			]);

			$visit_info = App\Models\VisitInformation::find($key + 1);

			foreach ($trees as $tree) {
				factory(App\Models\TreeVisit::class)
					->create([
						'tree_id' => $tree->id,
						'visit_information_id' => $visit_info->id,
						'user_id' => $users->random(1, 3)->first()->id,
						'geolocation_id' => factory(App\Models\Geolocation::class)
							->create()->id
					]);
			}
		}

		foreach ($sampling_points as $key => $sampling_point) {
			$visit_info = App\Models\VisitInformation::find($key + 31);

			for ($i = 0; $i < 6; $i++, $limiter++) {
				$tree = App\Models\Tree::find($limiter + 1);
				factory(App\Models\TreeVisit::class)
					->create([
						'tree_id' => $tree->id,
						'visit_information_id' => $visit_info->id,
						'user_id' => $users->random(1, 3)->first()->id,
						'geolocation_id' => factory(App\Models\Geolocation::class)
							->create()->id
					]);
			}
		}
	}
}
