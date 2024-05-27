<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Picture;

class Publication extends Model
{
    use HasFactory;
    protected $fillable = [
      'price',
      'title',
      'ubication',
      'description',
      'room_count',
      'pets',
      'numbre_people'
    ];

    public function picture(){
      return $this->belongsTo(Picture::class);
    }
}
