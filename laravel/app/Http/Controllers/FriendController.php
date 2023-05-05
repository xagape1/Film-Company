<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;

class FriendApiController extends Controller
{
    public function index()
    {
        $friends = Friend::all();
        return response()->json($friends);
    }

    public function show($id)
    {
        $friend = Friend::find($id);
        if (!$friend) {
            return response()->json(['message' => 'Friend not found'], 404);
        }
        return response()->json($friend);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_profile1' => 'required|exists:profile,id',
            'id_profile2' => 'required|exists:profile,id',
            'friendship_date' => 'nullable|date'
        ]);

        $friend = new Friend([
            'id_profile1' => $request->get('id_profile1'),
            'id_profile2' => $request->get('id_profile2'),
            'friendship_date' => $request->get('friendship_date')
        ]);

        $friend->save();

        return response()->json($friend, 201);
    }

    public function update(Request $request, $id)
    {
        $friend = Friend::find($id);
        if (!$friend) {
            return response()->json(['message' => 'Friend not found'], 404);
        }

        $request->validate([
            'id_profile1' => 'required|exists:profile,id',
            'id_profile2' => 'required|exists:profile,id',
            'friendship_date' => 'nullable|date'
        ]);

        $friend->id_profile1 = $request->get('id_profile1');
        $friend->id_profile2 = $request->get('id_profile2');
        $friend->friendship_date = $request->get('friendship_date');

        $friend->save();

        return response()->json($friend);
    }

    public function destroy($id)
    {
        $friend = Friend::find($id);
        if (!$friend) {
            return response()->json(['message' => 'Friend not found'], 404);
        }
        $friend->delete();

        return response()->json(['message' => 'Friend deleted']);
    }
}
