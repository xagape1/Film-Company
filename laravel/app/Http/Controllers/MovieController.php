<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

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
    // Validar dades del formulari
    $validatedData = $request->validate([
        'title'       => 'required',
        'description' => 'required',
        'gender'      => 'required',
        'duration'    => 'required',
        'upload'      => 'required|mimes:gif,jpeg,jpg,png,mp4|max:2048',
    ]);
    
    // Obtenir dades del formulari
    $title       = $request->get('title');
    $description = $request->get('description');
    $gender      = $request->get('gender');
    $duration    = $request->get('duration');
    $upload      = $request->file('upload');

    // Desar fitxer al disc i inserir dades a BD
    $file = new File();
    $fileOk = $file->diskSave($upload);

    if ($fileOk) {
        // Desar dades a BD
        Log::debug("Saving movie at DB...");
        $movie = Movie::create([
            'title'       => $title,
            'description' => $description,
            'gender'      => $gender,
            'duration'    => $duration,
            'files_id'    => $file->id,
        ]);
        Log::debug("DB storage OK");
        // Patró PRG amb missatge d'èxit
        return redirect()->route('movies.show', $movie)
            ->with('success', __('Movie successfully saved'));
    } else {
        // Patró PRG amb missatge d'error
        return redirect()->route("movies.create")
            ->with('error', __('ERROR Uploading file'));
    }
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