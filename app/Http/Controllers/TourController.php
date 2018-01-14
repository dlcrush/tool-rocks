<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\BandRepository;

class TourController extends Controller
{
    protected $bandRepo;

    public function __construct(BandRepository $bandRepo) {
        $this->bandRepo = $bandRepo;
    }

    public function getTours() {
        $tours = $this->bandRepo->getTours('tool');

        return view('tours.index', compact('tours'));
    }

    public function getTour($id) {
        $tour = $this->bandRepo->getTour('tool', $id);

        return view('tours.show', compact('tour'));
    }

    public function getShow($tourId, $showId) {
        $show = $this->bandRepo->getShow('tool', $tourId, $showId);

        return view('tours.shows.show', compact('show'));
    }
}
