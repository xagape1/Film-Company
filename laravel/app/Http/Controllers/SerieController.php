<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;

class SerieController extends Controller
{
    public function index()
    {
        $series = Serie::all();
        return response()->json($series);
    }

    public function create()
    {
        return response()->json(['message' => 'No disponible'], 404);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'gender' => 'required',
            'seasons' => 'required|integer',
            'episodes' => 'required|integer'
        ]);

        $serie = new Serie([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'gender' => $request->get('gender'),
            'seasons' => $request->get('seasons'),
            'episodes' => $request->get('episodes')
        ]);

        $serie->save();

        return response()->json($serie, 201);
    }

    public function show($id)
    {
        $serie = Serie::find($id);

        if (!$serie) {
            return response()->json(['message' => 'Serie no encontrada'], 404);
        }

        return response()->json($serie);
    }

    public function edit($id)
    {
        return response()->json(['message' => 'No disponible'], 404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'gender' => 'required',
            'seasons' => 'required|integer',
            'episodes' => 'required|integer'
        ]);

        $serie = Serie::find($id);

        if (!$serie) {
            return response()->json(['message' => 'Serie no encontrada'], 404);
        }

        $serie->title = $request->get('title');
        $serie->description = $request->get('description');
        $serie->gender = $request->get('gender');
        $serie->seasons = $request->get('seasons');
        $serie->episodes = $request->get('episodes');
        $serie->save();

        return response()->json($serie);
    }

    public function destroy($id)
    {
        $serie = Serie::find($id);

        if (!$serie) {
            return response()->json(['message' => 'Serie no encontrada'], 404);
        }

        $serie->delete();

        return response()->json(['message' => 'Serie eliminada exitosamente']);
    }
}
