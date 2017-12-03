<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\API\Contracts\BandRepository;
use App\Repositories\API\Contracts\AlbumRepository;
use App\Repositories\API\Contracts\SongRepository;
use App\Repositories\API\Criteria\Expand;

class SongController extends Controller
{

    protected $bandRepo;
    protected $albumRepo;
    protected $songRepo;

    public function __construct(SongRepository $songRepo, AlbumRepository $albumRepo, BandRepository $bandRepo) {
        $this->songRepo = $songRepo;
        $this->albumRepo = $albumRepo;
        $this->bandRepo = $bandRepo;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $bands = $this->bandRepo->all();

        $bandId =  $request->input('bandId', -1);

        if ($bandId == -1) {
            $bandId = $bands->first()->id;
        }

        $this->bandRepo->pushCriteria(new Expand('songs'));
        $band = $this->bandRepo->find($bandId);

        $songs = $band->songs;

        return view('admin.songs.index', compact('band', 'bands', 'bandId', 'songs'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $bands = $this->bandRepo->all();

        return view('admin.songs.create', compact('bands'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        var_dump($request->all());
        //die();

        $this->validate($request, [
            'band_id' => 'required|numeric',
            'name' => 'required',
            'slug' => 'required',
            'has_lyircs' => 'nullable|boolean',
            'lyrics' => 'nullable|string',
            'lyrics_video_id' => 'nullable|string'
         ]);

         $this->songRepo->create([
             'name' => $request->name,
             'slug' => $request->slug,
             'band_id' => $request->band_id,
             'has_lyrics' => $request->has_lyrics == true,
             'lyrics' => $request->lyrics,
             'lyrics_video_id' => $request->lyrics_video_id
         ]);

         return redirect(action('Admin\SongController@index'));
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
        $song = $this->songRepo->find($id);
        $bands = $this->bandRepo->all();

        return view('admin.songs.edit', compact('song', 'bands'));
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
        $this->validate($request, [
            'band_id' => 'required|numeric',
            'name' => 'required',
            'slug' => 'required',
            'has_lyircs' => 'nullable|boolean',
            'lyrics' => 'nullable|string',
            'lyrics_video_id' => 'nullable|string'
         ]);

         $this->songRepo->update([
             'name' => $request->name,
             'slug' => $request->slug,
             'band_id' => $request->band_id,
             'has_lyrics' => $request->has_lyrics == true,
             'lyrics' => $request->lyrics,
             'lyrics_video_id' => $request->lyrics_video_id
         ], $id);

         return redirect(action('Admin\SongController@index'));
    }

    public function delete($id) {
        $song = $this->songRepo->find($id);

        return view('admin.songs.delete', compact('song'));
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $this->songRepo->delete($id);

        return redirect(action('Admin\SongController@index'));
    }
}
