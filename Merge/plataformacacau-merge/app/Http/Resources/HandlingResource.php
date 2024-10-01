<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HandlingResource extends JsonResource
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
            "id" => $this->id,
            "temple" => $this->temple,
            "main" => $this->main,
        ];

        return $data;
    }
}
