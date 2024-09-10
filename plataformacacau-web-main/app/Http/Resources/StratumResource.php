<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Resources\Json\JsonResource;

class StratumResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request)
	{
		$data = [
			'id' => $this->id,
			'label' => $this->label,
			'homogeneous_area' => new HomogeneousAreaResource($this->homogeneous_area),
			'stratum_tree_range' => $this->when(
				$this->relationLoaded('sampling_points'),
				function () {
					return DB::table('strata')
						->select(
							DB::raw(
								"(SELECT MIN(trees.id) FROM trees
									JOIN sampling_points ON trees.sampling_point_id=sampling_points.id
									JOIN strata as subStrata ON sampling_points.stratum_id=" . $this->id . "
								) as min_trees"
							),
							DB::raw(
								"(SELECT MAX(trees.id) FROM trees
									JOIN sampling_points ON trees.sampling_point_id=sampling_points.id
									JOIN strata as subStrata ON sampling_points.stratum_id=" . $this->id . "
								) as max_trees"
							)
						)
						->first();
				}
			),
			'sampling_points' => $this->when(
				$this->relationLoaded('sampling_points'),
				function () {
					return SamplingPointResource::collection($this->sampling_points->where('status', true));
				}
			),
			'total_sampling_points' => $this->sampling_points->where('status', true)->count(),
			'created_at' => $this->created_at,
		];

		if (!$request->is('*/app')) {
			$data['status'] = $this->status;
			$data['updated_at'] = $this->updated_at;
		}

		return $data;
	}
}
