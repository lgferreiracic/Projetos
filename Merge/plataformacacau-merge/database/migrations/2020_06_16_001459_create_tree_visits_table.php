<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreeVisitsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tree_visits', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('tree_id');
			$table->unsignedBigInteger('bobbin_id');
			$table->unsignedBigInteger('small_id');
			$table->unsignedBigInteger('medium_id');
			$table->unsignedBigInteger('medium2_id');
			$table->unsignedBigInteger('medium3_id');
			$table->unsignedBigInteger('adult_id');
			$table->unsignedBigInteger('adult2_id');
			$table->unsignedBigInteger('mature_id');
			$table->unsignedBigInteger('mature2_id');
			$table->unsignedBigInteger('mature3_id');
			$table->unsignedBigInteger('mature4_id');
			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('geolocation_id')->nullable();
			$table->timestamp('date')->useCurrent();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('tree_visits');
	}
}
