<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomogeneousArea extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'label',
		'status',
		'property_id',
		'user_id',
	];

	public function property()
	{
		return $this->belongsTo('App\Models\Property', 'property_id');
	}

	public function strata()
	{
		return $this->hasMany('App\Models\Stratum');
	}

	public function blocks()
	{
		return $this->hasMany('App\Models\Block');
	}

	public function visits()
	{
		return $this->hasMany('App\Models\VisitInformation');
	}

	public function collector()
	{
		return $this->belongsTo('App\User', 'user_id');
	}
}
