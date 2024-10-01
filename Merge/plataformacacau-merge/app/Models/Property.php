<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'name',
		'owner_name',
		'city',
		'uf',
		'description',
		'status',
		'owner_id',
		'area_name',
		'geolocation_id',
	];

	public function homogeneous_areas()
	{
		return $this->hasMany('App\Models\HomogeneousArea');
	}

	public function owners()
	{
		return $this->belongsTo('App\User', 'owner_id');
	}

	public function blocks()
	{
		return $this->hasMany('App\Models\Block');
	}

	public function geolocation()
	{
		return $this->belongsTo('App\Models\Geolocation', 'geolocation_id');
	}
}
