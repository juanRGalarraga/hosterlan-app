<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;
<<<<<<< HEAD
    protected $fillable = [
=======
     protected $fillable = [
        'id',
>>>>>>> 3b4b82a068c5d9b8d9f068880b70b3650fd7e253
        'name',
        'username',
        'password',
        'email',
        'options',
        'rating'
    ];
}
