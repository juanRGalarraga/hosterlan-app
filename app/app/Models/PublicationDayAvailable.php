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

class PublicationDayAvailable extends Model
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
            $date = Carbon::createFromFormat('d/m/Y', $this->since);
            $now = Carbon::createFromFormat('d/m/Y', $this->to);
            $diff = $date->diffInDays($now);
            $count = $diff;
        }
        return $count;
    }

    public function isPreReserved(){
        $reservationFound = null;
        if($this->exists()){
            $reservationFound = $this
            ->reservations
            ->where('state', ReservationStateEnum::PreReserved->name)
            ->first();
        }
        return isset($reservationFound);
    }

    public function isAvailable(){
        if(!$this->exists()) return false;
        return $this->state == AvailableDayEnum::Available->name;
    }

    public function reservations() : HasMany {
        return $this->hasMany(ReservationGuest::class);
    }

    public function publication() : BelongsTo
    {
        return $this->belongsTo(Publication::class);
    }
    
    public function guests() : HasMany {
        return $this->hasMany(Guest::class);
    }

    protected function since() : Attribute {
        return Attribute::make(
            get: fn(string $value) => \DateTime::createFromFormat('Y-m-d', $value)->format('d/m/Y'),
        );
    }
    protected function to() : Attribute {
        return Attribute::make(
            get: fn(string $value) => \DateTime::createFromFormat('Y-m-d', $value)->format('d/m/Y')
        );
    }
}
