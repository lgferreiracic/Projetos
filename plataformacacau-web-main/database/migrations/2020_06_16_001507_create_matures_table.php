<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaturesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matures', function (Blueprint $table) {
			$table->id();
			$table->integer('total');
			$table->integer('harvested');
			$table->integer('rotten');
			$table->integer('rat');
			$table->integer('witchs_broom');
			$table->integer('loss');
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
		Schema::dropIfExists('matures');
	}
}
