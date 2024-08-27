<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CanGetTableNameStatically;

class RentType extends Model
{
    use HasFactory, CanGetTableNameStatically;
    protected $fillable = [
      'id',
      'name',
      'description',
    ];

    public function publications(){
      return $this->hasMany(Publication::class);
    }
}
