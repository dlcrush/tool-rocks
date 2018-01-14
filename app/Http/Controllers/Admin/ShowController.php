<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\API\Contracts\BandRepository;
use App\Repositories\API\Contracts\ShowRepository;
use App\Repositories\API\Criteria\Expand;
use App\Repositories\API\Criteria\Filter;
use Carbon\Carbon;

class ShowController extends Controller
{

    protected $bandRepo;
    protected $showRepo;

    public function __construct(BandRepository $bandRepo, ShowRepository $showRepo) {
        $this->bandRepo = $bandRepo;
        $this->showRepo = $showRepo;
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

        $this->bandRepo->pushCriteria(new Expand('tours'));
        $band = $this->bandRepo->find($bandId);

        $tours = $band->tours;

        $tourId = $request->input('tourId', -1);

        if ($tourId == -1) {
            $tourId = $tours->first()->id;
        }

        $this->showRepo->pushCriteria(new Filter('tour_id', $tourId));
        $shows = $this->showRepo->all();

        return view('admin.shows.index', compact('band', 'bands', 'bandId', 'tours', 'tourId', 'shows'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {
        $bandId = $request->input('bandId', 1);
        $this->bandRepo->pushCriteria(new Expand('tours'));
        $band = $this->bandRepo->find($bandId);
        $tours = $band->tours;

        return view('admin.shows.create', compact('bandId', 'band', 'tours'));
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
            'tour_id' => 'required|numeric',
            'name' => 'required',
            'slug' => 'required',
            'date' => 'required',
            'venue_id' => 'nullable|numeric',
            'video_id' => 'nullable|numeric'
         ]);

        $show = $this->showRepo->create([
             'name' => $request->name,
             'slug' => $request->slug,
             'tour_id' => $request->tour_id,
             'date' => Carbon::parse($request->date),
             'venue_id' => $request->venue_id,
             'video_id' => $request->video_id
         ]);

        if ($request->has('songs')) {
            $songs = $request->songs;
            $startTimes = $request->start_time;
            $endTimes = $request->end_time;

            $songsShows = [];

            for($i = 0; $i < count($songs); $i ++) {
                $songId = $songs[$i];
                $startTime = $startTimes[$i];
                $endTime = $endTimes[$i];

                if ($songId != '' && $songId != null) {
                    array_push($songsShows, [
                        'show_id' => $show->id,
                        'song_id' => $songId,
                        'start_time' => $startTime,
                        'end_time' => $endTime,
                        'order' => $i + 1
                    ]);
                }
            }

            \DB::table('songs_shows')->insert($songsShows);
        }

         return redirect(action('Admin\ShowController@index'));
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
    public function edit($id, Request $request)
    {
        $bandId = $request->input('bandId', 1);
        $this->bandRepo->pushCriteria(new Expand('tours'));
        $band = $this->bandRepo->find($bandId);
        $tours = $band->tours;
        $this->showRepo->pushCriteria(new Expand('songs'));
        $show = $this->showRepo->find($id);

        return view('admin.shows.edit', compact('tours', 'band', 'show'));
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
            'tour_id' => 'required|numeric',
            'name' => 'required',
            'slug' => 'required',
            'date' => 'required',
            'venue_id' => 'nullable|numeric',
            'video_id' => 'nullable|numeric'
         ]);

         $this->showRepo->update([
             'name' => $request->name,
             'slug' => $request->slug,
             'tour_id' => $request->tour_id,
             'date' => Carbon::parse($request->date),
             'venue_id' => $request->venue_id,
             'video_id' => $request->video_id
         ], $id);

        \DB::table('songs_shows')->where('show_id', $id)->delete();

        if ($request->has('songs')) {
            $songs = $request->songs;
            $startTimes = $request->start_time;
            $endTimes = $request->end_time;

            $songsShows = [];

            for($i = 0; $i < count($songs); $i ++) {
                $songId = $songs[$i];
                $startTime = $startTimes[$i];
                $endTime = $endTimes[$i];

                if ($songId != '' && $songId != null) {
                    array_push($songsShows, [
                        'show_id' => $id,
                        'song_id' => $songId,
                        'start_time' => $startTime,
                        'end_time' => $endTime,
                        'order' => $i + 1
                    ]);
                }
            }

            \DB::table('songs_shows')->insert($songsShows);
        }

        return redirect(action('Admin\ShowController@index'));
    }

    public function delete($id) {
        $show = $this->showRepo->find($id);

        return view('admin.shows.delete', compact('show'));
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $this->showRepo->delete($id);

        return redirect(action('Admin\ShowController@index'));
    }
}
