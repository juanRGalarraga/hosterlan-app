<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;
<<<<<<< HEAD
    protected $fillable = [
      'name',
      'username',
      'password',
      'email',
      'options',
      'rating'
=======
      protected $fillable = [
        'id',
        'name',
        'username',
        'password',
        'email',
        'options',
        'rating'
>>>>>>> 3b4b82a068c5d9b8d9f068880b70b3650fd7e253
    ];
}
