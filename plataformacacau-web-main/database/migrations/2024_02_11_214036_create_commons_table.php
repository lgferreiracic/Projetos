<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commons', function (Blueprint $table) {
            $table->id();
            $table->float('main')->nullable();
            $table->float('temple')->nullable();
            $table->float('global')->nullable();
            $table->integer('age')->nullable();
            $table->integer('density')->nullable();
            $table->float('total_area_participation');
            $table->tinyInteger('type')->nullable();
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
        Schema::dropIfExists('commons');
    }
};
