<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationGuest extends Model
{
    use HasFactory;

    protected $fillable = [        
        'publication_id',
        'publication_day_available_id',
        'guest_id',
    ];
}
