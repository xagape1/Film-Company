<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;

class SerieController extends Controller
{
    public function index()
    {
        $series = Serie::all();
        return view('series.index', compact('series'));
    }

    public function create()
    {
        return view('series.create');
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

        return redirect('/series')->with('success', 'Serie creada exitosamente!');
    }

    public function edit($id)
    {
        $serie = Serie::find($id);
        return view('series.edit', compact('serie'));
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
        $serie->title = $request->get('title');
        $serie->description = $request->get('description');
        $serie->gender = $request->get('gender');
        $serie->seasons = $request->get('seasons');
        $serie->episodes = $request->get('episodes');
        $serie->save();

        return redirect('/series')->with('success', 'Serie actualizada exitosamente!');
    }

    public function destroy($id)
    {
        $serie = Serie::find($id);
        $serie->delete();

        return redirect('/series')->with('success', 'Serie eliminada exitosamente!');
    }
}
