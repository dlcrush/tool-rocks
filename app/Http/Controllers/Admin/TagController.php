<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\API\Contracts\TagRepository;

class TagController extends Controller
{

    protected $tagRepo;

    public function __construct(TagRepository $tagRepo) {
        $this->tagRepo = $tagRepo;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $tags = $this->tagRepo->all();

        return view('admin.tags.index', compact('tags'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin.tags.create');
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
           'slug' => 'required|unique:tags'
        ]);

        $this->tagRepo->create([
            'name' => $request->name,
            'slug' => $request->slug
        ]);

        return redirect(action('Admin\TagController@index'));
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
        $tag = $this->tagRepo->find($id);

        return view('admin.tags.edit', compact('tag'));
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
           'name' => 'required',
           'slug' => 'required|unique:tags'
        ]);

        $this->tagRepo->update([
            'name' => $request->name,
            'slug' => $request->slug
        ], $id);

        return redirect(action('Admin\TagController@index'));
    }

    public function delete($id) {
        $tag = $this->tagRepo->find($id);

        return view('admin.tags.delete', compact('tag'));
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
