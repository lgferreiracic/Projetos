<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cloned extends Model
{
    protected $fillable = [
        'main',
        'temple',
        'global',
        'age',
        'density',
        'total_area_participation',
        'type',
        'type_description',
        'genotype_id',
    ];

    public function genotype()
    {
        return $this->belongsTo('App\Models\Genotype', 'genotype_id');
    }
}
