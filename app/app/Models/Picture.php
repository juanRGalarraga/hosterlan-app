<?php

namespace App\Models;

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

    const DEFAULT_PICTURE = env('DEFAULT_PICTURE', 'default.svg');
    
    public function publication(){
      return $this->belongsTo(Publication::class);
    }

    public function getUrl(){
      $filename = '';
      if($this->exists()){
        $filename = asset("publication-pictures/{$this->publication->id}/{$this->name}");
      }
      return $filename;
    }
}
