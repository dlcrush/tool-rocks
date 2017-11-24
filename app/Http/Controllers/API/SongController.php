<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Transformers\SongTransformer;
use App\Repositories\API\Contracts\SongRepository;
use App\Repositories\API\Criteria\Songs\ExpandBand;

class SongController extends APIController
{

    protected $song;
    protected $songTransformer;

    public function __construct(SongRepository $song, SongTransformer $songTransformer) {
        $this->song = $song;
        $this->songTransformer = $songTransformer;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $this->song->pushCriteria(new Expand(['songs.band', 'songs.album']));

        $songs = fractal()
           ->collection($this->song->all())
           ->transformWith($this->songTransformer)
           ->includeBand()
           ->includeAlbums()
           ->toArray();

        return $this->respond($songs);
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
        $this->song->pushCriteria(new Expand(['songs.band', 'songs.album']));

        $song = fractal()
           ->item($this->song->find($id))
           ->transformWith($this->songTransformer)
           ->includeBand()
           ->includeAlbums()
           ->toArray();

        return $this->respond($song);
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
