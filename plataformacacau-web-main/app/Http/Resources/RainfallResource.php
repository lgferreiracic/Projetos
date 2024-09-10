<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RainfallResource extends JsonResource
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
            "id" => $this->id,
            "january" => $this->january,
            "february" => $this->february,
            "march" => $this->march,
            "april" => $this->april,
            "may" => $this->may,
            "june" => $this->june,
            "july" => $this->july,
            "august" => $this->august,
            "september" => $this->september,
            "october" => $this->october,
            "november" => $this->november,
            "december" => $this->december,
            "unknown" => $this->unknown,
        ];

        return $data;
    }
}
