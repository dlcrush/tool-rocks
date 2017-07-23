<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('songs', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('slug');
          $table->unsignedInteger('band_id');
          $table->foreign('band_id')->references('id')->on('bands');
          $table->unique(['band_id', 'slug']);
          $table->boolean('has_lyrics');
          $table->text('lyrics')->nullable();
          $table->unsignedInteger('lyrics_video_id')->nullable();
          $table->foreign('lyrics_video_id')->references('id')->on('videos');
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
        Schema::dropIfExists('songs');
    }
}
