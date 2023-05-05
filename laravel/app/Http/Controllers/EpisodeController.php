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
        return view('episodes.index', compact('episodes'));
    }

    public function create()
    {
        return view('episodes.create');
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

        return redirect()->route('episodes.index')->with('success', 'Episode created successfully.');
    }

    public function show($id)
    {
        $episode = Episode::find($id);
        return view('episodes.show', compact('episode'));
    }

    public function edit($id)
    {
        $episode = Episode::find($id);
        return view('episodes.edit', compact('episode'));
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

        return redirect()->route('episodes.index')->with('success', 'Episode updated successfully.');
    }

    public function destroy($id)
    {
        $episode = Episode::find($id);
        if ($episode->video_path) {
            Storage::delete($episode->video_path);
        }
        $episode->delete();

        return redirect()->route('episodes.index')->with('success', 'Episode deleted successfully.');
    }
}
