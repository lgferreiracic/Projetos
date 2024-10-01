<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

Class CreateBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->integer('area');
            $table->tinyInteger('relief');
            $table->tinyInteger('altitude');
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('geolocation_id');
            $table->unsignedBigInteger('rainfall_id')->nullable();
            $table->unsignedBigInteger('soil_use_id')->nullable();
            $table->unsignedBigInteger('handling_id')->nullable();
            $table->unsignedBigInteger('genotypes_id')->nullable();
            $table->unsignedBigInteger('soil_class_id')->nullable();
            $table->unsignedBigInteger('production_id')->nullable();
            $table->unsignedBigInteger('homogeneous_area_id')->nullable();
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
        Schema::dropIfExists('blocks');
    }
};
