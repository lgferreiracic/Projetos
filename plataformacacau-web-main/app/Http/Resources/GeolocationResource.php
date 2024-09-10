<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GeolocationResource extends JsonResource
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
			'latitude' => $this->latitude,
			'longitude' => $this->longitude,
			'ratio' => $this->ratio,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		];
	}
}
