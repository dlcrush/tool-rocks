<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\MaynardismRepository;
use Illuminate\Support\Collection;

class MaynardismController extends Controller
{

    protected $ipsumRepo;

    public function __construct(MaynardismRepository $maynardismRepo) {
        $this->maynardismRepo = $maynardismRepo;
    }

    public function getMaynardisms() {
        $maynardisms = $this->maynardismRepo->getMaynardisms();

        return view('maynardisms.index', compact('maynardisms'));
    }

    public function getMaynardism($id) {
        $maynardism = $this->maynardismRepo->getMaynardism($id);

        return view('maynardisms.show', compact('maynardism'));
    }
}
