<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\VideoRepository;

class LyricController extends Controller
{
    protected $bandRepo;
    protected $songRepo;

    // public function __construct(VideoRepository $bandRepo, SongRepository $songRepo) {
    //     $this->bandRepo = $bandRepo;
    //     $this->songRepo = $songRepo;
    // }

    // public function getLyric($bandId, $songId) {
    //     $song = $this->bandRepo->getSong($bandId, $songId);

    //     return view('lyrics.show', compact('song'));
    // }

    public function getLyric() {
        //$song = $this->bandRepo->getSong($bandId, $songId);

        return view('lyrics.show');
    }

    public function getLyrics() {
        return view('lyrics.index');
    }

    // public function getLyrics($bandId) {
    //     $band = $this->bandRepo->getBand();

    //     return view('lyrics.index', compact('band'));
    // }
}
