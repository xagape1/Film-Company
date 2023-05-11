<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Episode;
use App\Models\File;
use App\Models\Serie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $episodes = Episode::all();
        return response()->json($episodes);
    }
    public function create()
    {
        return view("episodes.create");
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'season' => 'required',
            'duration' => 'required',
            'upload' => 'required|file|max:2048',
            'id_serie' => 'required|exists:serie,id'
        ]);

        $title = $request->get('title');
        $description = $request->get('description');
        $season = $request->get('season');
        $duration = $request->get('duration');
        $upload = $request->file('upload');
        $id_serie = $request->get('id_serie');

        // Desar fitxer al disc i inserir dades a BD
        $file = new File();
        $fileOk = $file->diskSave($upload);

        if ($fileOk) {
            // Desar dades a BD
            Log::debug("Saving episode at DB...");
            $episode = Episode::create([
                'title' => $title,
                'description' => $description,
                'season' => $season,
                'duration' => $duration,
                'files_id' => $file->id,
                'id_serie' => $id_serie,
            ]);
            Log::debug("DB storage OK");
            // Patró PRG amb missatge d'èxit
            return redirect()->route('episodes.show', $episode)
                ->with('success', __('Episode successfully saved'));
        } else {
            // Patró PRG amb missatge d'error
            return redirect()->route("episodes.create")
                ->with('error', __('ERROR Uploading file'));
        }
    }
    public function show($id)
    {
        $episode = Episode::find($id);

        if ($episode) {
            return response()->json($episode);
        } else {
            return response()->json([
                'error' => 'Episode not found'
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
    public function update(Request $request, Episode $episode)
    {

        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'season' => 'required',
            'duration' => 'required',
            'upload' => 'required|file|max:2048',
            'id_serie' => 'required|exists:serie,id'
        ]);

        $title = $request->get('title');
        $description = $request->get('description');
        $season = $request->get('season');
        $duration = $request->get('duration');
        $upload = $request->file('upload');
        $id_serie = $request->get('id_serie');

        if ($upload->isValid()) {
            // Guardar el archivo en disco y actualizar la BD
            $file = new File;
            $serie = Serie::find($id_serie);
            $file->diskSave($upload);

            // Actualizar dades a BD
            Log::debug("Updating DB...");
            $episode->title = $title;
            $episode->description = $description;
            $episode->season = $season;
            $episode->duration = $duration;
            $episode->files_id = $file->id;
            $episode->id_serie = $serie->id;
            $episode->save();
            Log::debug("DB storage OK");

            // Patró PRG amb missatge d'èxit
            return redirect()->route('episodes.show', $episode)
                ->with('success', __('Post successfully saved'));
        } else {
            // Patró PRG amb missatge d'error
            return redirect()->route("espisodes.edit")
                ->with('error', __('ERROR Uploading file'));
        }
    }

    public function destroy($id)
    {
        $episode = Episode::find($id);

        if (!$episode) {
            return response()->json([
                'error' => 'Episode not found'
            ], 404);
        }

        if ($episode->delete()) {
            return response()->json([
                'message' => 'Episode deleted successfully'
            ]);
        } else {
            return response()->json([
                'error' => 'Error while deleting episode'
            ], 500);
        }
    }
}