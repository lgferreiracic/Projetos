<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'label',
		'rfid',
		'status',
		'sampling_point_id'
	];

	public function sampling_point()
	{
		return $this->belongsTo('App\Models\SamplingPoint');
	}

	public function tree_visits()
	{
		return $this->hasMany('App\Models\TreeVisit');
	}
}
