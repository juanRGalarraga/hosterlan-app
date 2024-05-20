<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;
      protected $fillable = [
         'id',
        'price',
        'ubication',
        'description',
        'room_count',
        'pets',
        'number_people'
    ];
}
