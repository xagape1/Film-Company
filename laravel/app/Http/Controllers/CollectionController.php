<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index(Request $request)
    {
        $collections = Collection::where('id_profile', $request->id_profile)->get();
        return response()->json(['collections' => $collections]);
    }
    public function create(Request $request)
    {
        return response()->json(['collection' => new Collection(['id_profile' => $request->id_profile])]);
    }
    
    public function store(Request $request)
    {
        $collection = new Collection;
        $collection->name = $request->name;
        $collection->id_profile = $request->id_profile;
        $collection->save();
        return response()->json(['message' => 'Collection created', 'collection' => $collection]);
    }

    public function show($id)
    {
        $collection = Collection::find($id);
        return response()->json(['collection' => $collection]);
    }

    public function update(Request $request, $id)
    {
        $collection = Collection::find($id);
        $collection->name = $request->name;
        $collection->id_profile = $request->id_profile;
        $collection->save();
        return response()->json(['message' => 'Collection updated', 'collection' => $collection]);
    }

    public function destroy($id)
    {
        $collection = Collection::find($id);
        $collection->delete();
        return response()->json(['message' => 'Collection deleted']);
    }
}
