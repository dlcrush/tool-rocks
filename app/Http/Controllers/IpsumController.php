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
        $numParagraphs = min(max($request->get('paragraphs', 4), 0), 100);
        $bandSlug = 'tool';
        $bandId = $this->bandRepo->findWhere('slug', $bandSlug)->first()->id;
        $sizeOfParagraph = $request->get('paragraphSize', 'medium');
        $itemsPerParagraph = $this->itemsPerParagraph($sizeOfParagraph);
        $paragraphs = new Collection();

        $ipsums = $this->ipsumRepo->findWhere('band_id', $bandId);
        $numIpsums = $ipsums->count();

        for($i = 0; $i < $numParagraphs; $i ++) {
            $paragraph = '';
            for($j = 0; $j < $itemsPerParagraph; $j ++) {
                $idx = rand(0, $numIpsums-1);

                $ipsum = $ipsums->get($idx)->content;

                $paragraph .= ' ' . $ipsum;
            }
            $paragraphs->push($paragraph);
        }

        return view('ipsum', compact('paragraphs', 'numParagraphs', 'sizeOfParagraph'));
    }

    protected function itemsPerParagraph($paragraphSize) {
        $mappings = [
            'small' => 5,
            'medium' => 8,
            'large' => 15,
            'huge' => 25
        ];

        return $mappings[$paragraphSize];
    }
}
