<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Profile;
use App\Models\Chat;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $user = Auth::user();
        $chats = $user->chats;

        return view('chat.index', compact('chats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $id_profile
     * @return \Illuminate\Http\Response
     */
    public function create($id_profile)
    {
        $user = Auth::user();
        $profile = Profile::findOrFail($id_profile);

        // Check if a chat between the users already exists
        $chat = DB::table('chat')
            ->where('id_profile1', $user->profile->id)
            ->where('id_profile2', $id_profile)
            ->orWhere(function ($query) use ($user, $id_profile) {
                $query->where('id_profile1', $id_profile)
                    ->where('id_profile2', $user->profile->id);
            })
            ->first();

        if ($chat) {
            return redirect()->route('chats.show', $chat->id);
        }

        // If the chat doesn't exist, create it
        $chat = new Chat();
        $chat->id_profile1 = $user->profile->id;
        $chat->id_profile2 = $id_profile;
        $chat->save();

        return redirect()->route('chats.show', $chat->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory
     */
    public function show($id)
    {
        $chat = Chat::findOrFail($id);
        $user = Auth::user();
        $profile = $user->profile;
        $other_profile = ($profile->id === $chat->id_profile1) ? $chat->profile2 : $chat->profile1;

        return view('chat.show', compact('chat', 'profile', 'other_profile'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chat = Chat::findOrFail($id);
        $chat->delete();

        return redirect()->route('chats.index');
    }
}
