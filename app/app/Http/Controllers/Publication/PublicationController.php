<?php

namespace App\Http\Controllers\Publication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Publication\PublicationStoreRequest;
use App\Http\Requests\Publication\PublicationUpdateRequest;
use App\Models\Publication;
use App\Models\Publication\Picture;
use App\Models\PublicationsAvailablesDays;
use Exception;
use Illuminate\Http\Request;
use App\Enums\Publication\PublicationState;
use Carbon\Carbon;
// use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeCoverage\Driver\WriteOperationFailedException;
// use Illuminate\Support\Facades\Storage;

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
        // $available_from = $request->input('available_from');
        // $availableFromFormated = Carbon::createFromFormat('d-m-Y', $available_from)->format('Y-m-d');
    

        // $queryBuilder->leftjoin('publications_availables_days', 'publications.id', '=', 'publications_availables_days.publication_id');
        
        
        // if(!is_null($availableFromFormated)){
        //     $request->validate([
        //         'available_from' => 'required|date',
        //     ]);  

        //     $queryBuilder
        //        ->where('publications_availables_days.since', '>=', $availableFromFormated);
                
        // }
        // $availableTo=$request->input('available_to');
        // $fechaTo= new carbon($availableTo);
        // $availableTo = Carbon::createFromFormat('d-m-Y', $availableTo)->format('Y-m-d');
        // if(!is_null($availableTo)){
        //     $request->validate([
        //         'available_to' => 'required|date|after_or_equal:available_from',
        //     ]);  

        //     $queryBuilder
        //         ->where('publications_availables_days.to', '<=', $availableTo);
        // }

        
        

        
            
        
            
            
        
        
    


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

    public function getCarousel(Request $request){
        $images = $request->file('file');
        $response[] = [
            ['src' => asset('publications-pictures/carousel-preview.svg')],
            ['src' => ''],
        ];
        return response()->json($response);
    }

    public function getPreviewFiles(Request $request){
        $filenames = $request->input('filename', []);
        $src = $request->input('src', []);

        if(!empty($filenames)){
            $filenames = explode(",", $filenames);
        }

        if(!empty($src)){
            $src = explode(",", $src);
        }
        
        return view('publications.create-form-preview-files', compact('filenames', 'src'))->render();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PublicationUpdateRequest $request)
    {   
        $request->check($request->all());
        
        // dd($request->file('files'));
        if(!$request->file('files')){
            $request->flash();
            return redirect()
            ->withErrors($request->errors())
            ->withInput();
        }

        if($request->fails()){
            $request->flash();

            return redirect()
            ->withErrors($request->errors())
            ->withInput();
        }

        $publication = Publication::create($request->all());

        try {

            if(!$publication->exists()){
                throw new Exception("Error Create record");
            }

            foreach ($request->file('files') as $key => $file) {
            
                $isStored = $file->store(
                    "publications-pictures/{$publication->id}"
                );
                
                if(!$isStored){
                    throw new WriteOperationFailedException("Error write file");
                }

                $publication->pictures()->save(
                    new Picture([
                        'name' => $file->hashName(),
                        'publication_id' => $publication->id,
                        'type' => $file->getType(),
                    ])
                );
            }

        } catch (WriteOperationFailedException $th) {
            debugbar()->addException($th);
            return abort(424);
        } catch (Exception $ex) {
            debugbar()->addException($ex);
            return abort(500);
        }
        
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
