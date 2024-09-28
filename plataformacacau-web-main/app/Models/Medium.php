<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medium extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'mediums';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'total',
		//'harvested',//Mod
		//'rotten',//Mod
		//'rat',//Mod
		//'witchs_broom',//Mod
		'loss',
		'piece',
	];

	public function tree_visit()
	{
		return $this->hasOne('App\Models\TreeVisit');
	}
}
