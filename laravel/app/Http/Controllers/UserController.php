<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::all();
        return response()->json($users);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'id_role' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6|max:255',
        ]);

        $user = User::create($validatedData);
        return response()->json($user, 201);
    }

    public function show($id): JsonResponse
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validatedData = $request->validate([
            'id_role' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id.'|max:255',
            'password' => 'nullable|string|min:6|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->update($validatedData);
        return response()->json($user);
    }

    public function destroy($id): JsonResponse
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }
}
