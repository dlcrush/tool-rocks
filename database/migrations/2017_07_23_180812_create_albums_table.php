<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {  
      Schema::create('albums', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('slug');
          $table->unsignedInteger('band_id');
          $table->foreign('band_id')->references('id')->on('bands');
          $table->unique(['band_id', 'slug']); // each album should have a unique slug per band
          $table->dateTime('release_date');
          $table->string('image_url')->nullable();
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
        Schema::dropIfExists('albums');
    }
}
