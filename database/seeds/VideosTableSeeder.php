<?php

use Illuminate\Database\Seeder;
use App\Video;
use App\Band;
use App\Song;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Video::truncate();
      
      $toolId = Band::where('slug', 'tool')->get()->first()->id;
      
      $video = Video::create([
        "name" => "[EPIC] Tool Live New Jersey 1997 (Remastered)",
        "description" => "Watch Tool rock out in New Jeresey in one of the most epic captures ever",
        "slug" => "tool-1997-new-jersey-remastered",
        "band_id" => $toolId,
        "source" => "youtube",
        "video_id" => "PHy9PSkpiKw"
      ]);
      
      $thirdEyeSongId = Song::where('slug', 'third-eye')->get()->first()->id;
      $stinkfistSongId = Song::where('slug', 'stinkfist')->get()->first()->id;
      $fourtySixAndTwoSongId = Song::where('slug', 'fourty-six-and-2')->get()->first()->id;
      
      $songs = [
        ["id" => $thirdEyeSongId, "start_time" => "00:00"],
        ["id" => $stinkfistSongId, "start_time" => "13:39"],
        ["id" => $fourtySixAndTwoSongId, "start_time" => "20:18"]
      ];
      
      foreach($songs as $i => $song) {
        DB::table('videos_songs')->insert([
            'video_id' => $video->id,
            'song_id' => $song['id'],
            'start_time' => $song['start_time'],
            'order' => $i
        ]);
      }
    }
}
