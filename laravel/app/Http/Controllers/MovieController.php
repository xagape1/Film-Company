<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $movie = new Movie;
        $movie->title = $request->title;
        $movie->description = $request->description;
        $movie->gender = $request->gender;
        $movie->duration = $request->duration;
        
        // Añadir la ruta del archivo de video
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $path = $video->store('public/videos');
            $movie->video_path = $path;
        }
        
        $movie->save();

        return redirect()->route('movies.index');
    }

    public function show($id)
    {
        $movie = Movie::find($id);
        return view('movies.show', compact('movie'));
    }

    public function edit($id)
    {
        $movie = Movie::find($id);
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::find($id);
        $movie->title = $request->title;
        $movie->description = $request->description;
        $movie->gender = $request->gender;
        $movie->duration = $request->duration;
        
        // Actualizar la ruta del archivo de video si se proporciona uno nuevo
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $path = $video->store('public/videos');
            $movie->video_path = $path;
        }
        
        $movie->save();

        return redirect()->route('movies.index');
    }

    public function destroy($id)
    {
        $movie = Movie::find($id);
        
        // Eliminar el archivo de video si existe
        if ($movie->video_path) {
            Storage::delete($movie->video_path);
        }
        
        $movie->delete();

        return redirect()->route('movies.index');
    }
}
