<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Chat;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user = Auth::user();
        $chats = $user->chats;
    
        if (!$chats) {
            return response()->json(['chats' => []]);
        }
    
        return response()->json(['chats' => $chats]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @param int $id_profile
     * @return \Illuminate\Http\JsonResponse
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
            return response()->json(['chat' => $chat]);
        }

        // If the chat doesn't exist, create it
        $chat = new Chat();
        $chat->id_profile1 = $user->profile->id;
        $chat->id_profile2 = $id_profile;
        $chat->save();

        return response()->json(['chat' => $chat]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $chat = Chat::findOrFail($id);
        $user = Auth::user();
        $profile = $user->profile;
        $other_profile = ($profile->id === $chat->id_profile1) ? $chat->profile2 : $chat->profile1;

        return response()->json(['chat' => $chat, 'profile' => $profile, 'other_profile' => $other_profile]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $chat = Chat::findOrFail($id);
        $chat->delete();

        return response()->json(['message' => 'Chat deleted successfully']);
    }
}
