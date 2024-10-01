<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlockResource extends JsonResource
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
            'area' => $this->area,
            'label' => $this->label,
            'relief' => $this->relief,
            'altitude' => $this->altitude,
            'soilUse' => new SoilUseResource($this->soilUse),
            'handling' => new HandlingResource($this->handling),
            'rainfall' => new RainfallResource($this->rainfall),
            'property' => new PropertyResource($this->property),
            'genotype' => new GenotypeResource($this->genotype),
            'soilClass' => new SoilClassResource($this->soilClass),
            'production' => new ProductionResource($this->production),
            'geolocation' => new GeolocationResource($this->geolocation),
        ];

        return $data;
    }
}
