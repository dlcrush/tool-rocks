<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Repositories\API\Contracts\SetlistRepository;
use App\Repositories\API\Contracts\SongRepository;
use App\Repositories\API\Contracts\TourRepository;
use App\Show;
use Carbon\Carbon;

class SetlistController extends APIController
{

    protected $repo;

    public function __construct(SetlistRepository $repo, SongRepository $songRepo, TourRepository $tourRepo) {
        $this->repo = $repo;
        $this->songRepo = $songRepo;
        $this->tourRepo = $tourRepo;
    }

    public function getBand($bandId)
    {
        $bandId = '66fc5bf8-daa4-4241-b378-9bc9077939d2';

        $band = $this->repo->getBand($bandId);

        return $this->respond($band);
    }

    public function getShows($bandId)
    {
        $bandId = '66fc5bf8-daa4-4241-b378-9bc9077939d2';

        $shows = $this->repo->getAllShows($bandId);

        return $this->respond($shows);
    }

    public function getShowsByYear($bandId, $year)
    {
        $bandId = '66fc5bf8-daa4-4241-b378-9bc9077939d2';

        $shows = $this->repo->getShowsByYear($bandId, $year);

        return $this->respond($shows);
    }

    public function ingest($bandId, $year)
    {
        $bandId = '66fc5bf8-daa4-4241-b378-9bc9077939d2';

        $shows = $this->repo->getShowsByYear($bandId, $year);

        $results = [];

        foreach($shows as $show) {
            $result = $this->ingestShow($show, $year);
            array_push($results, $result);
        }

        dd($results);
    }

    /* This is a list of known name differences */
    private function normalizeName($name) {
        if ($name === 'Ænema') {
            $name = 'Aenema';
        }

        if ($name === 'Forty-Six & 2') {
            $name = 'Forty Six & 2';
        }

        if ($name === '10,000 Days (Wings, Pt 2)') {
            $name = '10,000 Days (Wings Pt 2)';
        }

        if ($name === '4°') {
            $name = '4 Degrees';
        }

        if ($name === 'Soundscapes') {
            $name = 'Fripp';
        }

        return $name;
    }

    private function ingestShow($show, $year) {

        $tour = $this->tourRepo->findBy('slug', $year);

        $date = Carbon::parse($show->eventDate);

        $venue = $show->venue;
        $venueName = $venue->name;
        $city = $venue->city->name;
        $state = isset($venue->city->stateCode) && $venue->city->country->code === 'US' ? $venue->city->stateCode : null;
        $country = isset($state) ? $venue->city->country->code : $venue->city->country->name;

        $cityAndState = isset($state) ? $city . ', ' . $state : $city . ', ' . $country;

        $s = new Show();
        $s->tour_id = $tour->id;
        $s->date = $date->toDateTimeString();
        $s->name = $date->format('F j, Y') . ' - ' . $venueName . ' - ' . $cityAndState;

        $s->slug = utf8_encode('tool-' . strtolower($date->format('M-j-Y')) . '-' . str_replace(" ", "-", strtolower($city)));

        $id = $s->save();

        $songs = [];

        $i = 1;

        //dd($show);

        foreach($show->sets->set as $set) {
            //dd($set);
            foreach($set->song as $song) {
                if (! isset($song->tape) || ! $song->tape) {
                    $songName = $this->normalizeName($song->name);

                    if ($songName === '') {
                        continue;
                    }

                    $x = $this->songRepo->findBy('name', $songName);

                    //dd($x->id);

                    //dd($song->name);

                    if (! $x) {
                        dd($song->name);
                    }

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

        \DB::table('songs_shows')->insert($songs);

        // dd([
        //     'show' => $s,
        //     'songs' => $songs
        // ]);

        return [
            'show' => $s,
            'songs' => $songs
        ];
    }

}
