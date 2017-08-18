<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\API\Contracts\BandRepository;
use App\Repositories\API\Contracts\SongRepository;
use App\Repositories\API\Contracts\VideoRepository;
use App\Repositories\API\Criteria\Bands\ExpandSongs;

class VideoController extends Controller
{

    protected $bandRepo;
    protected $songRepo;
    protected $videoRepo;

    public function __construct(SongRepository $songRepo, BandRepository $bandRepo, VideoRepository $videoRepo) {
        $this->songRepo = $songRepo;
        $this->bandRepo = $bandRepo;
        $this->videoRepo = $videoRepo;
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

        $videos = $this->videoRepo->findWhere('band_id', $bandId);

        return view('admin.videos.index', compact('bands', 'videos', 'bandId'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin.videos.create');
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
           'name' => 'required',
           'slug' => 'required|unique:videos',
           'description' => 'required',
           'youtube_id' => 'required'
        ]);

        $this->videoRepo->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'video_id' => $request->youtube_id,
            'band_id' => 1,
            'source' => 'youtube'
        ]);

        return redirect(action('Admin\VideoController@index'));
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
