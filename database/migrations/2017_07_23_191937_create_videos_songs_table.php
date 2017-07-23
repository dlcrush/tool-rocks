<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('videos_songs', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('video_id');
          $table->unsignedInteger('song_id');
          $table->foreign('video_id')->references('id')->on('videos');
          $table->foreign('song_id')->references('id')->on('songs');
          $table->integer('order');
          $table->string('start_time')->nullable();
          $table->string('end_time')->nullable();
          $table->unique(['video_id', 'order']);
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
        Schema::dropIfExists('videos_songs');
    }
}
