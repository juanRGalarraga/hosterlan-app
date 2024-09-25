<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AvailableDay;
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

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function availableDays(): HasMany
  {
    return $this->hasMany(AvailableDay::class);
  }

  public function pictures()
  {
    return $this->hasMany(Picture::class);
  }

  public function rentType()
  {
    return $this->belongsTo(RentType::class);
  }

  public function getUrlPicture(int $id): string
  {
    $filename = '';
    if ($this->exists()) {
      $picture = $this->pictures->find($id);

      $filename = asset("publication-pictures/{$this->id}/{$picture->name}");
      if(env('APP_DEBUG', true)){
          $filename = asset("publication-pictures/{$picture->name}");
      }
      debugbar()->debug($filename);
    }
    return $filename;
  }

  public function getFirstPicture(): string
  {
    $defaultPath = asset(Picture::DEFAULT_PICTURE);

    if ($this->exists()) {
      $picture = $this->pictures->first() ?? '';

      if ( empty($picture) ) {
        return $defaultPath;
      }

      $path = "{$this->id}/{$picture->name}";

      //This try to found the example pictures in publication-pictures/factory/
      if(env('APP_DEBUG', true)){
        $path = "{$picture->name}";
      }

      if (Storage::disk('publication-pictures')->exists($path)) {
        return asset("publication-pictures/$path");
      }

    }
    return $defaultPath;
  }

  public function getFormattedCreatedAt()
  {
    Carbon::setLocale('es');
    $date = Carbon::parse($this->created_at);
    $dateString = $date->locale('es');
    if ($this->exists()) {
      return $dateString->translatedFormat('j \d\e F \d\e Y');
    }
    return '';
  }
  
}
