<?php

namespace App\Http\Controllers\Publication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Publication\PublicationUpdateRequest;
use App\Models\Publication;
use App\Models\Picture;
use Exception;
use Illuminate\Http\Request;
use App\Enums\Publication\PublicationState;
use Carbon\Carbon;
use SebastianBergmann\CodeCoverage\Driver\WriteOperationFailedException;
use App\Models\PublicationDayAvailable;
use DB;
use Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
        $html = view("publications.index.main", compact('publications'));
        return $html;
    }

    public function getList(Request $request){
        
        $publication = new Publication();
        $queryBuilder = $publication->newQuery();
        $queryBuilder
        ->select('*')
        ->leftjoin(PublicationDayAvailable::tableName(), 'publications.id', '=', PublicationDayAvailable::tableName() . ".publication_id");
        
        $searchValue = $request->input('search');
        if(!empty($searchValue)){

            $request->validate(['search' => 'string|min:1']);

            $queryBuilder
            ->where('title', 'like', "%$searchValue%")
            ->orWhere('description', 'like', "%$searchValue%")
            ->orWhere('ubication', 'like', "%$searchValue%");
        }

        $stateValue = $request->input('state', '');
        if(!is_null(PublicationState::tryFrom($stateValue))){
            $queryBuilder
                ->where('state', $stateValue);
        }

        $availableSince = $request->input('available_since', '');

        if(!empty($availableSince)) {

            $availableSinceCarbon = new Carbon($availableSince);
            $availableSinceFormated = $availableSinceCarbon->format('Y-m-d');
            if($availableSinceFormated){
                $queryBuilder->where(DB::raw('DATE(since)'), '>=', $availableSinceFormated);
            }

        }

        $availableTo = $request->input('available_to', '');

        if(!empty($availableTo)) {

            $availableToCarbon = new Carbon($availableTo);
            $availableToFormated = $availableToCarbon->format('Y-m-d');
            if($availableToFormated && $availableToFormated > $availableSinceFormated){
                $queryBuilder->where(DB::raw('DATE(since)'), '<=', $availableToFormated);   
            }

        }

        $publications = $queryBuilder->limit(25)->orderBy('publications.created_at', 'desc')->get();

        debugbar()->info($queryBuilder->getQuery()->toRawSql());
       
        $html = view("publications.index.card-list", compact('publications'))->render();
        return $html;
    }
   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("publications.create.main");
    }

    // public function getCarousel(Request $request){
    //     $images = $request->file('file');
    //     $response[] = [
    //         ['src' => asset('publications-pictures/carousel-preview.svg')],
    //         ['src' => ''],
    //     ];
    //     return response()->json($response);
    // }

    public function getPreviewFiles(Request $request){
        $files = $request->all();
        if( !Arr::isAssoc($files) && count($files) < 1){
            Log::notice('Any files to render');
            return '';
        }
        
        return view('publications.create.form-preview-files', compact('files'))->render();
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
                
                // $isStored = Storage::putFile("publications-pictures/{$publication->id}", $file);
                $isStored = $file->store(
                    "{$publication->id}",
                    'publications-pictures'
                );
                
                if(!$isStored){
                    throw new WriteOperationFailedException("Error write file");
                }

                $publication->pictures()->save(
                    new Picture([
                        'name' => $file->hashName(),
                        'publication_id' => $publication->id,
                        'type' => $file->getMimeType(),
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
        return view('publications.show.main', [
            'publication' => $publication
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publication $publication)
    {
        return view('publications.edit.main', [
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
        return redirect()->route('publications.index.main')
                ->withSuccess(_('Publicacion eliminada exitosamente'));
    }
}
