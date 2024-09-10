<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MediumResource extends JsonResource
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
			'loss' => $this->loss,
			'piece' => $this->piece,
			'created_at' => $this->created_at,
			// 'updated_at' => $this->updated_at,
		];
	}
}
