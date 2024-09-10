<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Resources\Json\JsonResource;

class HomogeneousAreaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
			'id' => $this->id,
			'label' => $this->label,
			'property' => new PropertyResource($this->property),
			'visit' => $this->when(
				$this->relationLoaded('visits'),
				function() {
					return new VisitInformationResource($this->visits->where('homogeneous_area_id', $this->id)->last());
				}
			),
			'strata' => $this->when(
				$this->relationLoaded('strata'),
				function() {
					return StratumResource::collection($this->strata->where('homogeneous_area_id', $this->id));
				}
			),
			'user' => $this->collector,
			'total_stratum' => $this->strata->count(),
			'created_at' => $this->created_at,
		];

		if (!$request->is('*/app')) {
			$data['status'] = $this->status;
			$data['updated_at'] = $this->updated_at;
		}

		return $data;
    }
}
