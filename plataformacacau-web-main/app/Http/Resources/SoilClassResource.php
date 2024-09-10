<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SoilClassResource extends JsonResource
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
            'lowland' => new LowlandResource($this->lowland),
            'lowerThird' => new LowerThirdResource($this->lowerThird),
            'middleThird' => new MiddleThirdResource($this->middleThird),
            'upperThird' => new UpperThirdResource($this->upperThird),
            'totalArgisol' => $this->lowland->argisol + $this->lowerThird->argisol + 
                $this->middleThird->argisol + $this->upperThird->argisol,
            'totalLatosol' => $this->lowland->latosol + $this->lowerThird->latosol + 
                $this->middleThird->latosol + $this->upperThird->latosol,
            'totalCambisol' => $this->lowland->cambisol + $this->lowerThird->cambisol + 
                $this->middleThird->cambisol + $this->upperThird->cambisol,
            'totalGleisol' => $this->lowland->gleisol + $this->lowerThird->gleisol + 
                $this->middleThird->gleisol + $this->upperThird->gleisol,
            'totalOther' => $this->lowland->other + $this->lowerThird->other + 
                $this->middleThird->other + $this->upperThird->other,
        ];

        return $data;
    }
}
