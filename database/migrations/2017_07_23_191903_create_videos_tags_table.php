<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('videos_tags', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('video_id');
          $table->unsignedInteger("tag_id");
          $table->foreign('video_id')->references('id')->on('videos');
          $table->foreign('tag_id')->references('id')->on('tags');
          $table->unique(['video_id', 'tag_id']);
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
        Schema::dropIfExists('videos_tags');
    }
}
