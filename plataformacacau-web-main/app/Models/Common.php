<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Common extends Model
{
    protected $fillable = [
        'main',
        'temple',
        'global',
        'age',
        'density',
        'total_area_participation',
        'genotype_id',
        'type',
    ];

    public function genotype()
    {
        return $this->belongsTo('App\Models\Genotype', 'genotype_id');
    }
}
