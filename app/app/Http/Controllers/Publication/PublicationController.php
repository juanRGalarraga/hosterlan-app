<?php

namespace App\Http\Controllers\Publication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Publication\PublicationStoreRequest;
use App\Http\Requests\Publication\PublicationUpdateRequest;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $publications = Publication::latest()->paginate(25);
        $html = view("publications.index", compact('publications'));
        return $html;
    }

    public function getList(Request $request){
        // $request->validate(['search' => 'string|max:250']);
        
        $publication = new Publication();
        $queryBuilder = $publication->newQuery();
        
        $searchValue = $request->input('search');
        // dump($searchValue);
        if(is_string($searchValue) && !empty($searchValue)){
            $queryBuilder
            ->where('title', 'like', "%$searchValue%")
            ->orWhere('description', 'like', "%$searchValue%")
            ->orWhere('ubication', 'like', "%$searchValue%");
        }

// "select * from `publications` where `title` like '%adsd%' or `description` like '%adsd%' or `ubication` like '%adsd%' order by `created_at` desc limit 25" // app\Http\Controllers\Publication\PublicationController.php:44

        $publications = $queryBuilder->limit(25)->orderBy('created_at', 'desc')->get();

        // dd($queryBuilder->toRawSql());
        // dd($publications);
        $html = view("publications.list", compact('publications'))->render();
        return $html;
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
