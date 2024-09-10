<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
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
			'name' => $this->name,
			'owner_name' => $this->owner_name,
			'city' => $this->city,
			'uf' => $this->uf,
			'description' => $this->description,
			'homogeneous_areas' => $this->when(
				$this->relationLoaded('homogeneous_areas'),
				function () {
					return HomogeneousAreaResource::collection($this->homogeneous_areas->where('property_id', $this->id));
				}
			),
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		];

		if (!$request->is('*/app')) { 
			$data['status'] = $this->status;
			$data['city'] = $this->city;
			$data['uf'] = $this->uf;
			$data['area'] = $this->area;
			$data['area_name'] = $this->area_name;
			$data['total_blocks'] = $this->blocks->count();
			$data['total_homogeneous_areas'] = $this->homogeneous_areas->count();
			$data['geolocation'] = new GeolocationResource($this->geolocation);
			$data['updated_at'] = $this->updated_at;
		}

		return $data;
	}
}
