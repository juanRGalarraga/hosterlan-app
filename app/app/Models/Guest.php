<?php

namespace App\Models;

use App\Models\PublicationDayAvailable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Guest extends Model
{
    use HasFactory;
    protected $fillable = [
      'user_id',
    ];

    public function publicationDaysAvailables(){
      return $this->hasMany(PublicationDayAvailable::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
