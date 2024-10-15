<?php

namespace App\Http\Controllers\Reservation;

use App\Enums\Publication\AvailableDayEnum;
use Illuminate\Support\Facades\Auth;
use App\Enums\Reservation\ReservationStateEnum;
use Illuminate\Support\Facades\Log;
use App\Models\Guest;
use App\Models\Reservation;
use App\Models\AvailableDay;
use App\Models\Publication;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{   

    /**
     * Allow the user to try to book a day.
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function preReserve(Request $request){
        $validator = Validator::make($request->all(), [
            'publication_id' => 'required|integer',
            'available_day_id' => 'required|integer',
            'guest_id' => 'required|integer'
        ]);
        
        if($validator->fails()){
            return redirect()
            ->back()
            ->withErrors($validator->errors());
        }
        
        Publication::findOrFail($request->publication_id);
        
        AvailableDay::findOrFail($request->available_day_id);
        
        Guest::findOrFail($request->guest_id);

        if( !( $reservation = Reservation::create($request->all()) ) ) {
            Log::emergency('Error during procesing update');
            return abort(500);
        }
        return view('reservations.create.main', ['reservation' => $reservation]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Guest $guest)
    {
        $showReserved = $request->input('showReserved', false);

        $queryBuilder = Reservation::query();
        
        $state = $request->input('state');
        $validStates = [
            ReservationStateEnum::PreReserved->name,
            ReservationStateEnum::Reserved->name
        ];


        if ($state && in_array($state, $validStates)) {
            $queryBuilder->where('state', $state);
        }

        $reservations = $queryBuilder->where('guest_id', $guest->id)
            ->orderByRaw("FIELD(state, 'Reserved', 'PreReserved') ASC")
            ->orderBy('created_at', 'asc');

        $reservations = $reservations->paginate(25);

        return view('reservations.index.main', compact('reservations', 'state', 'guest'));
    }

    
    


    /**
     * Show the form for creating a new resource.
     */
    public function create(Reservation $reservation)
    {
        if($reservation->guest_id != Auth::user()->guest->id){
            return redirect()->back();
        }
        return view( 'reservations.create.main', [ 'reservation' => $reservation ] );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::channel('debug')->debug(json_encode($request->all()));
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'reservation_id' => 'required|integer',
            'name' => 'required|string|max:80',
            'phoneNumber' => 'required',
            'since' => 'required|date_format:d/m/Y',
            'to' => 'required|date_format:d/m/Y|after:since',
        ]);
        Log::channel('debug')->debug($validator->errors());
        if($validator->fails()){
            $request->flash();
            return redirect()
            ->route('reservations.create', $request->reservation_id)
            ->withInput()
            ->withErrors($validator->errors());
        }

        $updated = Reservation::where('id', $request->reservation_id)
        ->update(['state' => ReservationStateEnum::Reserved->name]);

        $reservation = Reservation::findOrFail($request->reservation_id);

        $updatedAvailableDay = AvailableDay::where('id', $reservation->availableDay->publication->id)
            ->update(['state' => AvailableDayEnum::Unavailable->name]);

        if(!$updated || !$updatedAvailableDay){
            Log::emergency('Error during procesing update');
            return abort(500);
        }

        return redirect()
        ->route('publications.index')
        ->withSuccess(__('La reserva ha sido realizada correctamente'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        return view('reservations.show.main', ['reservation' => $reservation]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
