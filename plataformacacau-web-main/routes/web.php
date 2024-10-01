<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Client')->group(function () {
	Route::get('/', 'HomeController@index')->name('home');

	Route::group([
		'prefix' => 'panel',
		'middleware' => ['auth:api', 'panel']
	], function () {
		Route::get('/', 'PanelController@index')
			->middleware('role:admin,properties-manager,pre-registered')
			->name('panel');

		Route::get('/strata', 'PanelController@index')
			->middleware('role:admin,strata-manager,pre-registered');

		Route::get('/blocks', 'PanelController@index')
			->middleware('role:pre-registered');
		Route::get('/overview', 'PanelController@index')
			->middleware('role:admin,pre-registered');
		Route::get('/add-operational-unit', 'PanelController@index')
			->middleware('role:admin,properties-manager,pre-registered');
		Route::get('/edit-block', 'PanelController@index')
			->middleware('role:admin,properties-manager,pre-registered');

		Route::get('/homogeneous-area', 'PanelController@index')
			->middleware('role:admin,homogeneous_area-manager,pre-registered');
		Route::get('/homogeneous-area-practice', 'PanelController@index')
			->middleware('role:admin,homogeneous_area-manager,pre-registered');

		Route::get('/users', 'PanelController@index')
			->middleware('role:admin,users-manager,pre-registered');

		Route::get('/sampling-points', 'PanelController@index')
			->middleware('role:admin,sampling_points-manager,pre-registered');
		Route::get('/trees', 'PanelController@index')
			->middleware('role:admin,sampling_points-manager,pre-registered');
		Route::get('tree-visits', 'PanelController@index')
			->middleware('role:admin,sampling_points-manager,pre-registered');

		Route::get('/change-password', 'PanelController@index');

		Route::get('/properties', 'PanelController@index')
			->middleware('role:admin,properties-manager,pre-registered');
		Route::get('/add-property', 'PanelController@index')
			->middleware('role:admin,properties-manager,pre-registered');
		Route::get('/properties/shared', 'PanelController@index')
			->middleware('role:admin,properties-manager');

		Route::get('/reports', 'PanelController@index')
			->middleware('role:admin,reports-manager');
		Route::get('/docs', 'PanelController@index')
			->middleware('role:admin');
		Route::get('/data-import', 'PanelController@index')
			->middleware('role:admin');
	});

	Route::get('login', 'AuthController@index')->name('login');
	Route::post('login', 'AuthController@login');
	Route::get('signup', 'AuthController@signup')->name('signup');
	Route::post('signup', 'AuthController@register');
	Route::post('logout', 'AuthController@logout')->name('logout');
	Route::post('change-password', 'AuthController@change_password');
	Route::get('/me', 'AuthController@me');

	Route::get('/{any}', 'SPAController@index')
		->where('any', '^(?!api\/)[\/\w\.-]*');
});
