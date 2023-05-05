<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::all();

        return view('collections.index', compact('collections'));
    }

    public function create()
    {
        return view('collections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'movies' => 'array',
            'episodes' => 'array',
        ]);

        $collection = new Collection();
        $collection->name = $request->input('name');
        $collection->save();

        if ($request->has('movies')) {
            $collection->movies()->attach($request->input('movies'));
        }

        if ($request->has('episodes')) {
            $collection->episodes()->attach($request->input('episodes'));
        }

        return redirect()->route('collections.index')->with('success', 'Collection created successfully.');
    }

    public function show(Collection $collection)
    {
        return view('collections.show', compact('collection'));
    }

    public function edit(Collection $collection)
    {
        return view('collections.edit', compact('collection'));
    }

    public function update(Request $request, Collection $collection)
    {
        $request->validate([
            'name' => 'required|max:255',
            'movies' => 'array',
            'episodes' => 'array',
        ]);

        $collection->name = $request->input('name');
        $collection->save();

        $collection->movies()->detach();
        if ($request->has('movies')) {
            $collection->movies()->attach($request->input('movies'));
        }

        $collection->episodes()->detach();
        if ($request->has('episodes')) {
            $collection->episodes()->attach($request->input('episodes'));
        }

        return redirect()->route('collections.index')->with('success', 'Collection updated successfully.');
    }

    public function destroy(Collection $collection)
    {
        $collection->movies()->detach();
        $collection->episodes()->detach();
        $collection->delete();

        return redirect()->route('collections.index')->with('success', 'Collection deleted successfully.');
    }
}
