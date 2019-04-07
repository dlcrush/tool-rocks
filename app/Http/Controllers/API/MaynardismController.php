<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Repositories\API\Contracts\MaynardismRepository;
use App\Transformers\MaynardismTransformer;
use App\Repositories\API\Criteria\Expand;

class MaynardismController extends APIController
{

    protected $maynardismRepo;
    protected $maynardismTransformer;

    public function __construct(MaynardismRepository $maynardismRepo, MaynardismTransformer $maynardismTransformer) {
        $this->maynardismRepo = $maynardismRepo;
        $this->maynardismTransformer = $maynardismTransformer;
    }

    public function getMaynardisms() {
        $this->maynardismRepo->pushCriteria(new Expand('video'));

        $maynardisms = fractal()
           ->collection($this->maynardismRepo->all())
           ->transformWith($this->maynardismTransformer)
           ->parseIncludes('video')
           ->toArray();

        return $this->respond($maynardisms);
    }

    public function getMaynardism($id) {
        $this->maynardismRepo->pushCriteria(new Expand('video'));

        $maynardism = fractal()
           ->item($this->maynardismRepo->find($id))
           ->transformWith($this->maynardismTransformer)
           ->parseIncludes('video')
           ->toArray();

        return $this->respond($maynardism);
    }

}
