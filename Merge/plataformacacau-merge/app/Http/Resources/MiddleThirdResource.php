<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MiddleThirdResource extends JsonResource
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
            'argisol' => $this->argisol,
            'latosol' => $this->latosol,
            'cambisol' => $this->cambisol,
            'gleisol' => $this->gleisol,
            'other' => $this->other,
        ];

        return $data;
    }
}
