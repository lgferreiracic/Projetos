<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomogeneousAreas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homogeneous_areas', function (Blueprint $table) {
			$table->id();
			$table->string('label');
			$table->boolean('status')->default(true);
			$table->unsignedBigInteger('property_id');
			$table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('homogeneous_areas');
    }
}
