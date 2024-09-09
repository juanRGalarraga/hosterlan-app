<?php

namespace App\Models;

use App\Models\Guest;
use App\Models\PublicationDayAvailable;
use App\Models\Publication;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationGuest extends Model
{
    use HasFactory;

    protected $fillable = [
        'publication_day_available_id',
        'guest_id',
    ];

    public function publicationDayAvailable(){
        return $this->belongsTo(PublicationDayAvailable::class);
    }

    public function guest(){
        return $this->belongsTo(Guest::class);
    }
}
