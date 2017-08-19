<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\API\Contracts\BandRepository;
use App\Repositories\API\Contracts\AlbumRepository;
use App\Repositories\API\Contracts\SongRepository;
use App\Repositories\API\Criteria\Expand;

class AlbumController extends Controller
{
    protected $bandRepo;
    protected $albumRepo;
    protected $songRepo;

    public function __construct(AlbumRepository $albumRepo, BandRepository $bandRepo, SongRepository $songRepo) {
        $this->albumRepo = $albumRepo;
        $this->bandRepo = $bandRepo;
        $this->songRepo = $songRepo;
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

        $albums = $this->albumRepo->findWhere('band_id', $bandId);

        return view('admin.albums.index', compact('bands', 'albums', 'bandId'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin.albums.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|unique:posts|max:255',
           'body' => 'required',
       ]);

        $input = $request->all();


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
        $this->albumRepo->pushCriteria(new Expand(['band', 'songs']));
        $album = $this->albumRepo->find($id);

        $input = [
            'id' => $album->id,
            'name' => $album->name,
            'slug' => $album->slug
        ];

        return view('admin.albums.edit', compact('album'))->withInput($input);
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
