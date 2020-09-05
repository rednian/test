<?php

namespace App\Http\Controllers;

use App\Movies;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 10;  
        $movies = Movies::orderBy('created_at')->paginate(10);
        return response()->json($movies, 200);
    }

 
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'genre'=>'required',
            'duration'=>'required',
            'release_date'=>'required',
        ]);
        $movie = Movies::create($request->all());
        return response()->json($movie, 201);
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
        $request->validate([
            'title'=>'required',
            'genre'=>'required',
            'duration'=>'required',
            'release_date'=>'required',
        ]);
        // $movie = $movie->update($request->all());
        $movie = Movies::findOrFail($id)->update($request->all());
        return response()->json($movie, 200);
    }

  
    public function destroy($id)
    {
        // $movies->delete();
       return response()->json(Movies::findOrFail($id)->delete(), 200);
    }


}
