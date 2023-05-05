<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionApiController extends Controller
{
    public function index()
    {
        $collections = Collection::all();

        return response()->json([
            'data' => $collections
        ]);
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

        return response()->json([
            'message' => 'Collection created successfully.',
            'data' => $collection
        ], 201);
    }

    public function show(Collection $collection)
    {
        return response()->json([
            'data' => $collection
        ]);
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

        return response()->json([
            'message' => 'Collection updated successfully.',
            'data' => $collection
        ]);
    }

    public function destroy(Collection $collection)
    {
        $collection->movies()->detach();
        $collection->episodes()->detach();
        $collection->delete();

        return response()->json([
            'message' => 'Collection deleted successfully.'
        ]);
    }
}
