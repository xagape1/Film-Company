<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $profiles = auth()->user()->profiles;

        return response()->json(['profiles' => $profiles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $profile = new Profile([
            'name' => $request->get('name'),
        ]);

        $profile->user()->associate(auth()->user());

        $profile->save();

        return response()->json(['message' => 'Profile created successfully.', 'profile' => $profile]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Profile $profile)
    {
        return response()->json(['profile' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Profile $profile)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $profile->name = $request->get('name');

        $profile->save();

        return response()->json(['message' => 'Profile updated successfully.', 'profile' => $profile]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();

        return response()->json(['message' => 'Profile deleted successfully.']);
    }
}
