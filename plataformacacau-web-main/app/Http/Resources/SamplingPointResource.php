<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class SamplingPointResource extends JsonResource
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
			'ini_period' => $this->ini_period,
			'status' => $this->status,
			'harvest' => $this->harvest,
			'year' => $this->year,
			'users_ids' => DB::table('sampling_points_collectors')
				->where('sampling_points_collectors.sampling_point_id', '=', $this->id)
				->get(),
			'stratum' => new StratumResource($this->stratum),
			'active_trees' => $this->trees->where('status', true)->count(),
			'sampling_point_tree_range' => DB::table('sampling_points')
				->select(
					DB::raw(
						"(SELECT MIN(trees.label) FROM trees
			                JOIN sampling_points ON trees.sampling_point_id=" . $this->id . "
			            ) as min_trees"
					),
					DB::raw(
						"(SELECT MAX(trees.label) FROM trees
			                JOIN sampling_points ON trees.sampling_point_id=" . $this->id . "
			            ) as max_trees"
					)
				)
				->first(),
			'total_trees' => $this->trees->count(),
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'lastVisit' => $this->lastVisit,
		];

		if ($request->is('*/app')) {
			$data['trees'] = TreeResource::collection(
				$this->trees->where('status', true)
			);
		} else {
			$data['trees'] = $this->trees;
			$data['geolocation'] = $this->geolocation;
			$data['update_at'] = $this->update_at;
			$data['period'] = $this->visits;
		}

		return $data;
	}
}