<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Cover;
use App\Models\Intro;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series = Serie::all();
        return response()->json($series);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("series.create");
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
            'seasons' => 'required|integer|min:1',
            'episodes' => 'required|integer|min:1',
            'cover' => 'nullable|file|mimes:jpeg,png',
            'intro' => 'nullable|file|mimes:mp4',
        ]);

        $cover = new Cover();
        $coverOk = $cover->diskSave($validatedData['cover']);

        $intro = new Intro();
        $introOk = $intro->diskSave($validatedData['intro']);

        if ($coverOk && $introOk) {
            $serie = Serie::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'gender' => $validatedData['gender'],
                'seasons' => $validatedData['seasons'],
                'episodes' => $validatedData['episodes'],
                'cover_id' => $cover->id,
                'intro_id' => $intro->id,
            ]);

            if ($serie) {
                return redirect()->route('series.show', $serie)
                    ->with('success', __('Serie successfully saved'));
            } else {
                return redirect()->route("series.create")
                    ->with('error', __('Error while saving serie'));
            }
        } else {
            return redirect()->route("series.create")
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
        $serie = Serie::find($id);

        if ($serie) {
            return response()->json($serie);
        } else {
            return response()->json([
                'error' => 'Serie not found'
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
        $serie = Serie::find($id);

        if ($serie) {
            return view("series.edit", compact('serie'));
        } else {
            return redirect()->route("series.index")
                ->with('error', __('Serie not found'));
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
            'seasons' => 'required|integer|min:1',
            'episodes' => 'required|integer|min:1',
            'cover' => 'nullable|file|mimes:jpeg,png',
            'intro' => 'nullable|file|mimes:mp4',
        ]);

        $serie = Serie::find($id);

        if ($serie) {
            if (isset($validatedData['cover'])) {
                $cover = new Cover();
                $coverOk = $cover->diskSave($validatedData['cover']);

                if ($coverOk) {
                    $serie->cover_id = $cover->id;
                } else {
                    return redirect()->route("series.edit", $serie)
                        ->with('error', __('Error uploading cover'));
                }
            }

            if (isset($validatedData['intro'])) {
                $intro = new Intro();
                $introOk = $intro->diskSave($validatedData['intro']);

                if ($introOk) {
                    $serie->intro_id = $intro->id;
                } else {
                    return redirect()->route("series.edit", $serie)
                        ->with('error', __('Error uploading intro'));
                }
            }

            $serie->title = $validatedData['title'];
            $serie->description = $validatedData['description'];
            $serie->gender = $validatedData['gender'];
            $serie->seasons = $validatedData['seasons'];
            $serie->episodes = $validatedData['episodes'];
            $serie->save();

            return redirect()->route('series.show', $serie)
                ->with('success', __('Serie successfully updated'));
        } else {
            return redirect()->route("series.index")
                ->with('error', __('Serie not found'));
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
        $serie = Serie::find($id);

        if (!$serie) {
            return response()->json([
                'error' => 'Serie not found'
            ], 404);
        }

        if ($serie->delete()) {
            return response()->json([
                'message' => 'Serie deleted successfully'
            ]);
        } else {
            return response()->json([
                'error' => 'Error while deleting serie'
            ], 500);
        }
    }
}
