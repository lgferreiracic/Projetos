<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

Class CreateHybridsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hybrids', function (Blueprint $table) {
            $table->id();
            $table->float('main')->nullable();
            $table->float('temple')->nullable();
            $table->float('global')->nullable();
            $table->integer('age')->nullable();
            $table->integer('density')->nullable();
            $table->float('total_area_participation');
            $table->unsignedBigInteger('genotype_id');
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
        Schema::dropIfExists('hybrids');
    }
};
