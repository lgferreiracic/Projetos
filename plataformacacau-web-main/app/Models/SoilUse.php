<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoilUse extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'description',
    ];

    public function blocks()
    {
        return $this->hasMany('App\Models\Block');
    }
}
