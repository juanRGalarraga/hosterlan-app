<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
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

    const DEFAULT_PICTURE = 'carousel-preview.svg';
    
    public function publication(){
      return $this->belongsTo(Publication::class);
    }

    public function getUrl(){
      $filename = self::DEFAULT_PICTURE;
      
      if($this->exists()){
        $path = "{$this->publication->id}/{$this->name}";
        if( Storage::disk('publication-pictures')->exists($path) ){
          $filename = $path;
        }
      }
      
      return asset("publication-pictures/$filename");
    }

    public function getUploadedFile(){
      $filename = self::DEFAULT_PICTURE;
      if($this->exists()){
        $path = "{$this->publication->id}/{$this->name}";
        if( Storage::disk('publication-pictures')->exists($path) ){
          $filename = $path;
        }
      } 
      return asset("publication-pictures/$filename");
    }
}
