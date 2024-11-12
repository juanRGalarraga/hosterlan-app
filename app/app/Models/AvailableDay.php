<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Enums\Reservation\ReservationStateEnum;
use App\Enums\Publication\AvailableDayEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CanGetTableNameStatically;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AvailableDay extends Model
{
    use HasFactory, CanGetTableNameStatically;
    protected $fillable = [
        'publication_id',
        'since',
        'to',
        'state'
    ];

    public function finalPrice(): float {
        if($this->exists()){
            return $this->publication->price * $this->dayCount();
        }
        return 0.0;
    }

    public function dayCount(): int {
        $count = 0;
        if($this->exists()){
            debugbar()->debug($this->since);
            debugbar()->debug($this->to);
            $date = Carbon::createFromFormat('Y-m-d', $this->since);
            $now = Carbon::createFromFormat('Y-m-d', $this->to);
            debugbar()->debug($date);
            debugbar()->debug($now);
            $diff = $date->diffInDays($now);
            $count = $diff;
        }
        return $count;
    }

    public function getMyReservation(){
        $reservation = null;
        if($this->exists() && Auth::user()?->isGuest()){
            $reservation = $this
                ->reservations
                ->where('guest_id', Auth::user()->guest->id)
                ->first();

            if(!$reservation?->exists()) $reservation = null;
        }
        return $reservation;
    }

    public function isPreReserved(){
        $isPrereserved = false;
        if($this->exists() && Auth::user()?->isGuest()){
            $exist = $this
            ->reservations
            ->where('state', ReservationStateEnum::PreReserved->name)
            ->where('guest_id', Auth::user()->guest->id)
            ->first()?->exists();
            if($exist) $isPrereserved = true;
        }
        return $isPrereserved;
    }

    public function isReserved(){
        $reservationFound = new \stdClass();
        $reservationFound->exists = false;
        if($this->exists()){
            $reservationFound = $this
            ->reservations
            ->where('state', ReservationStateEnum::Reserved->name)
            ->where('guest_id', Auth::id())
            ->first();
        }
        return $reservationFound->exists ?? false;
    }

    public function isAvailable(){
        if(!$this->exists()) return false;
        return $this->state == AvailableDayEnum::Available->name;
    }

    public function reservations() : HasMany {
        return $this->hasMany(Reservation::class);
    }

    public function publication() : BelongsTo
    {
        return $this->belongsTo(Publication::class);
    }
    
    public function guests() : HasMany {
        return $this->hasMany(Guest::class);
    }
}
