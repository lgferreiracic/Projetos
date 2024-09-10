<?php

namespace App\Traits;

use App\Permission;

trait HasPermissionsTrait
{
	public function roles()
	{
		return $this->belongsToMany(
			'App\Role',
			'user_role',
			'user_id',
			'role_id'
		);
	}

	public function permissions()
	{
		return $this->belongsToMany(
			'App\Permission',
			'user_permission',
			'user_id',
			'permission_id'
		);
	}

	public function has_role(...$roles)
	{
		foreach ($roles as $role) {
			if ($this->roles->contains('label', $role)) {
				return true;
			}
		}
		return false;
	}

	public function has_any_roles($roles)
	{
		if ($this->roles()->whereIn('label', $roles)->first()) {
			return true;
		}
		return false;
	}

	public function has_permission_through_role($permission)
	{
		foreach ($permission->roles as $role) {
			if ($this->roles->contains($role)) {
				return true;
			}
		}
		return false;
	}

	public function give_permissions_to(...$permissions)
	{
		$permissions = $this->get_all_permissions($permissions);

		if ($permissions === null) {
			return $this;
		}
		$this->permissions()->saveMany($permissions);

		return $this;
	}

	public function delete_permissions(...$permissions)
	{
		$permissions = $this->get_all_permissions($permissions);

		$this->permissions()->detach($permissions);

		return $this;
	}

	public function refresh_permissions(...$permissions)
	{
		$this->permissions()->detach();

		return $this->give_permissions_to($permissions);
	}

	public function withdraw_permissions_to(...$permissions)
	{
		$permissions = $this->get_all_permissions($permissions);

		$this->permissions()->detach($permissions);

		return $this;
	}

	protected function get_all_permissions(array $permissions)
	{
		return Permission::whereIn('label', $permissions)->get();
	}

	protected function has_permission($permission)
	{
		return (bool) $this->permissions
			->where('label', $permission->label)->count();
	}

	protected function has_permission_to($permission)
	{
		return $this->has_permission_through_role($permission)
			|| $this->has_permission($permission);
	}
}
