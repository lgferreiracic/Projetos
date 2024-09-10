<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VisitInformationResource extends JsonResource
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
			// 'id' => $this->id,
			'date' => $this->date,
			'note' => $this->note,
			'flowering' => $this->flowering,
			'refoliation' => $this->refoliation,
			'top' => $this->top,
			'pruned' => $this->pruned,
			'mowing' => $this->mowing,
			'weeding' => $this->weeding,
			'grated' => $this->grated,
			'renewed' => $this->renewed,
			'fertilized' => $this->fertilized,
			'pulverized' => $this->pulverized,
			'unbounded' => $this->unbounded,
			'wind' => $this->wind,
			'brown_rot' => $this->brown_rot,
			'drought' => $this->drought,
			'rain' => $this->rain,
			'rat' => $this->rat,
			'flood' => $this->flood,
			'insect' => $this->insect,
			'absence_of_shadow' => $this->absence_of_shadow,
			'excess_shade' => $this->excess_shade,
			'created_at' => $this->created_at,
			'homogeneous_area_id' => $this->homogeneous_area_id,
		];
	}
}
