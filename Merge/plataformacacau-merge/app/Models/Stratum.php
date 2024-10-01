<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stratum extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'label',
		'status',
		'homogeneous_area_id'
	];

	public function sampling_points()
	{
		return $this->hasMany('App\Models\SamplingPoint');
	}

	public function homogeneous_area()
	{
		return $this->belongsTo('App\Models\HomogeneousArea', 'homogeneous_area_id');
	}
}
