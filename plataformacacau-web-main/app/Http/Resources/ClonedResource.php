<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClonedResource extends JsonResource
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
            'main' => $this->main,
            'temple' => $this->temple,
            'global' => $this->global,
            'age' => $this->age,
            'density' => $this->density,
            'type' => $this->type,
            'type_description' => $this->type_description,
            'total_area_participation' => $this->total_area_participation,
        ];

        return $data;
    }
}
