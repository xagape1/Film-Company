<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return response()->json($movies);
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

        return response()->json(['message' => 'Movie created successfully', 'movie' => $movie], 201);
    }

    public function show($id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }
        return response()->json($movie);
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }
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

        return response()->json(['message' => 'Movie updated successfully', 'movie' => $movie]);
    }

    public function destroy($id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }
        
        // Eliminar el archivo de video si existe
        if ($movie->video_path) {
            Storage::delete($movie->video_path);
        }
        
        $movie->delete();

        return response()->json(['message' => 'Movie deleted successfully']);
    }
}
