<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genotype extends Model
{
    protected $fillable = [];

    public function blocks()
    {
        return $this->hasMany('App\Models\Block');
    }

    public function common()
    {
        return $this->hasOne('App\Models\Common');
    }

    public function hybrid()
    {
        return $this->hasOne('App\Models\Hybrid');
    }

    public function cloned()
    {
        return $this->hasOne('App\Models\Cloned');
    }
}
