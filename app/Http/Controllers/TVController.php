<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\TVRepository;

class TVController extends Controller
{
    protected $tvRepo;

    public function __construct(TVRepository $tvRepo) {
        $this->tvRepo = $tvRepo;
    }

    public function index() {
        $tv = $this->tvRepo->getTV();

        return view('tv.index', compact('tv'));
    }
}
