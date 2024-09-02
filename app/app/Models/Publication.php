<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PublicationDayAvailable;
use App\Models\Picture;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\CanGetTableNameStatically;
use App\Models\RentType;
class Publication extends Model
{
    use HasFactory, CanGetTableNameStatically;
    protected $fillable = [
      'price',
      'title',
      'ubication',
      'description',
      'room_count',
      'bathroom_count',
      'rent_type_id',
      'user_id',
      'pets',
      'number_people'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function daysAvailable() : HasMany {
        return $this->hasMany(PublicationDayAvailable::class);
    }

    public function pictures(){
      return $this->hasMany(Picture::class);
    }
    
    public function rentType(){
      return $this->belongsTo(RentType::class);
    }

    public function getUrlPicture(int $id){
      $filename = '';
      if($this->exists()){
        $picture = $this->pictures->find($id);
        $filename = asset("publication-pictures/{$this->id}/{$picture->name}");
      }
      return $filename;
    }
    public function getFirstPicture(){
      $defaultPath = asset('publication-pictures/' . Picture::DEFAULT_PICTURE);
      
      if($this->exists()){
        $picture = $this->pictures->first() ?? '';

        if(!($picture instanceof Picture)){
          return $defaultPath;
        }
        
        $path = "publication-pictures/{$this->id}/{$picture->name}";
        $isFileExist = file_exists(public_path($path));
        
        if($isFileExist){
          return asset($path);
        }
        
      }

      return $defaultPath;
    }

    public function getFormattedCreatedAt(){
      Carbon::setLocale('es');
      $date = Carbon::parse($this->created_at);
      $dateString = $date->locale('es');
      if($this->exists()){
        return $dateString->translatedFormat('j \d\e F \d\e Y');
      }
      return '';
    }
}
