<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Transformers\TagTransformer;
use App\Repositories\API\Contracts\TagRepository;

class TagController extends APIController
{

    protected $tagRepo;
    protected $tagTransformer;

    public function __construct(TagRepository $tagRepo, TagTransformer $tagTransformer) {
        $this->tagRepo = $tagRepo;
        $this->tagTransformer = $tagTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tags = fractal()
           ->collection($this->tagRepo->all())
           ->transformWith($this->tagTransformer)
           ->toArray();

        return $this->respond($tags);

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
