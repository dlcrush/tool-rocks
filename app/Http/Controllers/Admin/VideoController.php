<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\API\Contracts\BandRepository;
use App\Repositories\API\Contracts\SongRepository;
use App\Repositories\API\Contracts\VideoRepository;
use App\Repositories\API\Criteria\Expand;

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
        $this->bandRepo->pushCriteria(new Expand('songs'));
        $bands = $this->bandRepo->all();

        return view('admin.videos.create', compact('bands'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        $video = $this->videoRepo->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'video_id' => $request->youtube_id,
            'band_id' => $request->band,
            'source' => 'youtube'
        ]);

        if ($request->has('tags')) {
            $tags = explode(",", $request->tags);
            $videosTags = [];
            foreach($tags as $tag) {
                array_push($videosTags, [
                    'video_id' => $video->id,
                    'tag_id' => $tag
                ]);
            }

            \DB::table('videos_tags')->insert($videosTags);
        }

        if ($request->has('songs')) {
            $songs = $request->songs;
            $startTimes = $request->start_time;
            $endTimes = $request->end_time;

            $songsVideos = [];

            for($i = 0; $i < count($songs); $i ++) {
                $songId = $songs[$i];
                $startTime = $startTimes[$i];
                $endTime = $endTimes[$i];

                array_push($songsVideos, [
                    'video_id' => $video->id,
                    'song_id' => $songId,
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'order' => $i + 1
                ]);
            }

            \DB::table('videos_songs')->insert($songsVideos);
        }

        //die();

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
        $this->videoRepo->pushCriteria(new Expand(['songs', 'tags']));
        $video = $this->videoRepo->find($id);
        $this->bandRepo->pushCriteria(new Expand('songs'));
        $bands = $this->bandRepo->all();

        return view('admin.videos.edit', compact('video', 'bands'));
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
        $this->validateRequest($request);

        $this->videoRepo->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'video_id' => $request->youtube_id,
            'band_id' => $request->band,
            'source' => 'youtube'
        ], $id);

        // This is kinda dumb, should probably pull the existing to see if anything has changed.
        // But for now, I'll go with this.
        \DB::table('videos_tags')->where('video_id', $id)->delete();
        \DB::table('videos_songs')->where('video_id', $id)->delete();

        if ($request->has('tags')) {
            $tags = explode(",", $request->tags);
            $videosTags = [];
            foreach($tags as $tag) {
                array_push($videosTags, [
                    'video_id' => $id,
                    'tag_id' => $tag
                ]);
            }

            \DB::table('videos_tags')->insert($videosTags);
        }

        if ($request->has('songs')) {
            $songs = $request->songs;
            $startTimes = $request->start_time;
            $endTimes = $request->end_time;

            $songsVideos = [];

            for($i = 0; $i < count($songs); $i ++) {
                $songId = $songs[$i];
                $startTime = $startTimes[$i];
                $endTime = $endTimes[$i];

                if ($songId != '' && $songId != null) {
                    array_push($songsVideos, [
                        'video_id' => $id,
                        'song_id' => $songId,
                        'start_time' => $startTime,
                        'end_time' => $endTime,
                        'order' => $i + 1
                    ]);
                }
            }

            \DB::table('videos_songs')->insert($songsVideos);
        }

        return redirect(action('Admin\VideoController@index'));
    }

    public function delete($id) {
        $video = $this->videoRepo->find($id);

        return view('admin.videos.delete', compact('video'));
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

    private function validateRequest($request) {
        switch($request->method()) {
            case 'POST':
                $this->validate($request, [
                   'name' => 'required',
                   'slug' => 'required|unique:videos',
                   'description' => 'required',
                   'youtube_id' => 'required',
                   'band' => 'required'
                ]);
                break;
            case 'PUT':
                $this->validate($request, [
                   'name' => 'required',
                   'slug' => 'required|unique:videos,id,' . $request->id,
                   'description' => 'required',
                   'youtube_id' => 'required',
                   'band' => 'required'
                ]);
                break;
            default:
                break;
        }
    }
}
