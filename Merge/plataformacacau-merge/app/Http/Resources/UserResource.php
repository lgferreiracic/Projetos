<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request)
	{
		return  [
			'id' => $this->id,
			'name' => $this->name,
			'phone' => $this->phone,
			'date_birth' => $this->date_birth,
			'cpf' => $this->cpf,
			'email' => $this->email,
			'status' => $this->status,
			'homogeneous_areas' => HomogeneousAreaResource::collection($this->homogeneous_areas),
			'sampling_points' => SamplingPointResource::collection($this->sampling_points),
			'roles' => RoleResource::collection($this->roles),
			'permissions' => PermissionResource::collection($this->permissions),
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		];
	}
}
