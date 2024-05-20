<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;
<<<<<<< HEAD
    protected $fillable = [
      'price',
      'ubication',
      'description',
      'room_count',
      'pet',
      'numbre_people'
=======
      protected $fillable = [
         'id',
        'price',
        'ubication',
        'description',
        'room_count',
        'pets',
        'number_people'
>>>>>>> 3b4b82a068c5d9b8d9f068880b70b3650fd7e253
    ];
}
