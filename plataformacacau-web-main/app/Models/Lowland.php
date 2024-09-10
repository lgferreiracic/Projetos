<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lowland extends Model
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
