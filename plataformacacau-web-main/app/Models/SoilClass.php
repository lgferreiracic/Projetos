<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoilClass extends Model
{
    protected $fillable = [];

    public function blocks()
    {
        return $this->hasMany('App\Models\Block');
    }

    public function lowland()
    {
        return $this->hasOne('App\Models\Lowland');
    }

    public function lowerThird()
    {
        return $this->hasOne('App\Models\LowerThird');
    }

    public function middleThird()
    {
        return $this->hasOne('App\Models\MiddleThird');
    }

    public function upperThird()
    {
        return $this->hasOne('App\Models\UpperThird');
    }
}
