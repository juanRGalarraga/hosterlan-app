<?php

namespace App\Http\Controllers\Publication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Publication\PublicationStoreRequest;
use App\Http\Requests\Publication\PublicationUpdateRequest;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("publications.index", [
            'publications' => Publication::latest()->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("publications.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PublicationStoreRequest $request)
    {
        Publication::create($request->all());

        return redirect()
        ->route('publications.index')
        ->withSuccess(__('La publicacion ha sido creada exitosamente'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Publication $publication)
    {
        return view('publications.show', [
            'publication' => $publication
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publication $publication)
    {
        return view('publications.edit', [
            'publication' => $publication
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PublicationUpdateRequest $request, Publication $publication)
    {
        $publication->update($request->all());
        return redirect()->back()
                ->withSuccess(__('Publicacion editada exitosamente'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publication $publication)
    {
        $publication->delete();
        return redirect()->route('publications.index')
                ->withSuccess(_('Publicacion eliminada exitosamente'));
    }
}
