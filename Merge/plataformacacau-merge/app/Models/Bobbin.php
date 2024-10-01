<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bobbin extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'total',
		// 'piece',
		// 'loss',
		// 'witchs_broom'
	];

	public function tree_visit()
	{
		return $this->hasOne('App\Models\TreeVisit');
	}
}
