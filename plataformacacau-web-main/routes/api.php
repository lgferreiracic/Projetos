<?php

use Illuminate\Support\Facades\Route;

Route::group([
	'namespace' => 'API',
	'middleware' => ['api'],
	'prefix' => 'v1',
], function () {
	Route::get('me', 'AuthController@me')->name('auth.me');
	Route::get('logout', 'AuthController@logout')->name('auth.logout');
	Route::post('change-password', 'AuthController@change_password')
		->name('change_password');
});

Route::post('import', 'API\ReportController@import_xsl');
//Route::get('import', 'API\ReportController@import_xsl');
Route::post('v1/login', 'API\AuthController@login')->name('auth.login');
Route::post('v1/signup', 'API\AuthController@register')->name('auth.register');
Route::post('v1/reset', 'API\AuthController@send_password_reset_link');
Route::post('v1/contact', 'API\MailController@send_mail');
Route::post('v1/reset/password', 'API\AuthController@call_reset_password');

Route::group([
	'namespace' => 'API',
	'prefix' => 'v1',
	'middleware' => ['auth:api'],
], function () {
	Route::get('users', 'UserController@index')
		->name('users.index');
	Route::get('users/{user}', 'UserController@show')
		->name('users.show');
	Route::get('roles', 'UserController@all_roles')
		->name('roles.show');
	Route::get('permissions', 'UserController@all_permissions')
		->name('permissions.show');
	Route::post('users', 'UserController@store')
		->name('users.store');
	Route::put('users/{user}', 'UserController@update')
		->name('users.update');
	Route::put('users/{user}/status', 'UserController@status')
		->name('users.status');

	Route::get('strata', 'StratumController@index')
		->name('strata.index');
	Route::get('strata/{stratum}', 'StratumController@show')
		->name('strata.show');
	Route::post('strata', 'StratumController@store')
		->name('strata.store');
	Route::put('strata/{stratum}', 'StratumController@update')
		->name('strata.update');
	Route::put('strata/{stratum}/status', 'StratumController@status')
		->name('strata.status');

	Route::get('homogeneous-area', 'HomogeneousAreaController@index')
		->name('homogeneous-area.index');
	Route::get('homogeneous-area/{h_area}', 'HomogeneousAreaController@show')
		->name('homogeneous-area.show');
	Route::post('homogeneous-area', 'HomogeneousAreaController@store')
		->name('homogeneous-area.store');
	Route::put('homogeneous-area/{h_area}', 'HomogeneousAreaController@update')
		->name('homogeneous-area.update');
	Route::put('homogeneous-area/{h_area}/status', 'HomogeneousAreaController@status')
		->name('homogeneous-area.status');

	Route::get('properties', 'PropertyController@index')
		->name('properties.index');
	Route::get('shared-properties', 'PropertyController@shared')
		->name('properties.shared');
	Route::get('properties/{property}', 'PropertyController@show')
		->name('properties.show');
	Route::post('properties', 'PropertyController@store')
		->name('properties.store');
	Route::put('properties/{property}', 'PropertyController@update')
		->name('properties.update');
	Route::put('properties/{property}/status', 'PropertyController@status')
		->name('properties.status');

	Route::get('blocks', 'BlockController@index')
		->name('blocks.index');
	Route::get('blocks/{block}', 'BlockController@show')
		->name('blocks.show');
	Route::post('blocks', 'BlockController@store')
		->name('blocks.store');
	Route::put('blocks/{block}', 'BlockController@update')
		->name('blocks.update');
	Route::get('blocks-clustering', 'BlockController@clustering')
		->name('blocks.clustering');
	Route::get('blocks-test', 'BlockController@testClustering')
		->name('blocks.test');

	Route::get('sampling-points', 'SamplingPointController@index')
		->name('sampling-points.index');
	Route::get('sampling-points/{s_point}', 'SamplingPointController@show')
		->name('sampling-points.show');
	Route::post('sampling-points', 'SamplingPointController@store')
		->name('sampling-points.store');
	Route::put('sampling-points/{s_point}', 'SamplingPointController@update')
		->name('sampling-points.update');
	Route::put('sampling-points/{s_point}/status', 'SamplingPointController@status')
		->name('sampling-points.status');

	Route::get('trees', 'TreeController@index')
		->name('trees.index');
	Route::get('trees/{tree}', 'TreeController@show')
		->name('trees.show');
	Route::post('trees', 'TreeController@store')
		->name('trees.store');
	Route::put('trees/{tree}', 'TreeController@update')
		->name('trees.update');
	Route::delete('trees/{tree}', 'TreeController@deactivate')
		->name('trees.deactivate');

	Route::get('tree-visits', 'TreeVisitController@index')
		->name('tree-visits.index');
	Route::get('tree-visits/{tree_visit}', 'TreeVisitController@show')
		->name('tree-visits.show');

	Route::get('visits-information', 'VisitInformationController@index')
		->name('visits-information.index');

	Route::post('export-pdf', 'ReportController@export_pdf')
		->name('export-pdf');
	Route::post('export-xls', 'ReportController@export_xls')
		->name('export-xls');
	Route::post('export-csv', 'ReportController@export_csv')
		->name('export-csv');
	Route::get('export-block-without-sharing', 'ReportController@export_block_without_sharing')
		->name('export-block-without-sharing');
	//Modificado
	Route::post('export-pdf2', 'ReportController@export_pdf2')
		->name('export-pdf2');
	Route::get('get-visit-dates', 'TreeVisitController@get_visit_dates')
		->name('get-visit-dates');
	Route::post('exportProperty-xls', 'ReportController@exportProperty_xls')
		->name('exportProperty-xls');
	//Modificado

	Route::get('app', 'MobileController@index')
		->name('get-data');
	Route::post('app', 'MobileController@send_visit')
		->name('send-visit');
	Route::post('practice', 'MobileController@send_practice')
		->name('send-practice');
});

// Route::fallback(function () {
// 	return response()->json('Rota não encontrada. Se o erro persistir, entrar em contato', 404);
// });
