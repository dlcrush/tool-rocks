<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Repositories\API\Contracts\SetlistRepository;
use App\Show;
use Carbon\Carbon;

class ProcessSetlistShow implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;
    public $bandId;
    public $repo;
    public $songRepo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SetlistRepository $repo, SongRepository $songRepo)
    {
        $this->bandId = config('setlist.tool_band_id');
        $this->repo = $repo;
        $this->songRepo = $songRepo;
    }

    /*
        $this->validate($request, [
            'tour_id' => 'required|numeric',
            'name' => 'required',
            'slug' => 'required',
            'date' => 'required',
            'venue_id' => 'nullable|numeric',
            'video_id' => 'nullable|numeric'
        ]);

        $show = $this->showRepo->create([
             'name' => $request->name,
             'slug' => $request->slug,
             'tour_id' => $request->tour_id,
             'date' => Carbon::parse($request->date),
             'venue_id' => $request->venue_id,
             'video_id' => $request->video_id
         ]);

        if ($request->has('songs')) {
            $songs = $request->songs;
            $startTimes = $request->start_time;
            $endTimes = $request->end_time;

            $songsShows = [];

            for($i = 0; $i < count($songs); $i ++) {
                $songId = $songs[$i];
                $startTime = $startTimes[$i];
                $endTime = $endTimes[$i];

                if ($songId != '' && $songId != null) {
                    array_push($songsShows, [
                        'show_id' => $show->id,
                        'song_id' => $songId,
                        'start_time' => $startTime,
                        'end_time' => $endTime,
                        'order' => $i + 1
                    ]);
                }
            }

            \DB::table('songs_shows')->insert($songsShows);
        }

         return redirect(action('Admin\ShowController@index'));

    */

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle($show)
    {
        $tour = $this->repo->findBy('slug', '2010');

        $date = Carbon::parse($show->eventDate);

        $venue = $show->venue;
        $venueName = $venue->name;
        $city = $venue->city->name;
        $state = $venue->city->stateCode;
        $country = $venue->city->country->code;
        $cityAndState = $city . ', ' . $state;

        $s = new Show();
        $s->tour_id = $tour->id;
        $s->date = $date->toDateTimeString();
        $s->name = Carbon::format($date, 'F n, Y') . ' - ' . $venueName . ' - ' . $cityAndState;
        $s->slug = 'tool-2010-' . str_replace(" ", "-", strtolower($city));

        $id = $s->save();

        $songs = [];

        $i = 1;

        foreach($show->sets as $set) {
            foreach($set->song as $song) {
                if (! $song->tape) {
                    $x = $this->songRepo->findBy('name', $song->name);

                    $bacon = [
                        'show_id' => $s->id,
                        'song_id' => $x->id,
                        'order' => $i
                    ];

                    $i ++;

                    array_push($songs, $bacon);
                }
            }
        }

        foreach($songs as $song) {
            \DB::table('songs_shows')->insert($songs);
        }

    }
}
