<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Episode;
use Illuminate\Support\Facades\Storage;

class EpisodeController extends Controller
{
    public function index()
    {
        $episodes = Episode::all();
        return response()->json(['episodes' => $episodes], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'season' => 'required',
            'duration' => 'required',
            'video' => 'required|mimetypes:video/avi,video/mpeg,video/mp4'
        ]);

        $episode = new Episode();
        $episode->serie_id = $request->serie_id;
        $episode->title = $request->title;
        $episode->description = $request->description;
        $episode->season = $request->season;
        $episode->duration = $request->duration;

        $path = $request->file('video')->store('videos');
        $episode->video_path = $path;

        $episode->save();

        return response()->json(['episode' => $episode], 201);
    }

    public function show($id)
    {
        $episode = Episode::find($id);
        if (!$episode) {
            return response()->json(['message' => 'Episode not found'], 404);
        }
        return response()->json(['episode' => $episode], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'season' => 'required',
            'duration' => 'required',
            'video' => 'nullable|mimetypes:video/avi,video/mpeg,video/mp4'
        ]);

        $episode = Episode::find($id);
        if (!$episode) {
            return response()->json(['message' => 'Episode not found'], 404);
        }

        $episode->serie_id = $request->serie_id;
        $episode->title = $request->title;
        $episode->description = $request->description;
        $episode->season = $request->season;
        $episode->duration = $request->duration;

        if ($request->hasFile('video')) {
            if ($episode->video_path) {
                Storage::delete($episode->video_path);
            }
            $path = $request->file('video')->store('videos');
            $episode->video_path = $path;
        }

        $episode->save();

        return response()->json(['episode' => $episode], 200);
    }

    public function destroy($id)
    {
        $episode = Episode::find($id);
        if (!$episode) {
            return response()->json(['message' => 'Episode not found'], 404);
        }
        if ($episode->video_path) {
            Storage::delete($episode->video_path);
        }
        $episode->delete();

        return response()->json(['message' => 'Episode deleted successfully'], 200);
    }
}
