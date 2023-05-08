<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $profile = Profile::all();

        return response()->json($profile);
    }
    public function create(Request $request)
    {
        $user = auth()->user(); // Obtenemos el usuario autenticado
    
        $profile = new Profile;
        $profile->name = $request->input('name');
        $profile->id_users = $user->id; // Asignamos el ID del usuario al perfil
        $profile->save();
    
        return response()->json(['message' => 'Profile created successfully.', 'profile' => $profile]);
    }
    

    public function store(Request $request)
    {
        $user = auth()->user(); // Obtener el usuario autenticado
    
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
    
        $profile = new Profile;
        $profile->name = $validatedData['name'];
        $profile->id_users = $user->id; // Asignar el ID del usuario al perfil
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