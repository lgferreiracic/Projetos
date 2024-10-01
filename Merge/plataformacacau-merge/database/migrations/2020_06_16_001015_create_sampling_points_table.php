<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSamplingPointsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sampling_points', function (Blueprint $table) {
			$table->id();
			$table->string('label');
			$table->integer('ini_period')->nullable();
			$table->boolean('status')->default(true);
			$table->integer('harvest');
			$table->integer('year');
			$table->unsignedBigInteger('stratum_id');
			$table->unsignedBigInteger('property_id')->nullable();
			$table->unsignedBigInteger('geolocation_id')->nullable();
			$table->timestamp('lastVisit')->nullable();
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
		Schema::dropIfExists('sampling_points');
	}
}
