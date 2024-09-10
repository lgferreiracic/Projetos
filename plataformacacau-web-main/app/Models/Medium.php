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
		'loss',
		'piece',
	];

	public function tree_visit()
	{
		return $this->hasOne('App\Models\TreeVisit');
	}
}
