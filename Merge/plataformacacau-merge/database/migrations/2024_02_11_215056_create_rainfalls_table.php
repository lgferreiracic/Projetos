<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

Class CreateRainfallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rainfalls', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('january');
            $table->tinyInteger('february');
            $table->tinyInteger('march');
            $table->tinyInteger('april');
            $table->tinyInteger('may');
            $table->tinyInteger('june');
            $table->tinyInteger('july');
            $table->tinyInteger('august');
            $table->tinyInteger('september');
            $table->tinyInteger('october');
            $table->tinyInteger('november');
            $table->tinyInteger('december');
            $table->tinyInteger('unknown');
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
        Schema::dropIfExists('rainfalls');
    }
};
