<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

class IpsumController extends APIController
{

    protected $ipsumRepo;
    protected $ipsumTransformer;

    public function __construct(IpsumRepository $ipsumRepo, IpsumTransformer $ipsumTransformer) {
        $this->ipsumRepo = $band;
        $this->ipsumTransformer = $bandTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $ipsums = fractal()
           ->collection($this->ipsumRepo->all())
           ->transformWith($this->ipsumTransformer)
           ->toArray();

        return $this->respond($ipsums);

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
        $ipsum = fractal()
           ->item($this->ipsumRepo->find($id))
           ->transformWith($this->ipsumTransformer)
           ->toArray();

        return $this->respond($ipsum);
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
