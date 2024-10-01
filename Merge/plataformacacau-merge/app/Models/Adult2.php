<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adult2 extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'adults2';

    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'total',
		'harvested',
		'rotten',
		'rat',
		'witchs_broom',
		'loss',
	];

	public function tree_visit()
	{
		return $this->hasOne('App\Models\TreeVisit');
	}
}
