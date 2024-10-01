<?php

namespace App\Providers;

use App\Role;
use App\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionsServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Role::get()->map(function ($role) {
			Gate::define($role->label, function ($user) use ($role) {
				return $user->role == $role;
			});
		});

		Permission::get()->map(function ($permission) {
			Gate::define($permission->label, function ($user) use ($permission) {
				return $user->has_permission_to($permission);
			});
		});
	}
}
