<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $groups = Group::all();
        return response()->json($groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        return response()->json(['message' => 'Create method not supported'], 405);
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
            'id_chat' => 'required|integer',
            'name' => 'required|string',
            'capacity' => 'required|integer',
        ]);

        $group = new Group([
            'id_chat' => $request->get('id_chat'),
            'name' => $request->get('name'),
            'capacity' => $request->get('capacity'),
        ]);

        $group->save();

        return response()->json($group, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $group = Group::findOrFail($id);
        return response()->json($group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        return response()->json(['message' => 'Edit method not supported'], 405);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_chat' => 'required|integer',
            'name' => 'required|string',
            'capacity' => 'required|integer',
        ]);

        $group = Group::findOrFail($id);

        $group->id_chat = $request->get('id_chat');
        $group->name = $request->get('name');
        $group->capacity = $request->get('capacity');

        $group->save();

        return response()->json($group);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();
        return response()->json(['message' => 'Group deleted successfully.']);
    }
}
