<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        $movies = $movies->map(function ($movie) {
            $movie['video_path'] = asset(Storage::url($movie['video_path']));
            return $movie;
        });
        return response()->json($movies);
    }    
    
    public function create(Request $request)
{
    // Validar los datos de entrada
    $validator = Validator::make($request->all(), [
        'title' => 'required',
        'description' => 'required',
        'gender' => 'required',
        'duration' => 'required|numeric',
        'video' => 'required|mimes:mp4|max:10240' // requerir un archivo de video mp4 de máximo 10 MB
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    // Crear la nueva película
    $movie = new Movie;
    $movie->title = $request->input('title');
    $movie->description = $request->input('description');
    $movie->gender = $request->input('gender');
    $movie->duration = $request->input('duration');

    // Guardar la nueva película en la base de datos
    $movie->save();

    // Guardar el archivo de video en el almacenamiento
    $video = $request->file('video');
    $path = $video->store('public/videos');
    $movie->video_path = $path;

    // Devolver una respuesta en formato JSON
    return response()->json(['message' => 'Movie created successfully', 'movie' => $movie], 201);
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
