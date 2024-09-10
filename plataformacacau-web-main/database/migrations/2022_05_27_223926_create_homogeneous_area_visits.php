<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomogeneousAreaVisits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homogeneous_area_visits', function (Blueprint $table) {
			$table->integer('agricultural_period');
			$table->unsignedBigInteger('homogeneous_area_id');
			$table->unsignedBigInteger('visit_information_id');
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
        Schema::dropIfExists('homogeneous_area_visits');
    }
}
