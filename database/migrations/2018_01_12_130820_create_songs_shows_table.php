<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs_shows', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('song_id');
            $table->unsignedInteger('show_id');
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->integer('order');
            $table->unsignedInteger('video_id')->nullable();
            $table->foreign('song_id')->references('id')->on('songs');
            $table->foreign('show_id')->references('id')->on('shows');
            $table->foreign('video_id')->references('id')->on('videos');
            $table->unique(['show_id', 'order']);
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
        Schema::dropIfExists('songs_shows');
    }
}
