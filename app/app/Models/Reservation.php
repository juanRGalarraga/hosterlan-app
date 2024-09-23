<?php

namespace App\Models;

use App\Models\Guest;
use App\Models\AvailableDay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'available_day_id',
        'guest_id',
    ];

    public function availableDay(){
        return $this->belongsTo(AvailableDay::class);
    }

    public function guest(){
        return $this->belongsTo(Guest::class);
    }
}
