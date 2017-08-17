<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Repositories\API\Contracts\YouTubeRepository;

class YouTubeController extends APIController
{

    protected $repo;

    public function __construct(YouTubeRepository $repo) {
        $this->repo = $repo;
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
        $video = $this->repo->getVideo(['id' => $id]);

        return $video;
    }

    public function getVideos()
    {
        $videos = $this->repo->getVideos(['chart' => 'mostPopular', 'regionCode' => 'US']);

        return $videos;
    }

    public function getVideosByChannel($channelName)
    {
        $videos = $this->repo->getVideosByChannel($channelName);

        return $videos;
    }

    public function getChannel($id)
    {
        $channel = $this->repo->getChannelById($id);

        return $channel;
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
