<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shows', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tour_id');
            $table->string('name');
            $table->string('slug');
            $table->dateTime('date');
            $table->unsignedInteger('video_id')->nullable();
            $table->unsignedInteger('venue_id')->nullable();
            $table->foreign('tour_id')->references('id')->on('tours');
            $table->foreign('video_id')->references('id')->on('videos');
            $table->foreign('venue_id')->references('id')->on('venues');
            $table->unique(['tour_id', 'slug']);
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
        Schema::dropIfExists('shows');
    }
}
