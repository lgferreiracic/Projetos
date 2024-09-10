<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MiddleThird extends Model
{
    protected $fillable = [
        'argisol',
        'latosol',
        'cambisol',
        'gleisol',
        'other',
        'soil_class_id',
    ];

    public function soilClass()
    {
        return $this->belongsTo('App\Models\SoilClass', 'soil_class_id');
    }
}
