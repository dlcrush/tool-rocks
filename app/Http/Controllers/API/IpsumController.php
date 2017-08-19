<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Repositories\API\Contracts\IpsumRepository;
use App\Transformers\IpsumTransformer;

class IpsumController extends APIController
{

    protected $ipsumRepo;
    protected $ipsumTransformer;

    public function __construct(IpsumRepository $ipsumRepo, IpsumTransformer $ipsumTransformer) {
        $this->ipsumRepo = $ipsumRepo;
        $this->ipsumTransformer = $ipsumTransformer;
    }

    public function getIpsums() {
        $ipsums = fractal()
           ->collection($this->ipsumRepo->all())
           ->transformWith($this->ipsumTransformer)
           ->toArray();

        return $this->respond($ipsums);
    }

    public function getIpsum($id) {
        $ipsum = fractal()
           ->item($this->ipsumRepo->find($id))
           ->transformWith($this->ipsumTransformer)
           ->toArray();

        return $this->respond($ipsum);
    }

}
