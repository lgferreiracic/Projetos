<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

Class CreateMiddleThirdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('middle_thirds', function (Blueprint $table) {
            $table->id();
            $table->float('argisol');
            $table->float('latosol');
            $table->float('cambisol');
            $table->float('gleisol');
            $table->float('other');
            $table->unsignedBigInteger('soil_class_id');
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
        Schema::dropIfExists('middle_thirds');
    }
};
