<?php

namespace App;

use App\Traits\HasPermissionsTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
	use Notifiable, HasPermissionsTrait;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'cpf',
		'email',
		'password',
		'status',
		'date_birth',
		'phone',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	/**
	 * Get the identifier that will be stored in the subject claim of the JWT.
	 *
	 * @return mixed
	 */
	public function getJWTIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Return a key value array, containing any custom claims to be added to the JWT.
	 *
	 * @return array
	 */
	public function getJWTCustomClaims()
	{
		return [];
	}

	/**
	 * Override the mail body for reset password notification mail.
	 */
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new \App\Notifications\MailResetPasswordNotification($token));
	}

	public function cpf_formatter($cpf)
	{
		$cpf = trim($cpf);
		if (strlen($cpf) == 14) {
			$cpf = str_replace(".", "", $cpf);
			$cpf = str_replace("-", "", $cpf);
		}

		return $cpf;
	}

	public function phone_formatter($phone)
	{
		$phone = trim($phone);
		if (strlen($phone) == 12) {
			$phone = str_replace("-", "", $phone);
		}

		return $phone;
	}

	public function roles()
	{
		return $this->belongsToMany(
			'App\Role',
			'user_role',
			'user_id',
			'role_id'
		);
	}

	public function properties()
	{
		return $this->hasMany(
			'App\Models\Property',
			'owner_id',
			'user_id',
			'property_id'
		);
	}

	public function sampling_points()
	{
		return $this->belongsToMany(
			'App\Models\SamplingPoint',
			'sampling_points_collectors',
			'user_id',
			'sampling_point_id'
		);
	}

	public function visits()
	{
		return $this->hasMany('App\Models\TreeVisit');
	}

	public function homogeneous_areas()
	{
		return $this->hasMany('App\Models\HomogeneousArea');
	}

	public function employees()
	{
		return $this->belongsToMany(
			'App\User',
			'users_employees',
			'user_id',
			'employee_id'
		);
	}
}
