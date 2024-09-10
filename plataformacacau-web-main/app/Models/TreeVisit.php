<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TreeVisit extends Model
{
	protected $fillable = [
		'tree_id',
		'bobbin_id',
		'small_id',
		'medium_id',
		'medium2_id',
		'medium3_id',
		'adult_id',
		'adult2_id',
		'mature_id',
		'mature2_id',
		'mature3_id',
		'mature4_id',
		'user_id',
		'date',
	];

	public function tree()
	{
		return $this->belongsTo('App\Models\Tree', 'tree_id');
	}

	public function bobbin()
	{
		return $this->belongsTo('App\Models\Bobbin', 'bobbin_id');
	}

	public function small()
	{
		return $this->belongsTo('App\Models\Small', 'small_id');
	}

	public function medium()
	{
		return $this->belongsTo('App\Models\Medium', 'medium_id');
	}

	public function medium2()
	{
		return $this->belongsTo('App\Models\Medium2', 'medium2_id');
	}

	public function medium3()
	{
		return $this->belongsTo('App\Models\Medium3', 'medium3_id');
	}

	public function adult()
	{
		return $this->belongsTo('App\Models\Adult', 'adult_id');
	}

	public function adult2()
	{
		return $this->belongsTo('App\Models\Adult2', 'adult2_id');
	}

	public function mature()
	{
		return $this->belongsTo('App\Models\Mature', 'mature_id');
	}

	public function mature2()
	{
		return $this->belongsTo('App\Models\Mature2', 'mature2_id');
	}

	public function mature3()
	{
		return $this->belongsTo('App\Models\Mature3', 'mature3_id');
	}

	public function mature4()
	{
		return $this->belongsTo('App\Models\Mature4', 'mature4_id');
	}

	public function collector()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function geolocation()
	{
		return $this->belongsTo('App\Models\Geolocation', 'geolocation_id');
	}
}
