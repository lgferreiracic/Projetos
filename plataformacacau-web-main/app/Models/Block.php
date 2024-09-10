<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'area',
        'label',
        'relief',
        'altitude',
        'property_id',
        'rainfall_id',
        'soil_use_id',
        'handling_id',
        'genotypes_id',
        'soil_class_id',
        'production_id',
        'geolocation_id',
        'homogeneous_area_id',
    ];

    public function soilUse()
    {
        return $this->belongsTo('App\Models\SoilUse', 'soil_use_id');
    }

    public function soilClass()
    {
        return $this->belongsTo('App\Models\SoilClass', 'soil_class_id');
    }

    public function handling()
    {
        return $this->belongsTo('App\Models\Handling', 'handling_id');
    }

    public function genotype()
    {
        return $this->belongsTo('App\Models\Genotype', 'genotypes_id');
    }

    public function rainfall()
    {
        return $this->belongsTo('App\Models\Rainfall', 'rainfall_id');
    }

    public function property()
    {
        return $this->belongsTo('App\Models\Property', 'property_id');
    }

    public function geolocation()
    {
        return $this->belongsTo('App\Models\Geolocation', 'geolocation_id');
    }

    public function homogeneous_area()
    {
        return $this->belongsTo('App\Models\HomogeneousArea', 'homogeneous_area_id');
    }

    public function production()
    {
        return $this->belongsTo('App\Models\Production', 'production_id');
    }
}
