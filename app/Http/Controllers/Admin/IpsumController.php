<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\API\Contracts\IpsumRepository;
use App\Repositories\API\Contracts\BandRepository;

class IpsumController extends Controller
{

    protected $ipsumRepo;
    protected $bandRepo;

    public function __construct(IpsumRepository $ipsumRepo, BandRepository $bandRepo) {
        $this->ipsumRepo = $ipsumRepo;
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

        $ipsums = $this->ipsumRepo->findWhere('band_id', $bandId);

        return view('admin.ipsums.index', compact('ipsums', 'bands', 'bandId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bands = $this->bandRepo->all();

        return view('admin.ipsums.create', compact('bands'));
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
           'content' => 'required',
           'band_id' => 'required'
        ]);

        $this->ipsumRepo->create([
            'content' => $request->content,
            'band_id' => $request->band_id
        ]);

        return redirect(action('Admin\IpsumController@index'));
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

    public function delete($id) {
        $ipsum = $this->ipsumRepo->find($id);

        return view('admin.ipsums.delete', compact('ipsum'));
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
