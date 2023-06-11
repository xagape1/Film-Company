<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intro;
use Illuminate\Support\Facades\Log;

class IntroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("intros.index", [
            'intros' => Intro::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("intros.create");
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
            'upload' => 'required|mimes:mp4|max:2048'
        ]);

        // Guardar archivo en disco e insertar datos en BD
        $upload = $request->file('upload');
        $intro = new Intro();
        $ok = $intro->diskSave($upload);

        if ($ok) {
            // Redireccionar con mensaje de éxito
            return redirect()->route('intros.show', $intro)
                ->with('success', __('Intro successfully saved'));
        } else {
            // Redireccionar con mensaje de error
            return redirect()->route("intros.create")
                ->with('error', __('ERROR uploading file'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Intro  $intro
     * @return \Illuminate\Http\Response
     */
    public function show(Intro $intro)
    {
        return view("intros.show", [
            'intro' => $intro
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Intro  $intro
     * @return \Illuminate\Http\Response
     */
    public function edit(Intro $intro)
    {
        return view("intros.edit", [
            'intro' => $intro
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Intro  $intro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Intro $intro)
    {
        // Validar archivo
        $validatedData = $request->validate([
            'upload' => 'required|mimes:mp4|max:2048'
        ]);

        // Guardar archivo en disco y actualizar datos en BD
        $upload = $request->file('upload');
        $ok = $intro->diskSave($upload);

        if ($ok) {
            // Redireccionar con mensaje de éxito
            return redirect()->route('intros.show', $intro)
                ->with('success', __('Intro successfully updated'));
        } else {
            // Redireccionar con mensaje de error
            return redirect()->route("intros.edit", $intro)
                ->with('error', __('ERROR uploading file'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Intro  $intro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Intro $intro)
    {
        // Eliminar archivo del disco y BD
        $intro->diskDelete();

        // Redireccionar con mensaje de éxito
        return redirect()->route("intros.index")
            ->with('success', __("Intro successfully deleted"));
    }
}
