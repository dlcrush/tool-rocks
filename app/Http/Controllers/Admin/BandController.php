<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\API\Contracts\BandRepository;
use App\Band;

class BandController extends Controller
{

    protected $bandRepo;

    public function __construct(BandRepository $bandRepo) {
        $this->bandRepo = $bandRepo;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $bands = $this->bandRepo->all();

        return view('admin.bands.index', compact('bands'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin.bands.create');
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
           'slug' => 'required|unique:bands'
        ]);

        $this->bandRepo->create([
            'name' => $request->name,
            'slug' => $request->slug
        ]);

        return redirect(action('Admin\BandController@index'));
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $band = $this->bandRepo->find($id);

        return view('admin.bands.show', compact('band'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $band = $this->bandRepo->find($id);

        return view('admin.bands.edit', compact('band'));
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
        $this->bandRepo->update([
            'name' => $request->name,
            'slug' => $request->slug
        ], $id);

        return redirect(action('Admin\BandController@index'));
    }

    public function delete($id) {
        $band = $this->bandRepo->find($id);

        return view('admin.bands.delete', compact('band'));
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
