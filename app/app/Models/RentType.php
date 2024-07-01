<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentType extends Model
{
    use HasFactory;
    protected $fillable = [
      'id',
      'name',
      'description',
    ];

    public function publications(){
      return $this->belongsToMany(Publication::class);
    }
}
