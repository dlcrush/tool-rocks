<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Transformers\BandTransformer;
use App\Repositories\API\Contracts\BandRepository;
use App\Repositories\API\Criteria\Bands\ExpandAlbumsAndSongs;

class BandController extends APIController
{

    protected $band;
    protected $bandTransformer;

    public function __construct(BandRepository $band, BandTransformer $bandTransformer) {
        $this->band = $band;
        $this->bandTransformer = $bandTransformer;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $this->band->pushCriteria(new ExpandAlbumsAndSongs());

        $bands = fractal()
           ->collection($this->band->all())
           ->transformWith($this->bandTransformer)
           ->parseIncludes('albums.songs')
           ->toArray();

        return $this->respond($bands);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        //
    }
}
