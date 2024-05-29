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

    public function pictures(){
      return $this->hasMany(Picture::class);
    }

    public function getUrlPicture(int $id){
      $filename = '';
      if($this->exists()){
        $picture = $this->pictures->find($id);
        $filename = asset("imgs/publications/{$this->id}/{$picture->name}.{$picture->type}");
      }
      return $filename;
    }
}
