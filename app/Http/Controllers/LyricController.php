<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\BandRepository;

class LyricController extends Controller
{
    protected $bandRepo;

    public function __construct(BandRepository $bandRepo) {
        $this->bandRepo = $bandRepo;
    }

    public function getLyric($songId) {
        $song = $this->bandRepo->getSong('tool', $songId);

        return view('lyrics.show', compact('song'));
    }

    public function getLyrics($bandId='tool') {
        $band = $this->bandRepo->getBand($bandId);
        $albums = array_get($band, 'albums.data');
        $albums = array_where($albums, function($album) {
            return $album['slug'] != '72826';
        });
        return view('lyrics.index', compact('albums'));
    }
}
