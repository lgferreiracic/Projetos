<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsInformationTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visits_information', function (Blueprint $table) {
			$table->id();
			$table->timestamp('date');
			$table->string('note')->nullable();
			$table->integer('flowering');
			$table->integer('refoliation');
			$table->integer('top');
			$table->boolean('pruned');
			$table->boolean('mowing');
			$table->boolean('weeding');
			$table->boolean('grated');
			$table->boolean('renewed');
			$table->boolean('fertilized');
			$table->boolean('pulverized');
			$table->boolean('unbounded');
			$table->boolean('wind');
			$table->boolean('brown_rot');
			$table->boolean('drought');
			$table->boolean('rain');
			$table->boolean('rat');
			$table->boolean('flood');
			$table->boolean('insect');
			$table->boolean('absence_of_shadow');
			$table->boolean('excess_shade');
			$table->unsignedBigInteger('homogeneous_area_id');
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
		Schema::dropIfExists('visits_information');
	}
}
