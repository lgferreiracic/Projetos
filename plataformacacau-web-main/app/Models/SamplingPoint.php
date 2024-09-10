<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SamplingPoint extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'label',
		'ini_period',
		'status',
		'harvest',
		'year',
		'property_id',
		'stratum_id',
		'geolocation_id',
		'lastVisit',
	];

	public const VALIDATION_RULES = [
		// 'label' 				=> 'bail|required',
		'status'				=> 'bail|required',
		'stratum_id'			=> 'bail|required',
		'geolocation.latitude'	=> 'bail|required|min:-90.00|max:90.00',
		'geolocation.longitude' => 'bail|required|min:-180.00|max:180.00'
	];

	public function stratum()
	{
		return $this->belongsTo('App\Models\Stratum');
	}

	public function collectors()
	{
		return $this->belongsToMany(
			'App\User',
			'sampling_points_collectors',
			'sampling_point_id',
			'user_id'
		);
	}

	public function trees()
	{
		return $this->hasMany('App\Models\Tree');
	}

	public function geolocation()
	{
		return $this->belongsTo('App\Models\Geolocation', 'geolocation_id');
	}
}
