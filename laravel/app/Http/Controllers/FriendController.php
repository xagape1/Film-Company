<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;

class FriendController extends Controller
{
    public function index()
    {
        $friends = Friend::all();
        return view('friends.index', compact('friends'));
    }

    public function create()
    {
        return view('friends.create');
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

        return redirect('/friends')->with('success', 'Friend added!');
    }

    public function destroy($id)
    {
        $friend = Friend::find($id);
        $friend->delete();

        return redirect('/friends')->with('success', 'Friend deleted!');
    }
}
