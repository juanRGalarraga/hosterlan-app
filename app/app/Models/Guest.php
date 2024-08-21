<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Guest extends Model
{
    use HasFactory;
    protected $fillable = [
      'name',
      'username',
      'password',
      'email',
      'options',
      'rating'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
