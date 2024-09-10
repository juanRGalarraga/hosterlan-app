<?php

namespace App\Models;

use Hamcrest\Number\IsCloseTo;
use Illuminate\Support\Facades\Auth;
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

    public function isMyReservation(){
        $reservationFound = null;
        if(Auth::user()->isGuest() && $this->exists()){
            $reservationFound = $this
            ->reservations
            ->where('guest_id', Auth::user()->guest->id)
            ->where('state', AvailableDayEnum::Pending->name)
            ->first();
        }
        return isset($reservationFound);
    }

    public function reservations() : HasMany {
        return $this->hasMany(ReservationGuest::class);
    }

    public function isAvailable(){
        if(!$this->exists()) return false;
        return $this->state == AvailableDayEnum::Available->name;
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
