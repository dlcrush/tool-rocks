<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\API\Contracts\BandRepository;
use App\Repositories\API\Contracts\TourRepository;
use App\Repositories\API\Criteria\Expand;
use Carbon\Carbon;

class TourController extends Controller
{

    protected $bandRepo;
    protected $tourRepo;

    public function __construct(BandRepository $bandRepo, TourRepository $tourRepo) {
        $this->bandRepo = $bandRepo;
        $this->tourRepo = $tourRepo;
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

        $tours = $band->tours;

        return view('admin.tours.index', compact('band', 'bands', 'bandId', 'tours'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $bands = $this->bandRepo->all();

        return view('admin.tours.create', compact('bands'));
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
            'band_id' => 'required|numeric',
            'name' => 'required',
            'slug' => 'required',
            'date' => 'required'
         ]);

         $this->tourRepo->create([
             'name' => $request->name,
             'slug' => $request->slug,
             'band_id' => $request->band_id,
             'date' => Carbon::parse($request->date)
         ]);

         return redirect(action('Admin\TourController@index'));
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
        $tour = $this->tourRepo->find($id);
        $bands = $this->bandRepo->all();

        return view('admin.tours.edit', compact('tour', 'bands'));
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
            'date' => 'required'
         ]);

        $this->tourRepo->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'band_id' => $request->band_id,
            'date' => Carbon::parse($request->date)
        ], $id);

        return redirect(action('Admin\TourController@index'));
    }

    public function delete($id) {
        $tour = $this->tourRepo->find($id);

        return view('admin.tours.delete', compact('tour'));
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $this->tourRepo->delete($id);

        return redirect(action('Admin\TourController@index'));
    }
}
