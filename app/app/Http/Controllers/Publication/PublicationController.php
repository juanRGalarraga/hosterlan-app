<?php

namespace App\Http\Controllers\Publication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Publication\PublicationUpdateRequest;
use App\Models\Publication;
use App\Models\Picture;
use Illuminate\Http\Request;
use App\Enums\Publication\StateEnum;
use Carbon\Carbon;
use Illuminate\Support\MessageBag;
use App\Models\PublicationDayAvailable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
// class DB extends Illuminate\Support\Facades\Facade
use Illuminate\Support\Facades\Log;
use App\Models\RentType;
use Illuminate\Database\Query\JoinClause;

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
        $queryBuilder = $publication
                        ->newQuery()
                        ->select('p.*')
                        ->from(Publication::tableName() . ' as p')
                        ->join(RentType::tableName() . ' as rt', 'rent_type_id', '=', 'rt.id')
                        ->leftjoin(PublicationDayAvailable::tableName() . " as pda", 'pda.publication_id', '=', 'p.id');
        
        $searchValue = $request->input('search');
        if(!empty($searchValue)){

            $request->validate(['search' => 'string|min:1']);

            $queryBuilder
            ->where('p.title', 'like', "%$searchValue%")
            ->orWhere('p.description', 'like', "%$searchValue%")
            ->orWhere('p.ubication', 'like', "%$searchValue%");
        }

        $stateValue = $request->input('state', '');
        if(!is_null(StateEnum::fromName($stateValue))){
            $queryBuilder
                ->where('pda.state', $stateValue);
        }

        $availableSince = $request->input('available_since', '');

        if(!empty($availableSince)) {
            $availableSinceCarbon = new Carbon($availableSince);
            $availableSinceFormated = $availableSinceCarbon->format('Y-m-d');
            if($availableSinceFormated){
                $queryBuilder->where(DB::raw('DATE(pda.since)'), '>=', $availableSinceFormated);
            }

        }

        $availableTo = $request->input('available_to', '');

        if(!empty($availableTo)) {
            $availableToCarbon = new Carbon($availableTo);
            $availableToFormated = $availableToCarbon->format('Y-m-d');
            if($availableToFormated && $availableToFormated > $availableSinceFormated){
                $queryBuilder->where(DB::raw('DATE(pda.to)'), '<=', $availableToFormated);
            }

        }

        $rentType = $request->input('rentType');
        if(is_numeric($rentType)){
            $queryBuilder->where('p.rent_type_id', '=', $rentType);
        }

        $roomCount = $request->input('roomCount');
        if (is_numeric($roomCount)) {
            $queryBuilder->where('p.room_count', '=', $roomCount);
        }

        $publications = $queryBuilder->limit(25)->orderBy('p.created_at', 'desc')->groupBy('p.id')->get();
        $query = $queryBuilder->getQuery()->toRawSql();
    //    dump($queryBuilder->getQuery()->ddRawSql());
        $html = view("publications.index.card-list", compact('publications', 'query'))->render();
        return $html;
    }
   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("publications.create.main");
    }

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

        if($request->fails() || ($request->file('files') < 1) ){

            $messageBag = new MessageBag();
            $messageBag->merge($request->errors());

            if(($request->file('files') < 1)){
                $messageBag->add('pictures', __('Debe cargar al menos una imagen'));
            }

            $request->flash();

            return redirect(route('publications.create'))
            ->withErrors($messageBag)
            ->withInput();
        }

        
        Db::transaction(function() use($request){

            $publication = Publication::create($request->all());

            PublicationDayAvailable::create([
                'publication_id' => $publication->id,
                'since' => $request->available_since,
                'to ' => $request->available_to,
            ]);

            foreach ($request->file('files') as $key => $file) {
                
                $isStored = $file->store(
                    "{$publication->id}",
                    'publication-pictures'
                );
                
                if(!$isStored){
                    Log::alert("Error al almacenar los archivos de la publicacion");
                    report("Error Processing Request");
                }

                $publication->pictures()->save(
                    new Picture([
                        'name' => $file->hashName(),
                        'publication_id' => $publication->id,
                        'type' => $file->getMimeType(),
                    ])
                );
                
            }
        });
        
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
