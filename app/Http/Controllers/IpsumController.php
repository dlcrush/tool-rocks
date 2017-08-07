<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\API\Contracts\IpsumRepository;
use App\Repositories\API\Contracts\BandRepository;
use Illuminate\Support\Collection;

class IpsumController extends Controller
{

    protected $ipsumRepo;

    public function __construct(IpsumRepository $ipsumRepo, BandRepository $bandRepo) {
        $this->ipsumRepo = $ipsumRepo;
        $this->bandRepo = $bandRepo;
    }

    public function generate(Request $request) {
        $numParagraphs = max($request->get('paragraphs', 4), 0);
        $bandSlug = 'tool';
        $bandId = $this->bandRepo->findWhere('slug', $bandSlug)->first()->id;
        $sizeOfParagraph = 8; // how many items per paragraph
        $paragraphs = new Collection();

        $ipsums = $this->ipsumRepo->findWhere('band_id', $bandId);
        $numIpsums = $ipsums->count();

        for($i = 0; $i < $numParagraphs; $i ++) {
            $paragraph = '';
            for($j = 0; $j < $sizeOfParagraph; $j ++) {
                $idx = rand(0, $numIpsums-1);

                $ipsum = $ipsums->get($idx)->content;

                $paragraph .= ' ' . $ipsum;
            }
            $paragraphs->push($paragraph);
        }

        return view('ipsum', compact('paragraphs'));
    }
}
