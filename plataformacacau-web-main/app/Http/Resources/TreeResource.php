<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class TreeResource extends JsonResource
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
			'sampling_point_id' => $this->sampling_point_id,
			'tree_visits' => TreeVisitResource::collection($this->tree_visits->reverse()->take(2)),
			'created_at' => $this->created_at,
		];

		if (!$request->is('*/app')) {
			$data['status'] = $this->status;
			$data['updated_at'] = $this->updated_at;
		}

		return $data;
	}
}
