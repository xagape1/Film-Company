<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\File;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all();
        return response()->json($movies);
    }

    public function create()
    {
        return view("movies.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Verificamos si se subió un archivo
        if (!$request->hasFile('file')) {
            return response()->json([
                'error' => 'No file provided'
            ], 400);
        }

        // Validamos que el archivo sea una imagen
        if (!$request->file('file')->isValid() || !in_array($request->file('file')->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
            return response()->json([
                'error' => 'Invalid file'
            ], 400);
        }

        // Creamos un nuevo archivo y lo guardamos en el servidor
        $file = new File;
        $file->filename = $request->file('file')->getClientOriginalName();
        $file->filesize = $request->file('file')->getSize();
        $file->filepath = $request->file('file')->store('public/uploads');
        $file->save();

        // Creamos una nueva película y la guardamos en la base de datos
        $movie = new Movie;
        $movie->title = $request->input('title');
        $movie->description = $request->input('description');
        $movie->year = $request->input('year');
        $movie->files_id = $file->id;
        $movie->save();

        return response()->json($movie);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::find($id);

        if ($movie) {
            return response()->json($movie);
        } else {
            return response()->json([
                'error' => 'Movie not found'
            ], 404);
        }
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
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                'error' => 'Movie not found'
            ], 404);
        }

        $movie->fill($request->all());

        if ($movie->save()) {
            return response()->json($movie);
        } else {
            return response()->json([
                'error' => 'Error while updating movie'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                'error' => 'Movie not found'
            ], 404);
        }

        if ($movie->delete()) {
            return response()->json([
                'message' => 'Movie deleted successfully'
            ]);
        } else {
            return response()->json([
                'error' => 'Error while deleting movie'
            ], 500);
        }
    }
}