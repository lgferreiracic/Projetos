<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rainfall extends Model
{
    protected $fillable = [
        'january',
        'february',
        'march',
        'april',
        'may',
        'june',
        'july',
        'august',
        'september',
        'october',
        'november',
        'december',
        'unknown',
    ];

    public function blocks()
    {
        return $this->hasMany('App\Models\Block');
    }
}
