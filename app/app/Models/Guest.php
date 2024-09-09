<?php

namespace App\Models;

use App\Models\PublicationDayAvailable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ReservationGuest;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guest extends Model
{
    use HasFactory;
    protected $fillable = [
      'user_id',
    ];

    public function daysAvailables() : HasMany {
      return $this->hasMany(PublicationDayAvailable::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reservations() : HasMany {
      return $this->hasMany(ReservationGuest::class);
    }
}
