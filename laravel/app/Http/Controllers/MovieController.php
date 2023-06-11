<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Cover;
use App\Models\Intro;

use Illuminate\Http\Request;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'gender' => 'required',
            'cover' => 'nullable|file|mimes:jpeg,png',
            'intro' => 'nullable|file|mimes:mp4',
        ]);

        $title = $request->input('title');
        $description = $request->input('description');
        $gender = $request->input('gender');
        $cover = $request->file('cover');
        $intro = $request->file('intro');

        // Guardar la portada (cover)
        $coverPath = $cover->store('covers', 'public');
        $cover = Cover::create([
            'path' => $coverPath,
        ]);

        // Guardar el video de introducción (intro)
        $introPath = $intro->store('intros', 'public');
        $intro = Intro::create([
            'path' => $introPath,
        ]);

        // Crear la película y asociar la portada y el intro
        $movie = Movie::create([
            'title' => $title,
            'description' => $description,
            'gender' => $gender,
            'cover_id' => $cover->id,
            'intro_id' => $intro->id,
        ]);

        return redirect()->route('movies.show', $movie)
            ->with('success', __('Movie successfully saved'));
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie = Movie::find($id);

        if ($movie) {
            return view("movies.edit", compact('movie'));
        } else {
            return redirect()->route("movies.index")
                ->with('error', __('Movie not found'));
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
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'gender' => 'required',
            'cover' => 'nullable|file|mimes:jpeg,png',
            'intro' => 'nullable|file|mimes:mp4',
        ]);

        $title = $request->input('title');
        $description = $request->input('description');
        $gender = $request->input('gender');
        $cover = $request->file('cover');
        $intro = $request->file('intro');

        $movie = Movie::find($id);

        if ($movie) {
            // Actualizar la portada (cover) si se proporciona un nuevo archivo
            if ($cover) {
                $coverPath = $cover->store('covers', 'public');
                $cover->delete(); // Eliminar el archivo anterior, si existe
                $movie->cover->path = $coverPath;
                $movie->cover->save();
            }

            // Actualizar el video de introducción (intro) si se proporciona un nuevo archivo
            if ($intro) {
                $introPath = $intro->store('intros', 'public');
                $intro->delete(); // Eliminar el archivo anterior, si existe
                $movie->intro->path = $introPath;
                $movie->intro->save();
            }

            // Actualizar otros datos de la película
            $movie->title = $title;
            $movie->description = $description;
            $movie->gender = $gender;
            $movie->save();

            return redirect()->route('movies.show', $movie)
                ->with('success', __('Movie successfully updated'));
        } else {
            return redirect()->route("movies.index")
                ->with('error', __('Movie not found'));
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