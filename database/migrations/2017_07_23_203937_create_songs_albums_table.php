<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('songs_albums', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('song_id');
          $table->unsignedInteger('album_id');
          $table->foreign('song_id')->references('id')->on('songs');
          $table->foreign('album_id')->references('id')->on('albums');
          $table->unique(['album_id', 'song_id']);
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
        Schema::dropIfExists('songs_albums');
    }
}
