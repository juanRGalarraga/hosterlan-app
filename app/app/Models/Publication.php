<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PublicationDayAvailable;
use App\Models\Picture;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
class Publication extends Model
{
    use HasFactory;
    protected $fillable = [
      'price',
      'title',
      'ubication',
      'description',
      'room_count',
      'bathroom_count',
      'rent_type_id',
      'pets',
      'number_people'
    ];

    public function daysAvailable() : HasMany {
        return $this->hasMany(PublicationDayAvailable::class);
    }

    public function pictures(){
      return $this->hasMany(Picture::class);
    }
    
    public function rentType(){
      return $this->hasOne(RentType::class);
    }

    public function getUrlPicture(int $id){
      $filename = '';
      if($this->exists()){
        $picture = $this->pictures->find($id);
        $filename = asset("publications-pictures/{$this->id}/{$picture->name}");
      }
      return $filename;
    }

    public function getFirstPicture(){
      $filename = asset('publications-pictures/carousel-preview.svg');
      
      if($this->exists()){
        $picture = $this->pictures->first() ?? '';

        if(!$picture){
          return $filename;
        }
        
        $path = "publications-pictures/{$this->id}/{$picture->name}";
        $isFileExist = Storage::exists($path);
        
        if($isFileExist){
          return asset($path);
        }
      }

      return $filename;
    }

    public function getFormattedUpdateAt(){
      if($this->exists()){
        return Carbon::createFromTimestamp($this->created_at)->format('l jS \\of F Y h:i:s A');
      }
      return '';
    }
}
