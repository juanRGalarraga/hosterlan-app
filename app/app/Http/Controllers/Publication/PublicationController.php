<?php

namespace App\Http\Controllers\Publication;

use Illuminate\Http\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Mime\Exception\LogicException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Models\Picture;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Enums\Publication\StateEnum;
use Carbon\Carbon;
use App\Models\AvailableDay;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\RentType;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Psy\Readline\Hoa\FileException;
use SebastianBergmann\CodeCoverage\FileCouldNotBeWrittenException;


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
        $publications = Publication::latest()->where('state', StateEnum::Published->name)->paginate(25);
        $html = view("publications.index.main", compact('publications'));
        return $html;
    }

    /**
     * Display a listing of the publciation to edit.
     */
    public function editIndex()
    {
        $html = view("publications.edit.main");
        return $html;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publication $publication)
    {
        return view('publications.edit.form-main', [
            'publication' => $publication
        ]);
    }

    //Fetch the data for the edit list
    public function editFetch(Request $request)
    {
        $queryBuilder = Publication::query();
        $search = $request->string('search');
        if(!$search->isEmpty()){
            $queryBuilder->where('title', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhere('ubication', 'like', "%$search%");
        }

        $priceMin = $request->input('price_min');
        if (is_numeric($priceMin)) {
            $queryBuilder->where('price', '>=', $priceMin);
        }

        $priceMax = $request->input('price_max');
        if (is_numeric($priceMax)) {
            $queryBuilder->where('price', '<=', $priceMax);
        }

        $createdAtMin = $request->input('created_at_min');
        if ($createdAtMin != null) {
            $createdAtMinFormated = Carbon::createFromFormat('d/m/Y', $createdAtMin)->format('Y-m-d');
            if ($createdAtMinFormated) {
                $queryBuilder->where(DB::raw('DATE(created_at)'), '>=', $createdAtMinFormated);
            }
        }

        $createdAtMax = $request->input('created_at_max');
        if ($createdAtMax != null) {
            $createdAtMaxFormated = Carbon::createFromFormat('d/m/Y', $createdAtMax)->format('Y-m-d');
            if ($createdAtMaxFormated && $createdAtMaxFormated > $createdAtMinFormated) {
                $queryBuilder->where(DB::raw('DATE(created_at)'), '<=', $createdAtMaxFormated);
            }
        }


        $publications = $queryBuilder->where('user_id', Auth::user()->id)
            ->latest('created_at')
            ->paginate(25, '*', 'page', $request->integer('page', 1));
        
        return view('publications.edit.main-list', compact('publications'))->render();
    }

    public function getList(Request $request)
    {

        $publication = new Publication();
        $queryBuilder = $publication
            ->newQuery()
            ->select('p.*')
            ->from(Publication::tableName() . ' as p')
            ->join(RentType::tableName() . ' as rt', 'rent_type_id', '=', 'rt.id')
            ->leftjoin(AvailableDay::tableName() . " as pda", 'pda.publication_id', '=', 'p.id')
            ->where('p.state',  StateEnum::Published->name);

        $searchValue = $request->string('search');
        if ($searchValue->isNotEmpty()) {

            $request->validate(['search' => 'string|min:1']);

            $queryBuilder
                ->where(function (Builder $query) use ($searchValue) {
                    $query
                        ->where('p.title', 'like', "%$searchValue%")
                        ->orWhere('p.description', 'like', "%$searchValue%")
                        ->orWhere('p.ubication', 'like', "%$searchValue%");
                });
        }

        $availableSince = $request->input('available_since');
        if ($availableSince != null) {
            $availableSinceFormated = Carbon::createFromFormat('Y-m-d', $availableSince)->format('Y-m-d');
            if ($availableSinceFormated) {
                $queryBuilder->where(DB::raw('DATE(pda.since)'), '>=', $availableSinceFormated);
            }
        }

        $availableTo = $request->input('available_to');
        if ($availableTo != null) {
            $availableToFormated = Carbon::createFromFormat('Y-m-d', $availableTo)->format('Y-m-d');
            if ($availableToFormated && $availableToFormated > $availableSinceFormated) {
                $queryBuilder->where(DB::raw('DATE(pda.to)'), '<=', $availableToFormated);
            }
        }

        $rentType = $request->input('rentType');
        if (is_numeric($rentType)) {
            $queryBuilder->where('p.rent_type_id', '=', $rentType);
        }

        $ubication = $request->string('ubication');
        if (!$ubication->isEmpty()) {
            $queryBuilder->where('p.ubication', 'LIKE', "%$ubication%");
        }

        $bathroomCount = $request->input('bathroomCount');
        if (is_numeric($bathroomCount)) {
            $queryBuilder->where('p.bathroom_count', '=', $bathroomCount);
        }

        $withPets = $request->input('withPets');
        if (is_numeric($withPets)) {
            $queryBuilder->where('p.pets', '=', $withPets);
        }

        $priceMin = $request->input('price_min');
        if (is_numeric($priceMin)) {
            $queryBuilder->where('price', '>=', $priceMin);
        }

        $priceMax = $request->input('price_max');
        if (is_numeric($priceMax)) {
            $queryBuilder->where('price', '<=', $priceMax);
        }

        $publications = $queryBuilder->limit(25)->groupBy('p.id')->get();
        

        if($publications->count() == 0){
            $publications = Publication::latest()->where('state', StateEnum::Published->name)->limit(25)->orderBy('created_at', 'DESC')->get();
            $emptyBut = "El criterio de búsqueda no obtuvo resultados, pero puedes ver las siguientes publicaciones";
            $html = view("publications.index.card-list", compact('publications', 'emptyBut'))->render();
            return $html;
        }
        $html = view("publications.index.card-list", compact('publications'))->render();
        return $html;
    }

    /**
     * Get the step-1-form to create a publication.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getStep1()
    {
        return view('publications.create.form-step-1-main');
    }

    /**
     * Get the step-1-form to create a publication.
     * @param \Illuminate\Http\Request $request
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \SebastianBergmann\CodeCoverage\FileCouldNotBeWrittenException
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function getStep2(Request $request)
    {
        
        $rules = [
            'title' => 'required|string|max:150',
            'price' => 'required|numeric',
            'rent_type_id' => 'required|integer',
            'bathroom_count' => 'integer',
            'number_people' => 'required|integer',
            'ubication' => 'string|max:250',
            'description' => 'string|nullable',
            'pets' => 'in:1,0',
            'files.*' => 'max:2048|file',
            'files' => 'required|array|min:1',
        ];

        $files = count($request->file('files', [])) - 1;
        foreach (range(0, $files) as $index) {
            $rules["files.$index"] = 'required|mimes:png,jpeg,jpg,gif|max:2048';
        }

        $validated = Validator::make(
            $request->all(),
            $rules,
            [
                'files' => 'Selecciona al menos una foto',
                'files.*.min' => 'Selecciona al menos una foto',
                'files.*.required' => 'Selecciona al menos una foto'
            ]
        );

        if ($validated->fails()) {
            $request->flash();
            return redirect()
                ->back()
                ->withErrors($validated->errors())
                ->withInput();
        }
        
        $publicationData = $request->except('files');
        $publicationData['state'] = StateEnum::Published->name;
        $publicationData['user_id'] = Auth::user()->id;

        $directoryName = 'publication_' . Str::random(Auth::user()->id);
        $publicationData['directory'] = $directoryName;

        foreach ($request->file('files') as $file) {
            Storage::disk('temp')->put("$directoryName/" . $file->hashName(), $file->getContent());
        }
        
        Session::put("publication-" . Auth::user()->id, $publicationData);

        return view('publications.create.form-step-2-main');
    }

    public function getAddDaysForm(){
        return view('publications.create.form-step-2-main');
    }

    /**
     * Add more day to publiication
     * @param \Illuminate\Http\Request $request
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \SebastianBergmann\CodeCoverage\FileCouldNotBeWrittenException
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function addDays(Request $request, Publication $publication)
    {
        $validator = Validator::make($request->all(), [
            'days' => 'required|array',
            'days.*.since' => 'required|date',
            'days.*.to' => 'required|date',
        ], ['days' => 'Selecciona al menos un día']);

        if ($validator->fails()) {
            $request->flash();
            return  redirect()->back()->with('error', __('Publication no se pudo crear'));
        }

        DB::transaction(function () use ($request, $publication) {

            $days = $request->input('days');
            
            foreach ($days as $availableDays) {
                $since = new Carbon($availableDays['since']);
                $since->createFromFormat('d/m/Y', $availableDays['since']);
                $to = new Carbon($availableDays['to']);
                $to->createFromFormat('d/m/Y', $availableDays['to']);

                AvailableDay::create([
                    'publication_id' => $publication->id,
                    'since' => $since->format('Y-m-d'),
                    'to' => $to->format('Y-m-d'),
                ] );
            }
        });

        return  redirect()->route('publications.index')->with('success', __('Publication guardada correctamente'));
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
        ], ['days' => 'Selecciona al menos un día']);

        if ($validator->fails()) {
            $request->flash();
            return  redirect()->back()->with('error', __('Publication no se pudo crear'));
        }
        
        $publicationData = $request->session()->get(key: 'publication-' . Auth::user()->id);

        DB::transaction(function () use ($request, $publicationData) {

            $days = $request->input('days');
  
            $publication = Publication::create($publicationData);
            
            foreach ($days as $availableDays) {
                $since = new Carbon($availableDays['since']);
                $since->createFromFormat('d/m/Y', $availableDays['since']);
                $to = new Carbon($availableDays['to']);
                $to->createFromFormat('d/m/Y', $availableDays['to']);

                // dump($availableDays['since']);
                // dump($availableDays['to']);
                // dump($since->format('Y-m-d'));
                // dump($to->format('Y-m-d'));

                AvailableDay::create([
                    'publication_id' => $publication->id,
                    'since' => $since->format('Y-m-d'),
                    'to' => $to->format('Y-m-d'),
                ] );
            }

            $files = Storage::disk('temp')->files($publicationData['directory']);
           
            foreach ($files as $file) {

                $basename = basename($file);

                $stored = Storage::putFileAs(
                    "public/publication-pictures/" . $publication->id, 
                    new File(storage_path("app/temp/$file")),
                    $basename);


                if (!$stored) {
                    Log::debug('File cannot be stored');
                    DB::rollBack();
                    throw new FileCouldNotBeWrittenException("Error Processing Request");
                }

                $picture = Picture::create([
                    'name' => $basename,
                    'publication_id' => $publication->id,
                    'type' => pathinfo($file, PATHINFO_EXTENSION),
                ]);

                if (!$picture->exists()) {
                    Storage::disk('publication-pictures')->deleteDirectory($publication->id);
                    Log::emergency('Piciture cannot be created');
                    DB::rollBack();
                    throw new ModelNotFoundException("Error Processing Request");
                }
            }
        });

        Session::forget('publication-' . Auth::user()->id);
        Storage::disk('temp')->deleteDirectory($publicationData['directory']);

        return  redirect()->route('publications.index')->with('success', __('Publication creada correctamente'));
    }

    /**
     * This method is used to fetch the preview files dynamically. 
     * @param \Illuminate\Http\Request $request
     * @return mixed|string
     */
    public function getPictures(Request $request)
    {
        $publication = Publication::findOrFail($request->input('publicationId'));
        $files = [];
        $files[] = $publication->pictures->each(function ($picture) {
            return asset("publication-pictures/{$picture->publication_id}/{$picture->name}");
        });
        return response()->json($files);
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publication $publication)
    {
        Log::channel('debugger')->debug(print_r($request->file('files'), true));

        $rules = [
            'title' => 'required|string|max:150',
            'price' => 'required|numeric',
            'rent_type_id' => 'required|integer',
            'bathroom_count' => 'integer',
            'number_people' => 'required|integer',
            'ubication' => 'string|max:250',
            'description' => 'string|nullable',
            'pets' => 'in:1,0'
        ];
       
        
        $files = count($request->file('files', [])) - 1;
        Log::channel('debugger')->debug(print_r($request->file('files'), true));
        $validated = Validator::make(
            $request->all(),
            $rules,
            [
                'files.*.min' => 'Upload even one photo',
                'files.*.required' => 'Upload even one photo'
            ]
        );
        Log::channel('debugger')->debug(print_r($request->file('files'), true));
        if($files >= 1){
            foreach(range(0, $files) as $index) {
                $rules["files.$index"] = 'required|mimes:png,jpeg,jpg,gif|max:2048';
            }
            $validated = Validator::make($request->all(), $rules, ['files.*.min' => 'Upload even one photo', 'files.*.required' => 'Upload even one photo']);
        }
        

        if ($validated->fails()) {
            $request->flash();
            return redirect()
                ->back()
                ->withErrors($validated->errors())
                ->withInput();
        }

        DB::beginTransaction();

        $publicationData = $request->except('files');
        $state = $request->input('state');
        
        $publicationData['state'] =  StateEnum::Published->name;
        if(StateEnum::fromName($state)){
            $publicationData['state'] = $state;
        }
        
        $publicationData['user_id'] = Auth::user()->id;

        $updated = $publication->update($publicationData);

        if (!$updated) {
            Log::emergency('Publication cannot be updated');
            DB::rollBack();
            throw new ModelNotFoundException("Error Processing Request");
        }

        if($files >= 1){
            foreach ($request->file('files') as $id => $file) {
    
                if (!$file->store("public/publication-pictures/$publication->id")) {
                    Log::emergency('File cannot be stored');
                    DB::rollBack();
                    throw new FileCouldNotBeWrittenException("Error Processing Request");
                }
    
                $picture = Picture::create([
                    'name' => $file->hashName(),
                    'publication_id' => $publication->id,
                    'type' => $file->extension(),
                ]);
    
                if (!$picture->exists()) {
                    Storage::disk('publication-pictures')->deleteDirectory($publication->id);
                    Log::emergency('Piciture cannot be created');
                    DB::rollBack();
                    throw new ModelNotFoundException("Error Processing Request");
                }
            }
        }

        DB::commit();
        return redirect()
        ->back()
        ->with('success', __('Publication actualizada correctamente'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publication $publication)
    {
        try {

            $publication->delete();

            $deleted = Storage::disk('publication-pictures')->deleteDirectory($publication->id);
    
            if(!$deleted){
                abort(500);
                throw new FileException('Publication pictures cannot be deleted');
            }
            
            return response()->json(Config::get('responses.success.delete'));

        } catch (FileException $th) {
            Log::error($th->getMessage());
        } catch (LogicException $le){
            Log::error($le->getMessage());
        }

        return response()->json(Config::get('responses.error.delete'));

    }
}
