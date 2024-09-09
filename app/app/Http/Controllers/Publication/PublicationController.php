<?php

namespace App\Http\Controllers\Publication;

use App\Enums\Publication\AvailableDayEnum;
use App\Models\Guest;
use App\Models\ReservationGuest;
use Intervention\Image\ImageManager;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Publication\PublicationUpdateRequest;
use App\Models\Publication;
use App\Models\Picture;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Enums\Publication\StateEnum;
use Carbon\Carbon;
use App\Models\PublicationDayAvailable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use App\Models\RentType;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeCoverage\FileCouldNotBeWrittenException;
use Symfony\Component\HttpFoundation\File\Exception\CannotWriteFileException;


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
        
        $searchValue = $request->string('search');
        if($searchValue->isNotEmpty()){

            $request->validate(['search' => 'string|min:1']);

            $queryBuilder
            ->where(function(Builder $query) use ($searchValue) {
                $query
                    ->where('p.title', 'like', "%$searchValue%")
                    ->orWhere('p.description', 'like', "%$searchValue%")
                    ->orWhere('p.ubication', 'like', "%$searchValue%");
            });
            
        }

        $stateValue = $request->enum('state', StateEnum::class);
        if(isset($stateValue)){
            $queryBuilder
                ->where('pda.state', $stateValue);
        }

        $availableSince = $request->input('available_since');
        if($availableSince != null) {
            $availableSinceFormated = Carbon::createFromFormat('d/m/Y', $availableSince)->format('Y-m-d');
            if($availableSinceFormated){
                $queryBuilder->where(DB::raw('DATE(pda.since)'), '>=', $availableSinceFormated);
            }
        }

        $availableTo = $request->input('available_to');
        if($availableTo != null) {
            $availableToFormated = Carbon::createFromFormat('d/m/Y', $availableTo)->format('Y-m-d');
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

        $bathroomCount= $request->input('bathroomCount');
        if (is_numeric($bathroomCount)) {
            $queryBuilder->where('p.bathroom_count', '=', $bathroomCount);
            }

        $withPets=$request->input('withPets');
        if(is_numeric($withPets)){
            $queryBuilder->where('p.pets', '=', $withPets);
        }

        $priceMin = $request->input('price_min');
        if (is_numeric($priceMin)) {
            $queryBuilder->where('p.price', '>=', $priceMin);
        }
        
        $priceMax = $request->input('price_max');
        if (is_numeric($priceMax)) {
            $queryBuilder->where('p.price', '<=', $priceMax);
        }    

        $publications = $queryBuilder->limit(25)->orderBy('p.created_at', 'desc')->groupBy('p.id')->get();
        $query = $queryBuilder->getQuery()->toRawSql();

        $html = view("publications.index.card-list", compact('publications', 'query'))->render();
        return $html;
    }


    /**
     * Get the step-1-form to create a publication.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getStep1(){
        return view('publications.create.form-step-1-main');
    }

    /**
     * Get the step-1-form to create a publication.
     * @param \Illuminate\Http\Request $request
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \SebastianBergmann\CodeCoverage\FileCouldNotBeWrittenException
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function getStep2(Request $request){

        $rules = [
            'title' => 'required|string|max:150',
            'price' => 'required|numeric',
            'rent_type_id' => 'required|integer',
            'room_count' => 'integer',
            'bathroom_count' => 'integer',
            'number_people' => 'required|integer',
            'ubication' => 'string|max:250',
            'description' => 'string|nullable',
            'pets' => 'in:1,0',
            'files.*' => 'max:2048|file',
        ];

        $files = count($request->file('files')) - 1;
        foreach(range(0, $files) as $index) {
            $rules["files.$index"] = 'required|mimes:png,jpeg,jpg,gif|max:2048';
        }

        $validated = Validator::make($request->all(), $rules, ['files.*.min' => 'Upload even one photo', 'files.*.required' => 'Upload even one photo']);
        
        if( $validated->fails() ){
            $request->flash();
            return redirect()
            ->route('publications.create1')
            ->withErrors($validated->errors())
            ->withInput();
        }

        $publication = new Publication();
        $publicationCreated = new Publication();

        DB::beginTransaction();

        $publicationData = $request->except('files');
        $publicationData['state'] = StateEnum::Draft->name;
        $publicationData['user_id'] = Auth::user()->id;

        $publicationCreated = $publication->create($publicationData);

        if(!$publicationCreated->exists()){
            Log::emergency('Publication cannot be created');
            DB::rollBack();
            throw new ModelNotFoundException("Error Processing Request");
        }
        
        foreach ($request->file('files') as $file) {
    
            // try {
            //     $imageManager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
            //     $image = $imageManager->read($file);
            //     $image->resizeDown(600);

            //     Storage::disk('publication-pictures')->put($publicationCreated->id, $image->toPng()->toString());
            //     // Storage::disk('publication-pictures')->makeDirectory("{$publicationCreated->id}");
            //     // $image->save(storage_path("app/public/publication-pictures/{$publicationCreated->id}/"));
            //     // $image->save(storage_path("public/publication-pictures/{$publicationCreated->id}/"));
            // } catch (RuntimeException $re) {
            //     DB::rollBack();
            //     debugbar()->emergency($re->getMessage());
            //     Log::emergency($re->getMessage());
            //     abort(500);
            // }

            if(!$file->store("public/publication-pictures/$publicationCreated->id")){
                Log::emergency('File cannot be stored');
                DB::rollBack();
                throw new FileCouldNotBeWrittenException("Error Processing Request");
            }

            $picture = Picture::create([
               'name' => $file->hashName(),
               'publication_id' => $publicationCreated->id,
               'type' => $file->extension(),
            ]);
            
            if(!$picture->exists()){
                Storage::disk('publication-pictures')->deleteDirectory($publicationCreated->id);
                Log::emergency('Piciture cannot be created');
                DB::rollBack();
                throw new ModelNotFoundException("Error Processing Request");       
            }
        }

        DB::commit();

        return view('publications.create.form-step-2-main', ['publication_id' => $publicationCreated->id]);
    }

    /**
     * Store a newly created resource in storage.
     */ 
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'days' => 'required|array',
            'days.*.since' => 'required|date',
            'days.*.to' => 'required|date',
            'publication_id' => 'required|integer',
        ], ['days' => 'Select even one date available']);
        
        if($validator->fails()){
            $request->flash();

            return redirect()
            ->route('publications.create2')
            ->withErrors($validator->errors())
            ->withInput();
        }

        $publication = Publication::findOrFail($request->publication_id);
        $days = $request->input('days');

        if( !($publication->exists() && $days) ){
            Log::emergency("Neccessary data to store publication not found");
            return abort(500);
        }

        Db::transaction(function() use($publication, $days){

            foreach ($days as $key => $availableDays) {
                PublicationDayAvailable::create([
                    'publication_id' => $publication->id,
                    'since' => \DateTime::createFromFormat('d/m/Y', $availableDays['since'])->format('Y-m-d'),
                    'to' => \DateTime::createFromFormat('d/m/Y', $availableDays['to'])->format('Y-m-d'),
                ]);
            }
        });
        
        return redirect()
        ->route('publications.index')
        ->withSuccess(__('La publicacion ha sido creada exitosamente'));
    }

    /**
     * Allow the user to try to book a day.
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function reserveDay(Request $request){
        $validator = Validator::make($request->all(), [
            'publication_id' => 'required|integer',
            'publication_day_available_id' => 'required|integer',
            'guest_id' => 'required|integer'
        ]);

        if($validator->fails()){
            return redirect()
            ->route('publications.show')
            ->withErrors($validator->errors());
        }

        Publication::findOrFail($request->publication_id);
        PublicationDayAvailable::findOrFail($request->publication_day_available_id);
        Guest::findOrFail($request->guest_id);

        if( !ReservationGuest::create($request->all()) ) {
            Log::emergency('Error during procesing update');
            return abort(500);
        }

        return redirect()
        ->route('publications.index')
        ->withSuccess(__('La fecha ha sido solicitada correctamente'));
    }
    
    /**
     * This method is used to fetch the preview files dynamically. 
     * @param \Illuminate\Http\Request $request
     * @return mixed|string
     */
    public function getPreviewFiles(Request $request){
        $files = $request->all();
        if( !Arr::isAssoc($files) && count($files) < 1){
            Log::notice('Any files to render');
            return '';
        }
        
        return view('publications.create.form-preview-files', compact('files'))->render();
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
