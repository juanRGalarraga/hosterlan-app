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
      $filename =  asset("publication-pictures/" . self::DEFAULT_PICTURE);
      if($this->exists()){
        $realFile = asset("publication-pictures/{$this->publication->id}/{$this->name}");
        if( file_exists(storage_path("app/public/publication-pictures/{$this->publication->id}/{$this->name}")) ){
          $filename = $realFile;
        }
      }
      return $filename;
    }
}
