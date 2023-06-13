<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Cover;
use App\Models\Intro;
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

        $cover = new Cover();
        $coverOk = $cover->diskSave($validatedData['cover']);

        $intro = new Intro();
        $introOk = $intro->diskSave($validatedData['intro']);

        if ($coverOk && $introOk) {
            $movie = Movie::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'gender' => $validatedData['gender'],
                'cover_id' => $cover->id,
                'intro_id' => $intro->id,
            ]);

            if ($movie) {
                return redirect()->route('movies.show', $movie)
                    ->with('success', __('Movie successfully saved'));
            } else {
                return redirect()->route("movies.create")
                    ->with('error', __('Error while saving movie'));
            }
        } else {
            return redirect()->route("movies.create")
                ->with('error', __('Error uploading cover or intro'));
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

        $movie = Movie::find($id);

        if ($movie) {
            if (isset($validatedData['cover'])) {
                $cover = new Cover();
                $coverOk = $cover->diskSave($validatedData['cover']);

                if ($coverOk) {
                    $movie->cover_id = $cover->id;
                } else {
                    return redirect()->route("movies.edit", $movie)
                        ->with('error', __('Error uploading cover'));
                }
            }

            if (isset($validatedData['intro'])) {
                $intro = new Intro();
                $introOk = $intro->diskSave($validatedData['intro']);

                if ($introOk) {
                    $movie->intro_id = $intro->id;
                } else {
                    return redirect()->route("movies.edit", $movie)
                        ->with('error', __('Error uploading intro'));
                }
            }

            $movie->title = $validatedData['title'];
            $movie->description = $validatedData['description'];
            $movie->gender = $validatedData['gender'];
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
