<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitInformation extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'visits_information';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		// 'id',
		'date',
		'note',
		'flowering',
		'refoliation',
		'top',
		'pruned',
		'mowing',
		'weeding',
		'grated',
		'renewed',
		'fertilized',
		'pulverized',
		'unbounded',
		'wind',
		'brown_rot',
		'drought',
		'rain',
		'rat',
		'flood',
		'insect',
		'absence_of_shadow',
		'excess_shade',
		'homogeneous_area_id'
	];

	public function homogeneous_area()
	{
		return $this->belongsTo(
			'App\Models\HomogeneousArea',
			'homogeneous_areas_id'
		);
	}
}
