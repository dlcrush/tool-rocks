<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Transformers\BandTransformer;
use App\Transformers\SongTransformer;
use App\Transformers\AlbumTransformer;
use App\Transformers\TourTransformer;
use App\Transformers\ShowTransformer;
use App\Repositories\API\Contracts\BandRepository;
use App\Repositories\API\Criteria\Expand;

class BandController extends APIController
{

    protected $band;
    protected $bandTransformer;
    protected $songTransformer;
    protected $albumTransformer;
    protected $tourTransformer;
    protected $showTransformer;

    public function __construct(BandRepository $band,
        BandTransformer $bandTransformer,
        SongTransformer $songTransformer,
        AlbumTransformer $albumTransformer,
        TourTransformer $tourTransformer,
        ShowTransformer $showTransformer) {
        $this->band = $band;
        $this->bandTransformer = $bandTransformer;
        $this->songTransformer = $songTransformer;
        $this->albumTransformer = $albumTransformer;
        $this->tourTransformer = $tourTransformer;
        $this->showTransformer = $showTransformer;
    }

    public function getBands()
    {
        $this->band->pushCriteria(new Expand('albums.songs'));

        $bands = fractal()
           ->collection($this->band->all())
           ->transformWith($this->bandTransformer)
           ->parseIncludes('albums.songs')
           ->toArray();

        return $this->respond($bands);
    }

    public function getSongs($bandId) {
        $this->band->pushCriteria(new Expand('songs'));

        $band = $this->getBandByIdOrSlug($bandId);

        $songs = fractal()
           ->collection($band->songs)
           ->transformWith($this->songTransformer)
           ->toArray();

        return $this->respond($songs);
    }

    public function getAlbums($bandId) {
        $this->band->pushCriteria(new Expand('albums'));

        $band = $this->band->find($id);

        $albums = fractal()
           ->collection($band->albums)
           ->transformWith($this->albumTransformer)
           ->toArray();

        return $this->respond($albums);
    }

    public function getBand($bandId='tool') {
        $this->band->pushCriteria(new Expand('albums.songs.video'));

        $band = $this->getBandByIdOrSlug($bandId);

        $bandResp = fractal()
            ->item($band)
            ->transformWith($this->bandTransformer)
            ->parseIncludes('albums.songs')
            ->toArray();

        return $this->respond($bandResp);
    }

    public function getSong($bandId='tool',$songId) {
        $this->band->pushCriteria(new Expand('albums'));

        $band = $this->getBandByIdOrSlug($bandId);
        $song = $this->getSongByIdOrSlug($band->songs, $songId);

        $songResp = fractal()
            ->item($song)
            ->transformWith($this->songTransformer)
            ->parseIncludes(['band', 'albums'])
            ->toArray();

        return $this->respond($songResp);
    }

    public function getTours($bandId='tool') {
        $this->band->pushCriteria(new Expand('tours.shows'));

        $band = $this->getBandByIdOrSlug($bandId);

        $tours = fractal()
            ->collection($band->tours)
            ->transformWith($this->tourTransformer)
            ->parseIncludes(['shows'])
            ->toArray();

        return $this->respond($tours);
    }

    public function getTour($bandId='tool', $tourId) {
        $this->band->pushCriteria(new Expand('tours.shows.video'));

        $band = $this->getBandByIdOrSlug($bandId);

        $tour = $this->getTourByIdOrSlug($band->tours, $tourId);

        $tourResp = fractal()
            ->item($tour)
            ->transformWith($this->tourTransformer)
            ->parseIncludes(['shows.video'])
            ->toArray();

        return $this->respond($tourResp);
    }

    public function getShow($bandId='tool', $tourId, $showId) {
        $this->band->pushCriteria(new Expand(['tours.shows.songs', 'tours.shows.video']));

        $band = $this->getBandByIdOrSlug($bandId);

        $tour = $this->getTourByIdOrSlug($band->tours, $tourId);

        $show = $this->getShowByIdOrSlug($tour->shows, $showId);

        $showResp = fractal()
            ->item($show)
            ->transformWith($this->showTransformer)
            ->parseIncludes(['songs', 'video'])
            ->toArray();

        return $this->respond($showResp);
    }

    private function getBandByIdOrSlug($bandId='tool') {
        $bandId = isset($bandId) ? $bandId : 'tool';

        return $this->band->findByIdOrSlug($bandId);
    }

    private function getSongByIdOrSlug($songs, $songId) {
        $song = null;

        if (is_numeric($songId)) {
            $song = $songs->where('id', $songId)->first();
        }

        if (! isset($song)) {
            $song = $songs->where('slug', $songId)->first();
        }

        return $song;
    }

    private function getTourByIdOrSlug($tours, $tourId) {
        $tour = null;

        if (is_numeric($tourId)) {
            $tour = $tours->where('id', $tourId)->first();
        }

        if (! isset($tour)) {
            $tour = $tours->where('slug', $tourId)->first();
        }

        return $tour;
    }

    private function getShowByIdOrSlug($shows, $showId) {
        $show = null;

        if (is_numeric($showId)) {
            $show = $shows->where('id', $showId)->first();
        }

        if (! isset($show)) {
            $show = $shows->where('slug', $showId)->first();
        }

        return $show;
    }

}
