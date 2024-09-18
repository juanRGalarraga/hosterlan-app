<?php

namespace App\Http\Controllers\Reservation;

use Illuminate\Support\Facades\Auth;
use App\Enums\Reservation\ReservationStateEnum;
use Illuminate\Support\Facades\Log;
use App\Models\Guest;
use App\Models\ReservationGuest;
use App\Models\PublicationDayAvailable;
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

        if( !( $reservation = ReservationGuest::create($request->all()) ) ) {
            Log::emergency('Error during procesing update');
            return abort(500);
        }

        return redirect()->action([$this::class, 'create'], ['reservation' => $reservation]);
        return view('reservations.create.main', ['reservation' => $reservation]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = ReservationGuest::latest()->paginate(25);
        $html = view("reservations.index.main", compact('reservations'));
        return $html;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ReservationGuest $reservation)
    {
        if($reservation->guest_id != Auth::user()->guest->id){
            //I c
            return redirect()->back();
        }
        return view( 'reservations.create.main', [ 'reservation' => $reservation ] );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reservation_id' => 'required|integer',
            'name' => 'required|string|max:80|alpha',
            'email' => 'required|email',
            'phoneNumber' => 'required',
            'since' => 'date',
            'to' => 'after_or_equal:since',
            'message' => 'string|max:200'
        ]);

        if($validator->fails()){
            return redirect()
            ->route('reservations.create', $request->reservation_id)
            ->withErrors($validator->errors());
        }

        $record = array_merge($request->all(), ['state' => ReservationStateEnum::Reserved->name]);
        
        $reservation = ReservationGuest::create($record);

        if(!$reservation->exist()){
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
    public function show(string $id)
    {
        //
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
