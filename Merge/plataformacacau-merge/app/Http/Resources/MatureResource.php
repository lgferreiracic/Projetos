<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MatureResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request)
	{
		return [
			'id' => $this->id,
			'total' => $this->total,
			'harvested' => $this->harvested,
			'rotten' => $this->rotten,
			'rat' => $this->rat,
			'witchs_broom' => $this->witchs_broom,
			'loss' => $this->loss,
			'created_at' => $this->created_at,
			// 'updated_at' => $this->updated_at,
		];
	}
}
