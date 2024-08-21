<?php

namespace App\Models\Publication;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Publication;

class Picture extends Model
{
    use HasFactory;
    protected $fillable = [
      'id',
      'name',
      'type',
      'publication_id'
    ];
    
    public function publication(){
      return $this->belongsTo(Publication::class);
    }

    public function getUrl(){
      $filename = '';
      if($this->exists()){
        $filename = asset("publications-pictures/{$this->publication->id}/{$this->name}");
      }
      return $filename;
    }
}
