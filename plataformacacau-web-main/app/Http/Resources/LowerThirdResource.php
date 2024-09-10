<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LowerThirdResource extends JsonResource
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
            'argisol' => $this->argisol,
            'latosol' => $this->latosol,
            'cambisol' => $this->cambisol,
            'gleisol' => $this->gleisol,
            'other' => $this->other,
        ];

        return $data;
    }
}
