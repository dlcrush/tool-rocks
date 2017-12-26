<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Transformers\BandTransformer;
use App\Transformers\SongTransformer;
use App\Transformers\AlbumTransformer;
use App\Repositories\API\Contracts\BandRepository;
use App\Repositories\API\Criteria\Expand;

class BandController extends APIController
{

    protected $band;
    protected $bandTransformer;
    protected $songTransformer;

    public function __construct(BandRepository $band,
        BandTransformer $bandTransformer,
        SongTransformer $songTransformer,
        AlbumTransformer $albumTransformer) {
        $this->band = $band;
        $this->bandTransformer = $bandTransformer;
        $this->songTransformer = $songTransformer;
        $this->albumTransformer = $albumTransformer;
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

    private function getBandByIdOrSlug($bandId='tool') {
        $bandId = isset($bandId) ? $bandId : 'tool';

        return $this->band->findByIdOrSlug($bandId);
    }

    private function getSongByIdOrSlug($songs, $songId) {
        $song = $songs->where('id', $songId)->first();

        if (! isset($song)) {
            $song = $songs->where('slug', $songId)->first();
        }

        return $song;
    }
}
