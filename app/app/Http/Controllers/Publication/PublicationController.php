<?php

namespace App\Http\Controllers\Publication;

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
use Illuminate\Support\Facades\Validator;
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
        $publications = Publication::latest()->paginate(25);
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
    public function editFetch(){
        
        $publications = Publication::where('user_id', Auth::user()->id)
        ->latest('created_at')
        ->paginate(25);

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
            ->leftjoin(AvailableDay::tableName() . " as pda", 'pda.publication_id', '=', 'p.id');

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
            $availableSinceFormated = Carbon::createFromFormat('d/m/Y', $availableSince)->format('Y-m-d');
            if ($availableSinceFormated) {
                $queryBuilder->where(DB::raw('DATE(pda.since)'), '>=', $availableSinceFormated);
            }
        }

        $availableTo = $request->input('available_to');
        if ($availableTo != null) {
            $availableToFormated = Carbon::createFromFormat('d/m/Y', $availableTo)->format('Y-m-d');
            if ($availableToFormated && $availableToFormated > $availableSinceFormated) {
                $queryBuilder->where(DB::raw('DATE(pda.to)'), '<=', $availableToFormated);
            }
        }

        $rentType = $request->input('rentType');
        if (is_numeric($rentType)) {
            $queryBuilder->where('p.rent_type_id', '=', $rentType);
        }

        $roomCount = $request->input('roomCount');
        if (is_numeric($roomCount)) {
            $queryBuilder->where('p.room_count', '=', $roomCount);
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
            'room_count' => 'integer',
            'bathroom_count' => 'integer',
            'number_people' => 'required|integer',
            'ubication' => 'string|max:250',
            'description' => 'string|nullable',
            'pets' => 'in:1,0',
            'files.*' => 'max:2048|file',
        ];

        $files = count($request->file('files')) - 1;
        foreach (range(0, $files) as $index) {
            $rules["files.$index"] = 'required|mimes:png,jpeg,jpg,gif|max:2048';
        }

        $validated = Validator::make(
            $request->all(),
            $rules,
            [
                'files.*.min' => 'Upload even one photo',
                'files.*.required' => 'Upload even one photo'
            ]
        );

        if ($validated->fails()) {
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

        if (!$publicationCreated->exists()) {
            Log::emergency('Publication cannot be created');
            DB::rollBack();
            throw new ModelNotFoundException("Error Processing Request");
        }

        foreach ($request->file('files') as $file) {

            if (!$file->store("public/publication-pictures/$publicationCreated->id")) {
                Log::emergency('File cannot be stored');
                DB::rollBack();
                throw new FileCouldNotBeWrittenException("Error Processing Request");
            }

            $picture = Picture::create([
                'name' => $file->hashName(),
                'publication_id' => $publicationCreated->id,
                'type' => $file->extension(),
            ]);

            if (!$picture->exists()) {
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

        if ($validator->fails()) {
            $request->flash();

            return redirect()
                ->route('publications.create2')
                ->withErrors($validator->errors())
                ->withInput();
        }

        $publication = Publication::findOrFail($request->publication_id);
        $days = $request->input('days');

        if (!($publication->exists() && $days)) {
            Log::emergency("Neccessary data to store publication not found");
            return abort(500);
        }

        Db::transaction(function () use ($publication, $days) {

            foreach ($days as $key => $availableDays) {
                AvailableDay::create([
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
     * Recovery the uploaded files from the storage.
     * @param int $publicationId
     * @return mixed|string
     */
    public function getUploadedFiles(Request $request)
    {
        $files = $request->all();
        if ($request->input('publicationId')) {
            $pictures = Picture::where('publication_id', $request->input('publicationId'))->get();
            $files = $pictures->map(function ($picture) {
                // dump(vars: $picture->getUrl());
                return $picture->getUrl();
            });
            $files = $files->all();
        }

        return view('publications.edit.form-preview-files', compact('files'))->render();
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
            'files' => 'required|array|min:1',
        ];
       
        $validated = Validator::make(
            $request->all(),
            $rules,
            [
                'files.*.min' => 'Upload even one photo',
                'files.*.required' => 'Upload even one photo'
            ]
        );

        $files = count($request->file('files')) - 1;
        foreach(range(0, $files) as $index) {
            $rules["files.$index"] = 'required|mimes:png,jpeg,jpg,gif|max:2048';
        }

        $validated = Validator::make($request->all(), $rules, ['files.*.min' => 'Upload even one photo', 'files.*.required' => 'Upload even one photo']);

        if ($validated->fails()) {
            $request->flash();
            return redirect()
                ->route('publications.create1')
                ->withErrors($validated->errors())
                ->withInput();
        }

        DB::beginTransaction();

        $publicationData = $request->except('files');
        $publicationData['state'] = StateEnum::Published->name;
        $publicationData['user_id'] = Auth::user()->id;

        $updated = $publication->update($publicationData);

        if (!$updated) {
            Log::emergency('Publication cannot be updated');
            DB::rollBack();
            throw new ModelNotFoundException("Error Processing Request");
        }

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

        DB::commit();
        return redirect()->route('publications.edit', ['publication' => $publication])
            ->withSuccess(_('Publicacion actualizada exitosamente'));
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
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroyPicture(Picture $picture)
    {
        $publicationId = $picture->publication_id;
        $picture->delete();
        return redirect()->route('publications.edit', ['publication' => $publicationId])
            ->withSuccess(_('Publicacion eliminada exitosamente'));
    }
}
