<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlterTables extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::disableForeignKeyConstraints();
		Schema::table('user_role', function (Blueprint $table) {
			$table->foreign('user_id')
				->references('id')
				->on('users')
				->onDelete('cascade');
			$table->foreign('role_id')
				->references('id')
				->on('roles')
				->onDelete('cascade');
			$table->primary(['user_id', 'role_id']);
		});

		Schema::table('role_permission', function (Blueprint $table) {
			$table->foreign('role_id')
				->references('id')
				->on('roles')
				->onDelete('cascade');
			$table->foreign('permission_id')
				->references('id')
				->on('permissions')
				->onDelete('cascade');
			$table->primary(['role_id', 'permission_id']);
		});

		Schema::table('user_permission', function (Blueprint $table) {
			$table->foreign('user_id')
				->references('id')
				->on('users')
				->onDelete('cascade');
			$table->foreign('permission_id')
				->references('id')
				->on('permissions')
				->onDelete('cascade');
			$table->primary(['user_id', 'permission_id']);
		});

		Schema::table('sampling_points', function (Blueprint $table) {
			$table->foreign('stratum_id')
				->references('id')
				->on('strata')
				->onDelete('cascade');
			$table->foreign('geolocation_id')
				->references('id')
				->on('geolocations')
				->onDelete('cascade');
		});

		Schema::table('sampling_points_collectors', function (Blueprint $table) {
			$table->foreign('user_id')
				->references('id')
				->on('users')
				->onDelete('cascade');
			$table->foreign('sampling_point_id')
				->references('id')
				->on('sampling_points')
				->onDelete('cascade');
		});

		Schema::table('trees', function (Blueprint $table) {
			$table->foreign('sampling_point_id')
				->references('id')
				->on('sampling_points')
				->onDelete('cascade');
		});

		Schema::table('tree_visits', function (Blueprint $table) {
			$table->foreign('tree_id')
				->references('id')
				->on('trees')
				->onDelete('cascade');
			$table->foreign('bobbin_id')
				->references('id')
				->on('bobbins')
				->onDelete('cascade');
			$table->foreign('small_id')
				->references('id')
				->on('smalls')
				->onDelete('cascade');
			$table->foreign('medium_id')
				->references('id')
				->on('mediums')
				->onDelete('cascade');
			$table->foreign('medium2_id')
				->references('id')
				->on('mediums2')
				->onDelete('cascade');
			$table->foreign('medium3_id')
				->references('id')
				->on('mediums3')
				->onDelete('cascade');
			$table->foreign('adult_id')
				->references('id')
				->on('adults')
				->onDelete('cascade');
			$table->foreign('adult2_id')
				->references('id')
				->on('adults2')
				->onDelete('cascade');
			$table->foreign('mature_id')
				->references('id')
				->on('matures')
				->onDelete('cascade');
			$table->foreign('mature2_id')
				->references('id')
				->on('matures2')
				->onDelete('cascade');
			$table->foreign('mature3_id')
				->references('id')
				->on('matures3')
				->onDelete('cascade');
			$table->foreign('mature4_id')
				->references('id')
				->on('matures4')
				->onDelete('cascade');
			$table->foreign('user_id')
				->references('id')
				->on('users')
				->onDelete('cascade');
			$table->foreign('geolocation_id')
				->references('id')
				->on('geolocations')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_role', function (Blueprint $table) {
			$table->dropForeign('user_role_user_id_foreign');
			$table->dropForeign('user_role_role_id_foreign');
		});

		Schema::table('role_permission', function (Blueprint $table) {
			$table->dropForeign('role_permission_role_id_foreign');
			$table->dropForeign('role_permission_permission_id_foreign');
		});

		Schema::table('user_permission', function (Blueprint $table) {
			$table->dropForeign('user_permission_user_id_foreign');
			$table->dropForeign('user_permission_permission_id_foreign');
		});

		Schema::table('sampling_points', function (Blueprint $table) {
			$table->dropForeign('sampling_points_stratum_id_foreign');
			$table->dropForeign('sampling_points_geolocation_id_foreign');
		});

		Schema::table('sampling_points_collectors', function (Blueprint $table) {
			$table->dropForeign('sampling_points_collectors_user_id_foreign');
			$table->dropForeign('sampling_points_collectors_sampling_point_id_foreign');
		});

		Schema::table('trees', function (Blueprint $table) {
			$table->dropForeign('trees_sampling_point_id_foreign');
		});

		Schema::table('tree_visits', function (Blueprint $table) {
			$table->dropForeign('tree_visits_tree_id_foreign');
			$table->dropForeign('tree_visits_bobbin_id_foreign');
			$table->dropForeign('tree_visits_small_id_foreign');
			$table->dropForeign('tree_visits_medium_id_foreign');
			$table->dropForeign('tree_visits_medium2_id_foreign');
			$table->dropForeign('tree_visits_medium3_id_foreign');
			$table->dropForeign('tree_visits_adult_id_foreign');
			$table->dropForeign('tree_visits_adult2_id_foreign');
			$table->dropForeign('tree_visits_mature_id_foreign');
			$table->dropForeign('tree_visits_mature2_id_foreign');
			$table->dropForeign('tree_visits_mature3_id_foreign');
			$table->dropForeign('tree_visits_mature4_id_foreign');
			$table->dropForeign('tree_visits_user_id_foreign');
			$table->dropForeign('tree_visits_geolocation_id_foreign');
		});
	}
}
