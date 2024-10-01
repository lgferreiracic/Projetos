<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GenotypeResource extends JsonResource
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
            'common' => new CommonResource($this->common),
            'hybrid' => new HybridResource($this->hybrid),
            'cloned' => new ClonedResource($this->cloned),
        ];

        return $data;
    }
}
