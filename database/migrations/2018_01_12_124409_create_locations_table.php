<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            //$table->unsignedInteger('city_id')->nullable();
            //$table->unsignedInteger('state_id')->nullable();
            //$table->unsignedInteger('country_id');
            //$table->foreign('city_id')->references('id')->on('cities');
            //$table->foreign('state_id')->references('id')->on('states');
            //$table->foreign('country_id')->references('id')->on('countries');
            //$table->unique(['city_id', 'state_id', 'country_id']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
