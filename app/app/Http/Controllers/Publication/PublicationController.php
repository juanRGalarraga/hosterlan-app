<?php

namespace App\Http\Controllers\Publication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Publication\PublicationStoreRequest;
use App\Http\Requests\Publication\PublicationUpdateRequest;
use App\Models\Publication;
use App\Models\PublicationsAvailablesDays;
use Illuminate\Http\Request;
use App\Enums\Publication\PublicationState;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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
        if(is_string($searchValue) && !empty($searchValue)){
            $queryBuilder
            ->where('title', 'like', "%$searchValue%")
            ->orWhere('description', 'like', "%$searchValue%")
            ->orWhere('ubication', 'like', "%$searchValue%");
        }

        $stateValue = $request->input('state');
        if(!is_null(PublicationState::tryFrom($stateValue))){
            $queryBuilder
                ->where('state', $stateValue);
        }
        $availableFrom = $request->input('available_from');
        $carbonFecha= new Carbon($availableFrom);

        $queryBuilder->leftJoin('publications_available_days', 'publication.id', '=', 'publications_available_days.publication_id');
        
        if(!is_null($availableFrom)){
            $request->validated([
                'available_from' => 'required|date',
            ]);  

            $queryBuilder
                ->where('publications_available_days.since', '>=', $availableFrom);
                
        }
        $availableTo=$request->input('available_to');
        $carbonFecha2= new Carbon($availableTo);
        if(!is_null($availableTo)){
            $request->validated([
                'available_to' => 'required|date|after_or_equal:available_from',
            ]);  

            $queryBuilder
                ->where('publications_available_days.to', '<=', $availableTo);
                
        }

        
        

        
            
        
            
            
        
        
            //fijarme si es un fecha valida y transforma a formato datetime
    


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
        $validator = Validator::make($request->all(), $request->rules());

        if($validator->fails()){
            $request->flash();
            return redirect()
            ->withErrors($validator->errors(), 'validates')
            ->withInput();
        }
        
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
