<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('properties', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('city');
			$table->string('uf');
			$table->float('area')->nullable();
			$table->string('owner_name')->nullable();
			$table->string('area_name')->nullable();
			$table->string('description')->nullable();
			$table->tinyInteger('status')->default(1);
			$table->unsignedBigInteger('owner_id')->nullable();
			$table->unsignedBigInteger('geolocation_id')->nullable();
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
		Schema::dropIfExists('properties');
	}
}
