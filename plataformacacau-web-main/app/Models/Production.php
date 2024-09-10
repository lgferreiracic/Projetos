<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'temple',
        'main',
        'total',
        'not_informed'
    ];

    public function blocks()
    {
        return $this->hasMany('App\Models\Block');
    }
}
