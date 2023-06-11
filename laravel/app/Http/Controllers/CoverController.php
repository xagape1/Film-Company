<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cover;
use Illuminate\Support\Facades\Log;

class CoverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("covers.index", [
            'covers' => Cover::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("covers.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar archivo
        $validatedData = $request->validate([
            'upload' => 'required|mimes:jpeg,jpg,png|max:2048'
        ]);

        // Guardar archivo en disco e insertar datos en BD
        $upload = $request->file('upload');
        $cover = new Cover();
        $ok = $cover->diskSave($upload);

        if ($ok) {
            // Redireccionar con mensaje de éxito
            return redirect()->route('covers.show', $cover)
                ->with('success', __('Cover successfully saved'));
        } else {
            // Redireccionar con mensaje de error
            return redirect()->route("covers.create")
                ->with('error', __('ERROR uploading file'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cover  $cover
     * @return \Illuminate\Http\Response
     */
    public function show(Cover $cover)
    {
        return view("covers.show", [
            'cover' => $cover
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cover  $cover
     * @return \Illuminate\Http\Response
     */
    public function edit(Cover $cover)
    {
        return view("covers.edit", [
            'cover' => $cover
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cover  $cover
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cover $cover)
    {
        // Validar archivo
        $validatedData = $request->validate([
            'upload' => 'required|mimes:jpeg,jpg,png|max:2048'
        ]);

        // Guardar archivo en disco y actualizar datos en BD
        $upload = $request->file('upload');
        $ok = $cover->diskSave($upload);

        if ($ok) {
            // Redireccionar con mensaje de éxito
            return redirect()->route('covers.show', $cover)
                ->with('success', __('Cover successfully updated'));
        } else {
            // Redireccionar con mensaje de error
            return redirect()->route("covers.edit", $cover)
                ->with('error', __('ERROR uploading file'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cover  $cover
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cover $cover)
    {
        // Eliminar archivo del disco y BD
        $cover->diskDelete();

        // Redireccionar con mensaje de éxito
        return redirect()->route("covers.index")
            ->with('success', __("Cover successfully deleted"));
    }
}
