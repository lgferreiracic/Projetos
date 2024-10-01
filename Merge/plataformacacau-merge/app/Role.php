<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'label',
		'title',
	];

	public function permissions()
	{
		return $this->belongsToMany(
			'App\Permission',
			'role_permission',
			'role_id',
			'permission_id'
		);
	}

	public function users()
	{
		return $this->belongsToMany(
			'App\User',
			'user_role',
			'role_id',
			'user_id'
		);
	}
}
