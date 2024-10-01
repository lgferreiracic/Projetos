<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Geolocation extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'latitude',
		'longitude',
		'ratio',
	];

	public function sampling_point()
	{
		return $this->hasOne('App\Models\SamplingPoint');
	}

	public function tree_visits()
	{
		return $this->hasMany('App\Models\TreeVisit');
	}

	public function properties()
	{
		return $this->hasOne('App\Models\Property');
	}

	public function blocks()
	{
		return $this->hasOne('App\Models\Block');
	}
}
